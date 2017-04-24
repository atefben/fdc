<?php

namespace Base\SoifBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * UpdateFilmsCommand class.
 * @extends ContainerAwareCommand
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class UpdateFilmsCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('base:soif:update_films')
            ->setDescription('Update all films')
            ->addOption('page', null, InputOption::VALUE_OPTIONAL, 'The page')
            ->addOption('noartist', null, InputOption::VALUE_NONE, 'No artist')
        ;
    }

    /**
     * execute function.
     * @access protected
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('base.soif.film_manager');
        if ($input->getOption('page')) {
            $offset = 10 * ((int)$input->getOption('page') - 1);
            $films = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->findBy([], [], 10, $offset)
            ;
            $progress = new ProgressBar($output, count($films));
            $progress->start();
            foreach ($films as $film) {
                $progress->advance();
                $manager->getById($film->getId());
            }
            $progress->finish();

        } else {
            $manager->updateAll($output);

        }
    }

    protected function getCountFilms()
    {
        return (int)$this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->createQueryBuilder('f')
            ->select('count(f) as total')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    protected function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}