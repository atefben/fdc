<?php

namespace FDC\EventBundle\Command;

use \DateInterval;
use \DateTime;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SocialWallDeleteCommand
 * @package FDC\EventBundle\Command
 */
class SocialWallDeleteCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('fdc:social_wall:delete')
            ->setDescription('Delete unpublished post older than 3 days');
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

        $em  = $this->getContainer()->get('doctrine')->getManager();
        $logger = $this->getCOntainer()->get('logger');

        // remove 3 days to current date
        $dateTime = new DateTime();
        $dateTime->sub(new DateInterval('P3D'));
        $ids = $em->getRepository('BaseCoreBundle:SocialWall')->getUnpublishedIdsOlderThan($dateTime);
        $total = count($ids);
        $divisor = $total / 10;

        $this->writeInfo($output, $logger, 'Social wall old posts: '. $total);

        // get current social graph twitter hashtag
        foreach ($ids as $key => $id) {
            $entity = $em->getRepository('BaseCoreBundle:SocialWall')->findOneById($id);
            $em->remove($entity);
            if ($key % $divisor == 0) {
                $this->writeInfo($output, $logger, 'Social wall old posts deleted: '. $key. '/'. $total);
                $em->flush();
            }
        }
        $em->flush();

        $this->writeInfo($output, $logger, 'Social wall deleted: '. $total);

    }

    private function writeInfo($output, $logger, $msg)
    {
        $output->writeln($msg);
        $logger->info($msg);
    }

}