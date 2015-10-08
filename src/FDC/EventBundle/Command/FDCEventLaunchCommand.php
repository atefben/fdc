<?php

namespace FDC\EventBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * FDCEventLaunchCommand class.
 *
 * @extends ContainerAwareCommand
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class FDCEventLaunchCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure() {
        $this
            ->setName('fdc:event:launch')
            ->setDescription('Start or stop the fdc event')
            ->addArgument(
                'launch',
                InputArgument::REQUIRED,
                'Set the event time, Available values : on | off'
            )
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
        $launch = $input->getArgument('launch');
        $launchValues = array('on', 'off');

        // verify argument
        if (!in_array($launch, $launchValues)) {
            $output->writeln("<error>Value '{$launch}' is not allowed, available values : ". implode(', ', $launchValues));
        }

        // dir vars
        $kernelDir = $this->getContainer()->getParameter('kernel.root_dir');
        $sourceDir =  $kernelDir. '/../src/FDC/EventBundle/Resources/templates/';
        $targetDir =  $kernelDir. '/../src/FDC/EventBundle/Resources/config/';

        // copy the file
        $fs = new Filesystem();
        $fs->copy($sourceDir. "routing_fdc_event_{$launch}.yml", $targetDir. 'routing.yml', true);

        // display info
        $output->writeln("<info>FDCEventBundle routing.yml updated with {$sourceDir}routing_fdc_event_{$launch}.yml</info>");
    }

}