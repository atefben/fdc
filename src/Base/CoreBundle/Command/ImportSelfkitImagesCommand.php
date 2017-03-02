<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmPerson;
use Base\CoreBundle\Entity\OldFilmPhoto;
use Doctrine\Common\Persistence\ObjectManager;
use Sonata\MediaBundle\Entity\MediaManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportSelfkitImagesCommand extends ContainerAwareCommand
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
            ->setName('base:import:selfkit-images')
            ->addOption('force-reupload', null, InputOption::VALUE_NONE, 'Force repload')
            ->addOption('films', null, InputOption::VALUE_NONE, 'Only films')
            ->addOption('persons', null, InputOption::VALUE_NONE, 'Only films')
            ->addOption('count', null, InputOption::VALUE_NONE, 'Count element (works if film or persons is selected)')
            ->addOption('page', null, InputOption::VALUE_OPTIONAL, 'Pagination (works if film or persons is selected)')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'Film or Person soif id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->input = $input;
        if ($input->getOption('page')) {
            $this->firstResult = ((int)$input->getOption('page') - 1) * $this->maxResults;
        }
        if ($input->getOption('persons')) {
            if ($input->getOption('count')) {
                $count = $this->importPersonImagesCount();
                $output->writeln("<info>There are <comment>$count</comment> OldFilmPhoto items for persons to import</info>");
            } else if ($input->getOption('id')) {
                $this->importPersonImages($input->getOption('id'));
            } else {
                $this->importPersonImages();
            }
        } elseif ($input->getOption('films')) {
            if ($input->getOption('count')) {
                $count = $this->importFilmImagesCount();
                $output->writeln("<info>There are <comment>$count</comment> OldFilmPhoto items  for film to import</info>");
            } else if ($input->getOption('id')) {
                $this->importFilmImages($input->getOption('id'));
            } else {
                $this->importFilmImages();
            }
        } else {
            $this->importPersonImages();
            $this->importFilmImages();
        }

    }

    private function importPersonImages($id = null)
    {
        if ($id) {
            $oldImages = [];
            $person = $this->getManager()->getRepository('BaseCoreBundle:FilmPerson')->find($id);
            if ($person) {
                $oldImages = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:OldFilmPhoto')
                    ->getLegacyPersonImages($person)
                ;
            }

        } else {
            $maxResults = null;
            if (null !== $this->firstResult) {
                $maxResults = $this->maxResults;
                $pages = ceil($this->importPersonImagesCount() / $maxResults);
            }
            $oldImages = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldFilmPhoto')
                ->getLegacyPersonImages(null, $this->firstResult, $maxResults)
            ;
        }

        if (!$oldImages) {
            $this->output->writeln('<info>There is no images to import with these options</info>');
            return;
        }
        $this->output->writeln('<info>Import persons</info>');
        $count = count($oldImages);
        $i = 1;
        foreach ($oldImages as $oldImage) {
            $this->output->writeln(PHP_EOL . str_repeat('=', 80));
            if ($this->input->getOption('page') && !empty($pages)) {
                $this->output->writeln('Page '.$this->input->getOption('page') . "/$pages");
            }
            $message = "$i / $count";
            $this->output->writeln("<info>$message</info>");
            try {
                $this->getMediaFromOldFilmPhoto($oldImage);
            } catch (\Exception $e) {
                $this->output->writeln('<error>' . $e->getMessage() . '</error>');
            }
            $i++;
        }
        $this->output->writeln('');
        $this->finalizeImport();
    }

    /**
     * @return int
     */
    private function importPersonImagesCount()
    {
        return $count = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldFilmPhoto')
            ->getLegacyPersonImagesCount()
            ;
    }

    /**
     * @param null $id
     */
    private function importFilmImages($id = null)
    {
        if ($id) {
            $oldImages = [];
            $movie = $this->getManager()->getRepository('BaseCoreBundle:FilmFilm')->find($id);
            if ($movie) {
                $oldImages = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:OldFilmPhoto')
                    ->getLegacyFilmImages($movie)
                ;
            }
        } else {
            $maxResults = null;
            if (null !== $this->firstResult) {
                $maxResults = $this->maxResults;
                $pages = ceil($this->importFilmImagesCount() / $maxResults);
            }
            $oldImages = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldFilmPhoto')
                ->getLegacyFilmImages(null, $this->firstResult, $maxResults)
            ;

            if (!$oldImages) {
                $this->output->writeln('<info>There is no images to import with these options</info>');
                return;
            }
        }
        $this->output->writeln('<info>Import films</info>');

        $count = count($oldImages);
        $i = 1;
        foreach ($oldImages as $oldImage) {
            $this->output->writeln(PHP_EOL . str_repeat('=', 80));
            if ($this->input->getOption('page') && !empty($pages)) {
                $this->output->writeln('Page '.$this->input->getOption('page') . "/$pages");
            }
            $message = "$i / $count";
            $this->output->writeln("<info>$message</info>");
            try {
                $this->getMediaFromOldFilmPhoto($oldImage);
            } catch (\Exception $e) {
                $this->output->writeln('<error>' . $e->getMessage() . '</error>');
            }
            $i++;
        }
        $this->output->writeln('');
        $this->finalizeImport();
    }

    protected function importFilmImagesCount()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldFilmPhoto')
            ->getLegacyFilmImagesCount()
            ;
    }

    /**
     * @return MediaManager
     */
    public function getMediaManager()
    {
        return $this->getContainer()->get('sonata.media.manager.media');
    }


    /**
     * @return ObjectManager
     */
    private function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    /**
     * @return string
     */
    private function getAmazonDirectory()
    {
        return $this->getContainer()->getParameter('selfkit_amazon_url_hd');
    }

    /**
     * @return string
     */
    private function getFtpUrl()
    {
        return 'ftp://Site_internet:inter8963@ftp2.cannesinteractive.com/SELFKIT/Presse/';
    }

    /**
     * @return string
     */
    private function getUploadsDirectory()
    {
        $directory = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/selfkits/';

        if (!is_dir($directory)) {
            mkdir($directory);
        }

        return $directory;
    }

    private function finalizeImport()
    {
        $sql = 'update media__media m ' .
            'INNER join old_FILM_PHOTO p on p.IDPHOTO = m.old_media_photo SET' .
            ' m.created_at = p.DATECREATION, m.updated_at = p.DATEMODIFICATION';
        $stmt = $this
            ->getContainer()
            ->get('database_connection')
            ->prepare($sql)
        ;
        return $stmt->execute();
    }

    /**
     * @param $idPerson
     * @param FilmFilm $movie
     * @return bool
     */
    private function isDirector($idPerson, FilmFilm $movie)
    {
        foreach ($movie->getDirectors(true) as $director) {
            if ($director instanceof FilmFilmPerson) {
                if ($idPerson == $director->getPerson()->getId()) {
                    return true;
                }
            }
        }
    }

    private function getMediaFromOldFilmPhoto(OldFilmPhoto $old)
    {
        $filename = $this->getUploadsDirectory() . $old->getFichier();
        $ftpRemoteFilename = $this->getFtpUrl() . $old->getFichier();
        $remoteFilename = $this->getAmazonDirectory() . $old->getFichier();

        if (!is_file($filename)) {
            @file_put_contents($filename, file_get_contents($ftpRemoteFilename));
            if (!(@is_array(getimagesize($filename)))) {
                @file_put_contents($filename, file_get_contents($remoteFilename));
            }
        }
        if (!(@is_array(getimagesize($filename)))) {
            $this->output->writeln(PHP_EOL . "<error>Cannot download  $filename</error>");
            return null;
        }

        $media = $this
            ->getManager()
            ->getRepository('ApplicationSonataMediaBundle:Media')
            ->findOneBy(['oldMediaPhoto' => (string)$old->getIdphoto()])
        ;

        if ($this->input->getOption('force-reupload') && $media) {
            foreach ($media->getSelfkitFilms() as $selfkitFilm) {
                $media->removeSelfkitFilm($selfkitFilm);
            }
            foreach ($media->getSelfkitPersons() as $selfkitPerson) {
                $media->removeSelfkitPerson($selfkitPerson);
            }
            $this->getManager()->remove($media);
            $this->getManager()->flush();
            $media = null;
        }

        if (!$media) {
            $media = new Media();
            $media->setContext('film_film');
            $media->setProviderStatus(1);
            $media->setProviderName('sonata.media.provider.image');
            $media->setCreatedAt(new \DateTime());
            $media->setBinaryContent($filename);
            $media->setEnabled(true);
            $media->setOldMediaPhoto((string)$old->getIdphoto());
            $media->setOldMediaPhotoType($old->getIdtypephoto());
            $media->setOldMediaPhotoJury($old->getIdjury());
            $media->setCopyright($old->getCopyright());
        }

        $media->setName($old->getTitre());
        $media->setProviderReference($old->getTitre());
        $this->getMediaManager()->save($media, false);
        unlink($filename); // remove original file

        $provider = $this->getContainer()->get($media->getProviderName());
        $format = $provider->getFormatName($media, 'reference');
        $url = $provider->generatePublicUrl($media, $format);

        if ((@is_array(getimagesize($url)))) {
            $this->applyAssociation($media, $old);
            $this->generatePresets($media);
            $this->getManager()->flush();
            return $media;
        } else {
            $this->getManager()->remove($media);
            $this->getManager()->flush();
        }
    }

    private function applyAssociation(Media $media, OldFilmPhoto $old)
    {
        $film = $this->getFilm($old->getIdfilm());
        $person = $this->getPerson($old->getIdpersonne());
        if ($person && $film && !$this->isDirector($person, $film) && !$media->getSelfkitFilms()->contains($film)) {
            $media->addSelfkitFilm($film);
        } else if ($film && !$media->getSelfkitFilms()->contains($film)) {
            $media->addSelfkitFilm($film);
        }

        if ($person && !$media->getSelfkitPersons()->contains($person)) {
            $media->addSelfkitPerson($person);
        }
    }

    /**
     * @param $id
     * @return FilmFilm|null|object
     */
    private function getFilm($id)
    {
        if ($id) {
            return $this->getManager()->getRepository('BaseCoreBundle:FilmFilm')->find($id);
        }
    }

    /**
     * @param $id
     * @return FilmPerson|null|object
     */
    private function getPerson($id)
    {
        if ($id) {
            return $this->getManager()->getRepository('BaseCoreBundle:FilmPerson')->find($id);
        }
    }

    private function generatePresets(Media $media)
    {
        $provider = $this->getMediaPool()->getProvider($media->getProviderName());
        try {
            $provider->removeThumbnails($media);
        } catch (\Exception $e) {
            $message = 'Unable to remove old thumbnails, media: %s - %s';
            $logMessage = sprintf($message, $media->getId(), $e->getMessage());
            $this->output->writeln("<error>$logMessage</error>");
        }

        try {
            $this->output->writeln("<info>Generate preset for media {$media->getId()}</info>");
            $provider->generateThumbnails($media);
        } catch (\Exception $e) {
            $message = 'Unable to generated new thumbnails, media: %s - %s';
            $logMessage = sprintf($message, $media->getId(), $e->getMessage());
            $this->output->writeln("<error>$logMessage</error>");
        }

        $media
            ->setIgnoreListener(true)
            ->setThumbsGenerated(true)
        ;
        $this->getManager()->flush();
    }

    public function getMediaPool()
    {
        return $this->getContainer()->get('sonata.media.pool');
    }
}