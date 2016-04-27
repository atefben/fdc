<?php

namespace Base\SoifBundle\Command;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * GetPersonCommand class.
 *
 * @extends ContainerAwareCommand
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class GetPersonsFilmsCommand extends ContainerAwareCommand
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
            ->setName('base:soif:get_persons_films')
            ->setDescription('Get the person using the soif id')
            ->addOption('all', null, InputOption::VALUE_NONE)
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

        $personManager = $this->getContainer()->get('base.soif.person_manager');

        $all = $input->getOption('all');

        $qb = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->createQueryBuilder('s')
        ;
        if (!$all) {
            $dateTime = new DateTime();
            $dateTime->setTime(0, 0, 0);
            $qb
                ->andWhere('s.soifUpdatedAt > :dateTime')
                ->setParameter('dateTime', $dateTime)
            ;

        }
        $persons = $qb->getQuery()->getResult();
        $films = array();
        foreach ($persons as $person) {
            $personManager->getById($person->getId());
            $films = array_merge($films, $personManager->getFilmsNotImported());
        }

        $filmManager = $this->getContainer()->get('base.soif.film_manager');
        foreach (array_unique($films) as $filmId) {
            $filmManager->getById($filmId);
        }
    }

    protected function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}