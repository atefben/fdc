<?php

namespace FDC\EventBundle\Command;

use Base\CoreBundle\Entity\SocialGraph;
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
        $socialGraphSettings = $em->getRepository('BaseCoreBundle:Homepage')->findOneByFestival($festival->getId());
        if ($socialGraphSettings === null) {
            $msg = 'Can\'t find social graph settings';
            $this->writeError($output, $logger, $msg);
        }

        // get social graph by date
        $socialGraph = $em->getRepository('BaseCoreBundle:SocialGraph')->findOneBy(array(
            'date' => $datetime,
            'festival' => $festival->getId()
        ));

        if ($socialGraph === null) {
            $socialGraph = new SocialGraph();
            $socialGraph->setFestival($festival);
            $socialGraph->setDate($datetime);
        }

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

        // Get last twitter id in db
        $maxId = ($socialGraph->getLastTweetId()) ? $socialGraph->getLastTweetId() : null;

        $totalTweets = 0;
        $request = $twitterClient->get('search/tweets.json');

        // Count all tweet with hashtag during today
        while(true) {
            try {
                $request->getQuery()->set('q', $socialGraphSettings->getSocialGraphHashtagTwitter());
                $request->getQuery()->set('count', $offset);
                $request->getQuery()->set('since', $datetime->format('Y-m-d'));
                if ($maxId !== null) {
                    $request->getQuery()->set('max_id', $maxId);
                }
                $response = $request->send();

                // Process each tweet returned
                $results = json_decode($response->getBody());
                $tweets = $results->statuses;

                $totalTweets += count($tweets);

                // Exit when no more tweets are returned
                if (sizeof($tweets) !== $offset) {
                    $maxId = (sizeof($tweets) > 0) ? $tweets[sizeof($tweets) - 1]->id : $maxId;
                    $totalTweets = ($maxId != null && sizeof($tweets) > 0) ? ($totalTweets - 1) : $totalTweets;
                    break;
                }

                // Set tweets id & count
                $socialGraph->setLastTweetId($maxId);
                $socialGraph->setCount($socialGraph->getCount() + $totalTweets);

                if ($socialGraph->getId() === null) {
                    $em->persist($socialGraph);
                }

                $em->flush();
            } catch (\Exception $e) {
                $output->writeln($e->getMessage());
                break;
            }

        }


    }

    private function writeError($output, $logger, $msg)
    {
        $output->writeln($msg);
        $logger->error($msg);
        exit;
    }

}