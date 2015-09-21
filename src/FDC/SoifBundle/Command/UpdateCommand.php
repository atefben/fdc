<?php

namespace FDC\SoifBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Update class.
 * 
 * @extends ContainerAwareCommand
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class UpdateCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     * 
     * @access protected
     * @return void
     */
    protected function configure() {
        $this
            ->setName('fdc:soif:update')
            ->setDescription('Update the database with SOIF call timestamp interval')
            ->addArgument('from', InputArgument::REQUIRED, 'the soif identifier')
            ->addArgument('to', InputArgument::REQUIRED, 'the soif identifier')
            ->addOption('entity', null, InputOption::VALUE_REQUIRED, 'If defined, will update the only entity selected')
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
        $entity = $input->getOption('entity');
        
        $managers = array(
            $this->getContainer()->get('fdc.soif.country_manager'),
            $this->getContainer()->get('fdc.soif.prize_manager'),
            $this->getContainer()->get('fdc.soif.festival_manager'),
            $this->getContainer()->get('fdc.soif.award_manager'),
            $this->getContainer()->get('fdc.soif.person_manager'),
            $this->getContainer()->get('fdc.soif.festival_poster_manager'),
            $this->getContainer()->get('fdc.soif.film_atelier_manager'),
            $this->getContainer()->get('fdc.soif.film_manager'),
            $this->getContainer()->get('fdc.soif.jury_manager'),
            $this->getContainer()->get('fdc.soif.projection_manager')
        );
        
        if ($entity) {
            try {
                $managers = array($this->getContainer()->get("fdc.soif.{$entity}_manager"));
            } catch (ServiceNotFoundException $e){
                $output->writeln("The entity {$entity} and its related service fdc.soif.{$entity}_manager are not found");
                exit;
           }
        }
        
        foreach ($managers as $manager) {
            $manager->getModified($from, $to);
            $manager->getRemoved($from, $to);
        }
    }

}