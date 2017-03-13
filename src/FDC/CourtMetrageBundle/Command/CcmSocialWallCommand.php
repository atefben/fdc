<?php

namespace FDC\CourtMetrageBundle\Command;

use \DateTime;

use FDC\CourtMetrageBundle\Entity\CcmSocialWall;
use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CcmSocialWallCommand extends ContainerAwareCommand
{
    protected function configure() {
        $this->setName('ccm:social_wall:update')->setDescription('Update social wall');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $adminSecurityHandler = $this->getContainer()->get('sonata.admin.security.handler');
        $modelAdmin = $this->getContainer()->get('base.admin.ccm_social_wall');
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

        $socialWallTag = $em->getRepository('FDCCourtMetrageBundle:CcmSocialWallHashTag')->findAll();

        $tags = explode(', ', $socialWallTag[0]->getHashTag());

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

        $tweets = array();

        // Get all tweets
        foreach ($tags as $tag) {

            $lastIdTwitter = $em->getRepository('FDCCourtMetrageBundle:CcmSocialWall')->findBy(
                array('network' => constant('FDC\\CourtMetrageBundle\\Entity\\CcmSocialWall::NETWORK_TWITTER'),
                      'tags' => $tag
                ),
                array('id' => 'DESC'),
                1,
                null
            );

            $maxId   = (isset($lastIdTwitter[0])) ? $lastIdTwitter[0]->getMaxIdTwitter() : null;

            $tag = trim($tag);
            $request = $twitterClient->get('search/tweets.json');
            while (TRUE) {

                $request->getQuery()->set('q', $tag);
                $request->getQuery()->set('count', $offset);
                if ($maxId !== null) {
                    $request->getQuery()->set('since_id', $maxId);
                }
                try {
                    $response = $request->send();
                    // Process each tweet returned
                    $results = json_decode($response->getBody());
                    $tweets = array_merge($tweets, $results->statuses);
                    $output->writeln('TWEETS DONE: ' . sizeof($results->statuses));
                    $maxId = (sizeof($tweets) > 0) ? $tweets[0]->id : $maxId;


                    // Exit when no more tweets are returned
                    if (sizeof($results->statuses) !== $offset) {

                        $socialWalls = array();
                        $retweetsCount = 0;
                        if (count($tweets) > 0) {
                            krsort($tweets);
                            foreach ($tweets as $tweet) {

                                $tweetByUrl = $em->getRepository('FDCCourtMetrageBundle:CcmSocialWall')->findOneBy(array(
                                        'url' => 'https://twitter.com/' . $tweet->user->screen_name . '/status/' . $tweet->id
                                    )
                                );

                                $tweetByContent = null;
                                if (isset($tweet->entities->media[0]->media_url)) {
                                    $tweetByContent = $em->getRepository('FDCCourtMetrageBundle:CcmSocialWall')->findOneBy(array(
                                           'content' => $tweet->entities->media[0]->media_url
                                       )
                                    );
                                }

                                $tweetByMessage = $em->getRepository('FDCCourtMetrageBundle:CcmSocialWall')->findOneBy(array(
                                       'message' => json_encode($tweet->text)
                                   )
                                );

                                if($tweetByUrl || $tweetByContent || $tweetByMessage)
                                {
                                    $retweetsCount += 1;
                                    continue;
                                }

                                $socialWall = new CcmSocialWall();
                                $socialWall->setMessage($tweet->text);
                                if (isset($tweet->entities->media[0]->media_url)) {
                                    $socialWall->setContent($tweet->entities->media[0]->media_url);
                                } else {
                                    $socialWall->setContent(null);
                                }
                                $socialWall->setUrl('https://twitter.com/' . $tweet->user->screen_name . '/status/' . $tweet->id);
                                $socialWall->setNetwork(constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_TWITTER'));
                                $socialWall->setEnabledDesktop(0);
                                $socialWall->setMaxIdTwitter($maxId);
                                $socialWall->setDate($datetime);
                                $socialWall->setCreatedAt(new DateTime($tweet->created_at));
                                $socialWall->setTags($this->getHashTagsForTweet($tweet->entities->hashtags, $tags));
                                $em->persist($socialWall);
                                $socialWalls[] = $socialWall;
                                $em->flush();
                            }

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
                        exec("php app/console base:admin:ccm_regenerate_acl_social_wall_twitter {$tweetsCount}", $lines);
                        foreach ($lines as $line) {
                            $output->writeln($line);
                        }

                        $output->writeln('Tweet added: ' . $tweetsCount);
                        $output->writeln('Retweets not saved: ' . $retweetsCount);

                        $tweets = array();

                        break;
                    }
                } catch (\Exception $e) {
                    $output->writeln($e->getMessage());
                    $tweets = array();
                    break;
                }
            }
        }

        ////////////////////////////////////////////////////////////////////
        /////////////////////////   INSTAGRAM   ////////////////////////////
        ////////////////////////////////////////////////////////////////////

        $lastIdInstagram = $em->getRepository('FDCCourtMetrageBundle:CcmSocialWall')->findBy(
            array('network' => constant('FDC\\CourtMetrageBundle\\Entity\\CcmSocialWall::NETWORK_INSTAGRAM')),
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
            while (true) {
                if ($nextUrl == null) {
                    $instagramResponse = file_get_contents('https://api.instagram.com/v1/tags/' . $tag . '/media/recent?access_token=' . $this->getContainer()->getParameter('instagram_token') . '&count=' . $offset);
                } else {
                    $instagramResponse = file_get_contents($nextUrl);
                }

                $instagramResults = json_decode($instagramResponse);
                if(property_exists($instagramResults->pagination, 'next_url')) {
                    $nextUrl = $instagramResults->pagination->next_url;
                } else {
                    $nextUrl = null;
                }

                $count = 0;
                foreach ($instagramResults->data as $instagramPost) {
                    if(!($em->getRepository('FDCCourtMetrageBundle:CcmSocialWall')->findOneBy(array('maxIdInstagram' => $instagramPost->id)) != null)){
                        $instagramPosts[] = $instagramPost;
                        $count++;
                    }
                }

                $output->writeln('INSTAGRAMS POSTS DONE: '. $count);

                if(sizeof($instagramResults->data) < $offset)
                {
                    break;
                }
            }
        }

        krsort($instagramPosts);
        foreach ($instagramPosts as $instagramPost) {
            $socialWall = new CcmSocialWall();
            $socialWall->setMessage($instagramPost->caption->text);
            $socialWall->setContent($instagramPost->images->standard_resolution->url);
            $socialWall->setUrl($instagramPost->link);
            $socialWall->setNetwork(constant('FDC\\CourtMetrageBundle\\Entity\\CcmSocialWall::NETWORK_INSTAGRAM'));
            $socialWall->setMaxIdInstagram($instagramPost->id);
            $socialWall->setEnabledDesktop(0);
            $socialWall->setDate($datetime);
            $socialWall->setTags($this->getHashTagsForInstagramPost($instagramPost->caption->text, $tags));
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

    private function getHashTagsForInstagramPost($postMessage, $boHashTags) {
        foreach ($boHashTags as $boHashTag)
        {
            if(strpos(strtolower($postMessage), strtolower($boHashTag))) {
                return $boHashTag;
            }
        }

        return '';
    }

    private function getHashTagsForTweet($hashTags, $boHashTags)
    {
        foreach($hashTags as $hashTag)
        {
            foreach ($boHashTags as $boHashTag)
            {
                if(strtolower($boHashTag) == '#' . strtolower($hashTag->text))
                {
                    return $boHashTag;
                }
            }
        }

        return '';
    }

    private function writeError($output, $logger, $msg) {
        $output->writeln($msg);
        $logger->error($msg);
        exit;
    }
}
