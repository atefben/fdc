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
 * Class SocialGraphCommand
 * @package FDC\EventBundle\Command
 */
class SocialGraphCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure() {
        $this
            ->setName('fdc:social_graph:update')
            ->setDescription('Update social graph total tweets count')
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
        $twitter_client = new Client('https://api.twitter.com/{version}', array(
            'version' => '1.1'
        ));

        $twitter_client->addSubscriber(new OauthPlugin(array(
            'consumer_key'    => $this->getContainer()->getParameter('twitter_consumer_key'),
            'consumer_secret' => $this->getContainer()->getParameter('twitter_consumer_secret'),
            'token'           => $this->getContainer()->getParameter('twitter_token'),
            'token_secret'    => $this->getContainer()->getParameter('twitter_token_secret')
        )));

        $datetime = new DateTime();

        $max_id = 0;
        $tweets_found = 0;

        // Count all tweet with hashtag during today
        while(true){

            if ($max_id == 0) {
                $request = $twitter_client->get('search/tweets.json');
                $request->getQuery()->set('q', '#psg');
                $request->getQuery()->set('count', 100);
                $request->getQuery()->set('since', $datetime->format('Y-m-d'));
                $response = $request->send();
            } else {
                // Collect older tweets
                --$max_id;
                $request = $twitter_client->get('search/tweets.json');
                $request->getQuery()->set('q', '#psg');
                $request->getQuery()->set('count', 100);
                $request->getQuery()->set('since', $datetime->format('Y-m-d'));
                $request->getQuery()->set('max_id', $max_id);
                $response = $request->send();
            }

            // Process each tweet returned
            $results = json_decode($response->getBody());
            $tweets  = $results->statuses;

            // Exit when no more tweets are returned
            if (sizeof($tweets)==0) {
                break;
            }

            foreach($tweets as $tweet) {
                ++$tweets_found;
                $max_id = $tweet->id;
            }

        }

        $em = $this->getContainer()->get('doctrine')->getManager();
        $logger = $this->getContainer()->get('logger');

        // get current festival
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        $festival = $settings->getFestival();
        if ($festival === null) {
            $msg = 'Can\'t find current festival';
            $this->writeError($output, $logger, $msg);
        }

        // get current social graph twitter hashtag
        $socialGraphSettings = $em->getRepository('BaseCoreBundle:SocialGraphSettings')->findOneByFestival($festival->getId());
        if ($socialGraphSettings === null) {
            $msg = 'Can\'t find social graph settings';
            $this->writeError($output, $logger, $msg);
        }

        // get social wall by date
        $socialWall = $em->getRepository('BaseCoreBundle:SocialWall')->findOneBy(array(
            'date' => $datetime->format('d-m-Y'),
            'festival' => $festival->getId()
        ));
        if ($socialWall === null) {
            $socialWall = new SocialWall();
            $socialWall->setFestival($festival);
            $socialWall->setDate($datetime);
        }

        // get tweets
        $count = $tweets_found;

        $socialWall->setCount($socialWall->getCount() + $count);

        $em->flush();
    }

    private function writeError($output, $logger, $msg)
    {
        $output->writeln($msg);
        $logger->error($msg);
        exit;
    }

}