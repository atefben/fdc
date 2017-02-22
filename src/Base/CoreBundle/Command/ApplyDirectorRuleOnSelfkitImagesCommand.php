<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmPerson;
use Base\CoreBundle\Entity\FilmPerson;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ApplyDirectorRuleOnSelfkitImagesCommand extends ContainerAwareCommand
{

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var int|null
     */
    protected $firstResult;

    /**
     * @var int
     */
    protected $maxResults = 100;

    protected function configure()
    {
        $this
            ->setName('base:import:selfkit-director-rules')
            ->addOption('count-movies', null, InputOption::VALUE_NONE)
            ->addOption('page', null, InputOption::VALUE_OPTIONAL, 'Get 100 movies per page')
            ->addOption('remove', null, InputOption::VALUE_NONE)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        if ($input->getOption('remove')) {
            $this->remove();
            die;
        }


        if ($input->getOption('count-movies')) {
            $output->writeln('<info>' . $this->countMovies() . ' movies found</info>');
        } else {

            $movies = $this->getMovies($input->getOption('page'));
            $bar = new ProgressBar($output, count($movies));
            $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
            $bar->start();
            foreach ($movies as $movie) {
                $bar->advance();
                $this->processMovie($movie);
            }
            $bar->finish();
            $output->writeln('');
        }
    }

    private function processMovie(FilmFilm $movie)
    {
        foreach ($movie->getSelfkitImages() as $selfkitImage) {
            if ($selfkitImage instanceof Media) {
                if ($selfkitImage->getOldMediaPhoto()) {
                    $persons = $this->getPersonsMedia($selfkitImage->getOldMediaPhoto());
                    if ($persons) {
                        foreach ($persons as $person) {
                            foreach ($movie->getDirectors(true) as $director) {
                                if ($director instanceof FilmFilmPerson) {
                                    if ($person->getId() == $director->getPerson()->getId()) {
                                        $movie->removeSelfkitImage($selfkitImage);
                                        $message = 'removed for ' . ((string)$person) . ' in ' . $movie->getTitleVO() .
                                            ' (' . $movie->getId() . ', ' . $movie->getSlug() . ')';
                                        $this->output->writeln('');
                                        $this->output->writeln("<info>$message</info>");
                                        $this->output->writeln('');
                                        $this->getDoctrineManager()->flush();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param $oldMediaId
     * @return FilmPerson[]
     */
    private function getPersonsMedia($oldMediaId)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->createQueryBuilder('fp')
            ->innerJoin('fp.selfkitImages', 'sf')
            ->andWhere('size(fp.selfkitImages) > 0')
            ->andWhere('sf.oldMediaPhoto = :oldMediaId')
            ->setParameter(':oldMediaId', $oldMediaId)
            ->getQuery()
            ->getResult()
            ;

    }

    /**
     * @return int
     */
    private function countMovies()
    {
        return (int)$this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->createQueryBuilder('f')
            ->select('count(f)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param $page
     * @return FilmFilm[]
     */
    private function getMovies($page)
    {
        $maxResults = null;
        $firstResult = null;
        if ($page) {
            $maxResults = 100;
            $firstResult = ($page - 1) * $maxResults;
        }

        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->findBy([], null, $maxResults, $firstResult)
            ;;

    }


    /**
     * @return ObjectManager
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }


    private function remove()
    {
        $persons = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmPerson')
            ->findBy([], null, 100, ($page -1 )*100);
        $bar = new ProgressBar($this->output, count($persons));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();
        $flush = false;
        foreach ($persons as $person) {
            foreach ($person->getSelfkitImages() as $selfkitImage) {
                if (!$this->isOldInternet($selfkitImage)) {
                    $person->removeSelfkitImage($selfkitImage);
                    $this->getDoctrineManager()->remove($selfkitImage);
                    $flush = true;
                }
            }
            if ($flush) {
                $this->getDoctrineManager()->flush();
                $flush = false;
            }
        }
    }

    private function isOldInternet(Media $media)
    {
        $old = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:OldFilmPhoto')
            ->findOneBy(['idphoto' => $media->getOldMediaPhoto()])
        ;
        if ($old) {
            return $old->getInternet() == 'O';
        }
    }
}