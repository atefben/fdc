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

        // Get twitter api
       /* $twitterClient = new Client('https://api.twitter.com/{version}', array(
            'version' => '1.1'
        ));

        $twitterClient->addSubscriber(new OauthPlugin(array(
            'consumer_key'    => $this->getContainer()->getParameter('twitter_consumer_key'),
            'consumer_secret' => $this->getContainer()->getParameter('twitter_consumer_secret'),
            'token'           => $this->getContainer()->getParameter('twitter_token'),
            'token_secret'    => $this->getContainer()->getParameter('twitter_token_secret')
        )));

        $request = $twitterClient->get('search/tweets.json');
        $request->getQuery()->set('q', '#cannes2016');
        $request->getQuery()->set('count', 13);
        $request->getQuery()->set('result_type', 'recent');
        $response = $request->send();

        $results_twitter = json_decode($response->getBody());
        print_r($results_twitter);exit; */

        // Get instagram api
        $instagramClient = new Client();
        $tag = 'niagara';
        $instagramResponse = file_get_contents('https://api.instagram.com/v1/tags/'. $tag .'/media/recent?access_token='. $this->getContainer()->getParameter('instagram_token'));

        $instagramResults = json_decode($instagramResponse);

        foreach($instagramResults->data as $result) {
            var_dump($result->images->standard_resolution->url);
        }
        exit;

        $em = $this->getContainer()->get('doctrine')->getManager();
        $logger = $this->getContainer()->get('logger');

        // get current festival
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        $festival = $settings->getFestival();
        if ($festival === null) {
            $msg = 'Can\'t find current festival';
            $this->writeError($output, $logger, $msg);
        }

        $em->flush();
    }

    private function writeError($output, $logger, $msg)
    {
        $output->writeln($msg);
        $logger->error($msg);
        exit;
    }

}