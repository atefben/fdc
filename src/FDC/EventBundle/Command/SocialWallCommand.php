<?php

namespace FDC\EventBundle\Command;

use Base\CoreBundle\Entity\SocialWall;
use \DateTime;

use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SocialWallCommand
 * @package FDC\EventBundle\Command
 */
class SocialWallCommand extends ContainerAwareCommand {
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure() {
        $this->setName('fdc:social_wall:update')->setDescription('Update social wall');
        $this->addArgument(
            'first'
        );
    }

    /**
     * execute function.
     *
     * @access protected
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output) {

        $adminSecurityHandler = $this->getContainer()->get('sonata.admin.security.handler');
        $modelAdmin = $this->getContainer()->get('base.admin.social_wall');
        $securityInformation = $adminSecurityHandler->buildSecurityInformation($modelAdmin);

        $em       = $this->getContainer()->get('doctrine')->getManager();
        $logger   = $this->getContainer()->get('logger');
        $datetime = new DateTime();
        $offset   = 100;

        // get current festival
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        $festival = $settings->getFestival();
        if ($festival === null) {
            $msg = 'Can\'t find current festival';
            $this->writeError($output, $logger, $msg);
        }

        // get current social graph twitter hashtag
        $tagSettings = $em->getRepository('BaseCoreBundle:HomepageCorporate')->find(1);
        if ($tagSettings === null) {
            $msg = 'Can\'t find social wall settings';
            $this->writeError($output, $logger, $msg);
        }

        // get all hashtags
        $tags = explode(', ', $tagSettings->getSocialWallHashtags());

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////   TWITTER   ///////////////////////////////
        ////////////////////////////////////////////////////////////////////////

        // Get twitter api
        $twitterClient = new Client('https://api.twitter.com/{version}', array(
            'version' => '1.1'
        ));

        $twitterClient->addSubscriber(new OauthPlugin(array(
            'consumer_key' => $this->getContainer()->getParameter('twitter_consumer_key'),
            'consumer_secret' => $this->getContainer()->getParameter('twitter_consumer_secret'),
            'token' => $this->getContainer()->getParameter('twitter_token'),
            'token_secret' => $this->getContainer()->getParameter('twitter_token_secret')
        )));

        // get last id twitter
        $lastIdTwitter = $em->getRepository('BaseCoreBundle:SocialWall')->findBy(
            array('network' => constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_TWITTER')),
            array('id' => 'DESC'),
            1,
            null
        );

        // Get last twitter id in db
        $maxId   = (isset($lastIdTwitter[0])) ? $lastIdTwitter[0]->getMaxIdTwitter() : null;
        $request = $twitterClient->get('search/tweets.json');
        $tweets = array();

        // Get all tweets
        foreach ($tags as $tag) {
            $tag = trim($tag);
            while (true) {

                $request->getQuery()->set('q', $tag);
                $request->getQuery()->set('count', $offset);
                if ($maxId !== null) {
                    $request->getQuery()->set('since_id', $maxId);
                }
                try {
                    $response = $request->send();
                    // Process each tweet returned
                    $results = json_decode($response->getBody());
                    $tweets  = array_merge($tweets, $results->statuses);
                    $output->writeln('TWEETS DONE: '. sizeof($results->statuses));
                    // Exit when no more tweets are returned
                    if (sizeof($results->statuses) !== $offset) {
                        $maxId = (sizeof($tweets) > 0) ? $tweets[0]->id : $maxId;
                        break;
                    }
                } catch (\Exception $e) {
                    $output->writeln($e->getMessage());
                    $tweets = array();
                    break;
                }
            }
        }

        $socialWalls = array();
        if (count($tweets) > 0) {
            krsort($tweets);
            foreach ($tweets as $tweet) {

                $socialWall = new SocialWall();
                $socialWall->setMessage($tweet->text);
                if (isset($tweet->entities->media[0]->media_url)) {
                    $socialWall->setContent($tweet->entities->media[0]->media_url);
                } else {
                    $socialWall->setContent(NULL);
                }
                $socialWall->setUrl('https://twitter.com/' . $tweet->user->screen_name . '/status/' . $tweet->id);
                $socialWall->setNetwork(constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_TWITTER'));
                $socialWall->setEnabledMobile(0);
                $socialWall->setEnabledDesktop(0);
                $socialWall->setMaxIdTwitter($maxId);
                $socialWall->setDate($datetime);
                $socialWall->setTags($tagSettings->getSocialWallHashtags());
                $em->persist($socialWall);
                $socialWalls[] = $socialWall;
            }
            $em->flush();

            //update ACL
            foreach ($socialWalls as $socialWall) {
                $objectIdentity = ObjectIdentity::fromDomainObject($socialWall);
                $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
                if (is_null($acl)) {
                    $acl = $adminSecurityHandler->createAcl($objectIdentity);
                }
                $adminSecurityHandler->addObjectClassAces($acl, $securityInformation);
                $adminSecurityHandler->updateAcl($acl);
            }
        }

        // regenerating acl
        $tweetsCount = count($socialWalls);
        $lines = array();
        exec("php app/console base:admin:regenerate_acl_social_wall_twitter {$tweetsCount}", $lines);
        foreach ($lines as $line) {
            $output->writeln($line);
        }

        $output->writeln('Tweet added: '. $tweetsCount);

        ////////////////////////////////////////////////////////////////////
        /////////////////////////   INSTAGRAM   ////////////////////////////
        ////////////////////////////////////////////////////////////////////

        $lastIdInstagram = $em->getRepository('BaseCoreBundle:SocialWall')->findBy(
            array('network' => constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_INSTAGRAM')),
            array('id' => 'DESC'),
            1,
            null
        );

        $nextUrl = null;
        $instagramPosts = array();
        $socialWalls = array();

        foreach ($tags as $tag) {
            $tag = substr($tag, 1);
            $tag = trim($tag);
            $break = false;
            while (true) {
                if ($nextUrl == null) {
                    $instagramResponse = file_get_contents('https://api.instagram.com/v1/tags/' . $tag . '/media/recent?access_token=' . $this->getContainer()->getParameter('instagram_token') . '&count=100');
                } else {
                    $instagramResponse = file_get_contents($nextUrl);
                }

                $instagramResults = json_decode($instagramResponse);
                $nextUrl = $instagramResults->pagination->next_url;

                foreach ($instagramResults->data as $instagramPost) {
                    if($em->getRepository('BaseCoreBundle:SocialWall')->findOneBy(array('maxIdInstagram' => $instagramPost->id)) != null){
                        $break = true;
                        break;
                    }
                    $instagramPosts[] = $instagramPost;
                }

                $output->writeln('INSTAGRAMS POSTS DONE: '. sizeof($instagramPosts));

                if($input->getArgument('first') || $break == true) {
                    break;
                }

            }

        }

        krsort($instagramPosts);
        foreach ($instagramPosts as $instagramPost) {
            $socialWall = new SocialWall();
            $socialWall->setMessage($instagramPost->caption->text);
            $socialWall->setContent($instagramPost->images->standard_resolution->url);
            $socialWall->setUrl($instagramPost->link);
            $socialWall->setNetwork(constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_INSTAGRAM'));
            $socialWall->setMaxIdInstagram($instagramPost->id);
            $socialWall->setEnabledMobile(0);
            $socialWall->setEnabledDesktop(0);
            $socialWall->setDate($datetime);
            $socialWall->setTags($tagSettings->getSocialWallHashtags());
            $em->persist($socialWall);
            $socialWalls[] = $socialWall;
        }

        $em->flush();

        //update ACL
        foreach ($socialWalls as $socialWall) {
            $objectIdentity = ObjectIdentity::fromDomainObject($socialWall);
            $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
            if (is_null($acl)) {
                $acl = $adminSecurityHandler->createAcl($objectIdentity);
            }
            $adminSecurityHandler->addObjectClassAces($acl, $adminSecurityHandler->buildSecurityInformation($modelAdmin));
            $adminSecurityHandler->updateAcl($acl);
        }

    }

    private function writeError($output, $logger, $msg) {
        $output->writeln($msg);
        $logger->error($msg);
        exit;
    }

}