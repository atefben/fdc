<?php

namespace Base\SoifBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * GetFilmAtelierCommand class.
 * 
 * @extends ContainerAwareCommand
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class GetFilmAtelierCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     * 
     * @access protected
     * @return void
     */
    protected function configure() {
        $this
            ->setName('base:soif:get_film_atelier')
            ->setDescription('Get the film atelier using the soif id')
            ->addArgument('id', InputArgument::REQUIRED, 'the soif identifier')
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

        $id = $input->getArgument('id');

        $manager = $this->getContainer()->get('base.soif.film_atelier_manager');
        $manager->getById($id);
    }

}