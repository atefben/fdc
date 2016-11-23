<?php

namespace Base\SoifBundle\Command;

use Base\CoreBundle\Entity\SoifTask;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetModifiedMediaCommand
 * @package Base\SoifBundle\Command
 */
class GetModifiedMediaCommand extends ContainerAwareCommand
{
    /**
     *
     */
    protected function configure() {
        $this
            ->setName('base:soif:get_modified_media')
            ->setDescription('Get the modified medias')
            ->addOption('start', null, InputOption::VALUE_REQUIRED, 'the start timestamp')
            ->addOption('end', null, InputOption::VALUE_REQUIRED, 'the end timestamp', time())
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

        $end = $input->getOption('end');
        // services
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $logger = $this->getContainer()->get('logger');

        $manager = $this->getContainer()->get('base.soif.media_manager');

        // start
        $start = $input->getOption('start');
        if ($start === null) {
            $soifTask = $em->getRepository('BaseCoreBundle:SoifTask')->findOneBy(array('taskName' => 'get_modified_medias'));
            if ($soifTask === null) {
                $msg = __METHOD__. " Couldn't find the taskName get_modified_medias in table SoifTask";
                $output->writeln($msg);
                $this->getContainer()->get('logger')->error($msg);
                die;
            }
            if (get_class($soifTask->getEndTimestamp()) !== 'DateTime') {
                $msg = 'Last call timestamp is not of type DateTime : '. get_class($soifTask->getEndTimestamp());
                $output->writeln($msg);
                $logger->err($msg);
                die;
            }
            $start = $soifTask->getEndTimestamp()->getTimestamp();
        }

        $manager->getModifiedMedia($start, $end);

        // save in database the end timestamp
            $soifTask = $em->getRepository('BaseCoreBundle:SoifTask')->findOneBy(array('taskName' => 'get_modified_medias'));
            $soifTask = ($soifTask !== null) ? $soifTask : new SoifTask();

            $dateTime = new \DateTime();
            $dateTime->setTimestamp((int)$end);

            $soifTask->setTaskName('get_modified_medias');
            $soifTask->setEndTimestamp($dateTime);

            if ($soifTask->getId() == null) {
                $em->persist($soifTask);
            }
            $em->flush();
    }

}