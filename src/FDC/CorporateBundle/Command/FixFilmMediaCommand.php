<?php

namespace FDC\CorporateBundle\Command;

use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixFilmMediaCommand extends ContainerAwareCommand
{

    /**
     * @var InputInterface
     */
    private $input;

    protected function configure()
    {

        $this
            ->setName('corpo:fix:film:media')
            ->addOption('first-result', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $filmMedias = $this->getFilmMedias();
        if ($filmMedias) {
            $progress = new ProgressBar($output, count($filmMedias));
            $progress->advance();

            foreach ($filmMedias as $filmMedia) {
                $id = $filmMedia->getId();
                $progress->advance();
                if (!$filmMedia->getFile() || $filmMedia->getFile()->getContext() === 'pdf') {
                    continue;
                }
                $url = $this->getMediaPublicUrl($filmMedia->getFile(), 'reference');
                dump($url);
                dump($id);
                if ($this->is404($url)) {
                    $films = [];
                    foreach ($filmMedia->getFilmMedias() as $filmFilmMedia) {
                        if ($filmFilmMedia instanceof FilmFilmMedia) {
                            if ($filmFilmMedia->getFilm() && in_array($filmFilmMedia->getFilm()->getId(), $films)) {
                                $films[] = $filmFilmMedia->getFilm()->getId();
                                $this->getDoctrineManager()->remove($filmFilmMedia);
                            }
                        }
                    }
                    $persons = [];
                    foreach ($filmMedia->getPersonMedias() as $filmPersonMedia) {
                        if ($filmPersonMedia instanceof FilmPersonMedia) {
                            if ($filmPersonMedia->getPerson() && in_array($filmPersonMedia->getPerson()->getId(), $persons)) {
                                $persons[] = $filmPersonMedia->getPerson()->getId();
                                $this->getDoctrineManager()->remove($filmFilmMedia);
                            }
                        }
                    }
                    $this->getDoctrineManager()->remove($filmMedia->getFile());
                    $this->getDoctrineManager()->remove($filmMedia);

                    foreach ($films as $film) {
                        $this->getFilm($film);
                    }
                    foreach ($persons as $person) {
                        $this->getFilm($person);
                    }
                }
            }

            $progress->finish();
            $output->writeln('');
        } else {
            $output->writeln('No film medias to update');
        }
    }

    private function getFilmMedias()
    {
        $criteria = [];
        if ($this->input->getOption('id')) {
            $criteria['id'] = $this->input->getOption('id');
        }
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmMedia')
            ->findBy($criteria, null, $this->input->getOption('first-result'), $this->input->getOption('max-results'))
            ;
    }


    /**
     * @return ObjectManager
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    /**
     * @param $media
     * @param $format
     * @return mixed
     */
    private function getMediaPublicUrl($media, $format)
    {
        $provider = $this->getContainer()->get($media->getProviderName());

        return $provider->generatePublicUrl($media, $format);
    }

    private function is404($url)
    {
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        /* If the document has loaded successfully without any redirection or error */
        if ($httpCode >= 200 && $httpCode < 300) {
            return false;
        } else {
            return true;
        }
    }

    private function getFilm($id)
    {
        $manager = $this->getContainer()->get('base.soif.film_manager');
        $manager->getById($id);
    }

    private function getPerson($id)
    {
        $manager = $this->getContainer()->get('base.soif.person_manager');
        $manager->getById($id);
    }

}