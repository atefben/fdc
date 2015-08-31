<?php

namespace FDC\SoifBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ImportModifiedCommand class.
 * 
 * @extends ContainerAwareCommand
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class ImportModifiedCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     * 
     * @access protected
     * @return void
     */
    protected function configure() {
        $this
            ->setName('fdc:soif:import_modified')
            ->setDescription('Imports the modified elements')
            ->addArgument('from', InputArgument::REQUIRED, 'the soif identifier')
            ->addArgument('to', InputArgument::REQUIRED, 'the soif identifier')
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

        $from = $input->getArgument('from');
        $to = $input->getArgument('to');
        
        $managers = array(
            $this->getContainer()->get('fdc.soif.award_manager'),
            $this->getContainer()->get('fdc.soif.country_manager'),
            $this->getContainer()->get('fdc.soif.festival_manager'),
            $this->getContainer()->get('fdc.soif.festival_poster_manager'),
            $this->getContainer()->get('fdc.soif.film_atelier_manager'),
            $this->getContainer()->get('fdc.soif.film_manager'),
            $this->getContainer()->get('fdc.soif.jury_manager'),
            $this->getContainer()->get('fdc.soif.person_manager'),
            $this->getContainer()->get('fdc.soif.prize_manager'),
            $this->getContainer()->get('fdc.soif.projection_manager')
        );
        
        foreach ($managers as $manager) {
            $manager->getModified($from, $to);
        }
    }

}