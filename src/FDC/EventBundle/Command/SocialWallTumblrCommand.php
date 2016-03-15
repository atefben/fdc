<?php

namespace FDC\EventBundle\Command;

use Base\CoreBundle\Entity\SocialWall;
use \DateTime;

use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class SocialWallTumblrCommand
 * @package FDC\EventBundle\Command
 */
class SocialWallTumblrCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this->setName('fdc:social_wall_tumblr:update')->setDescription('Update social wall (Tumblr)');
    }

    /**
     * execute function.
     *
     * @access protected
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
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
        $tagSettings = $em->getRepository('BaseCoreBundle:Homepage')->findOneByFestival($festival->getId());
        if ($tagSettings === null) {
            $msg = 'Can\'t find social wall settings';
            $this->writeError($output, $logger, $msg);
        }

        // get all hashtags
        $tags = explode(', ', $tagSettings->getSocialWallHashtags());

        //////////////////////////////////////////////////////////////////////
        ///////////////////////////   TUMBLR  ////////////////////////////////
        //////////////////////////////////////////////////////////////////////

        $lastInsertionsTumblr = $em->getRepository('BaseCoreBundle:SocialWall')->findBy(
            array('network' => constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_TUMBLR')),
            array('id' => 'DESC'),
            40,
            null
        );

        foreach ($tags as $tag) {
            $tag = substr($tag, 1);

            $tumblrResponse = file_get_contents('https://api.tumblr.com/v2/tagged?tag='.$tag.'&api_key='. $this->getContainer()->getParameter('tumblr_consumer_key'));
            $tumblrPosts = json_decode($tumblrResponse)->response;

        }

        krsort($tumblrPosts);
        $count = null;
        foreach ($tumblrPosts as $key => $tumblrPost) {
            $canInsert = true;
            $count = $key;
            //check if the post is'nt already inserted in the 40 last insert
            foreach($lastInsertionsTumblr as $lastInsert) {
                if($lastInsert->getTumblrId() == $tumblrPost->id) {
                    $canInsert = false;
                }
            }

            if($canInsert == true) {
                $socialWall = new SocialWall();
                $socialWall->setMessage($tumblrPost->summary);
                if(isset($tumblrPost->photos[0]->original_size->url)) {
                    $socialWall->setContent($tumblrPost->photos[0]->original_size->url);
                } else {
                    $socialWall->setContent('#');
                }
                $socialWall->setUrl($tumblrPost->post_url);
                $socialWall->setNetwork(constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_TUMBLR'));
                $socialWall->setEnabledMobile(0);
                $socialWall->setEnabledDesktop(0);
                $socialWall->setDate($datetime);
                $socialWall->setTags($tagSettings->getSocialWallHashtags());
                $socialWall->setTumblrId($tumblrPost->id);

                $em->persist($socialWall);
            }
        }

        $em->flush();

        $kernel = $this->getContainer()->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => ' sonata:admin:generate-object-acl',
            '--user_entity' => 'BaseCoreBundle:SocialWall',
        ));

        $output = new NullOutput();
        $application->run($input, $output);

        $output->writeln('Tumblr added: '. $count);
    }
}
