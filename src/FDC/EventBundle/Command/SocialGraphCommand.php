<?php

namespace FDC\EventBundle\Command;

use Base\CoreBundle\Entity\SocialWall;
use \DateTime;

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
        $datetime = new DateTime();
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
        $count = 0;

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