<?php

namespace Base\SoifBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * GetFestivalPosterCommand class.
 * 
 * @extends ContainerAwareCommand
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class GetFestivalPosterCommand extends ContainerAwareCommand
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
            ->setName('base:soif:get_festival_poster')
            ->setDescription('Get the festival poster using the soif id')
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
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $id = $input->getArgument('id');

        $manager = $this->getContainer()->get('Base.soif.festival_poster_manager');
        $manager->getById($id);
    }

}