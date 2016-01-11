<?php

namespace FDC\EventBundle\Command;

use Base\CoreBundle\Entity\SocialWall;
use \DateTime;

use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SocialWallCommand
 * @package FDC\EventBundle\Command
 */
class SocialWallCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure() {
        $this
            ->setName('fdc:social_wall:update')
            ->setDescription('Update social wall')
        ;
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


        $em = $this->getContainer()->get('doctrine')->getManager();
        $logger = $this->getContainer()->get('logger');
        $datetime = new DateTime();
        $offset = 100;

        // get current festival
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        $festival = $settings->getFestival();
        if ($festival === null) {
            $msg = 'Can\'t find current festival';
            $this->writeError($output, $logger, $msg);
        }

        // get current social graph twitter hashtag
        $tagSettings= $em->getRepository('BaseCoreBundle:Homepage')->findOneByFestival($festival->getId());
        if ($tagSettings === null) {
            $msg = 'Can\'t find social graph settings';
            $this->writeError($output, $logger, $msg);
        }

        // get all hashtags
        $tags = explode(', ',$tagSettings->getSocialWallHashtags());

         ////////////////////////////////////////////////////////////////////////
        ////////////////////////////   TWITTER   ///////////////////////////////
       ////////////////////////////////////////////////////////////////////////


       // Get twitter api
        $twitterClient = new Client('https://api.twitter.com/{version}', array(
               'version' => '1.1'
        ));

        $twitterClient->addSubscriber(new OauthPlugin(array(
           'consumer_key'    => $this->getContainer()->getParameter('twitter_consumer_key'),
           'consumer_secret' => $this->getContainer()->getParameter('twitter_consumer_secret'),
           'token'           => $this->getContainer()->getParameter('twitter_token'),
           'token_secret'    => $this->getContainer()->getParameter('twitter_token_secret')
        )));

        // get social graph by date
        $lastIdTwitter = $em->getRepository('BaseCoreBundle:SocialWall')->findOneBy(array(
           'date'  => $datetime,
           'network' => 0
        ));

        // Get last twitter id in db
        $maxId = (null != $lastIdTwitter) ? $lastIdTwitter->getMaxIdTwitter() : 686506565541703680;
        $request = $twitterClient->get('search/tweets.json');

        // Get all tweets
        foreach($tags as $tag) {

            while(true) {

                $request->getQuery()->set('q', $tag);
                $request->getQuery()->set('count', $offset);
                $request->getQuery()->set('since', $datetime->format('Y-m-d'));
                if ($maxId !== null) {
                   $request->getQuery()->set('max_id', $maxId);
                }
                $response = $request->send();

                // Process each tweet returned
                $results = json_decode($response->getBody());
                $tweets  = $results->statuses;

                // Exit when no more tweets are returned
                if (sizeof($tweets) !== $offset) {
                   $maxId = $maxId = (sizeof($tweets) > 0) ? $tweets[sizeof($tweets) - 1]->id : $maxId;
                   break;
                }

            }
        }

        foreach($tweets as $tweet) {
            $socialWall =  new SocialWall();
            $socialWall->setMessage($tweet->text);
            if(isset($tweet->entities->media[0]->media_url)) {
               $socialWall->setContent($tweet->entities->media[0]->media_url);
            } else {
               $socialWall->setContent('#');
            }
            $socialWall->setUrl('https://twitter.com/'.$tweet->user->screen_name.'/status/'.$tweet->id);
            $socialWall->setNetwork(0);
            $socialWall->setEnabledMobile(0);
            $socialWall->setEnabledDesktop(0);
            $socialWall->setMaxIdTwitter($maxId);
            $socialWall->setDate($datetime);
            $socialWall->setTags($tagSettings->getSocialWallHashtags());
            $em->persist($socialWall);
        }

         //////////////////////////////////////////////////////////////////////
        ///////////////////////////   INSTAGRAM   ////////////////////////////
        //////////////////////////////////////////////////////////////////////

        /*

        // Get instagram api

        foreach($tags as $tag) {
            $tag = substr($tag, 1);
            $instagramResponse = file_get_contents('https://api.instagram.com/v1/tags/'. $tag .'/media/recent?access_token='. $this->getContainer()->getParameter('instagram_token'));
            $instagramResults = json_decode($instagramResponse);
        }
        echo'<pre>'; print_r($instagramResults); echo '</pre>'; exit;
        foreach($instagramResults->data as $instagramPost) {
            $socialWall =  new SocialWall();
            $socialWall->setMessage($instagramPost->caption->text);
            $socialWall->setContent($instagramPost->images->standard_resolution->url);
            $socialWall->setUrl($instagramPost->link);
            $socialWall->setNetwork(1);
            $socialWall->setEnabledMobile(0);
            $socialWall->setEnabledDesktop(0);
            $socialWall->setDate($datetime);
            $socialWall->setTags($tagSettings->getSocialWallHashtags());
            $em->persist($socialWall);
        }

        */


        $em->flush();
        }

        private function writeError($output, $logger, $msg)
        {
            $output->writeln($msg);
            $logger->error($msg);
            exit;
        }

}