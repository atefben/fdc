<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\FilmFilm;
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

    private function importPersonImages()
    {
        $maxResults = null;
        if (null !== $this->firstResult) {
            $maxResults = $this->maxResults;
            $pages = ceil($this->importPersonImagesCount() / $maxResults);
            $this->output->writeln($this->input->getOption('page') . "/$pages");
        }
        $oldImages = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldFilmPhoto')
            ->getLegacyPersonImages(null, $this->firstResult, $maxResults)
        ;
        if (!$oldImages) {
            $this->output->writeln('<info>There is no images to import with these options</info>');
            return;
        }
        $this->output->writeln('<info>Import persons</info>');
        $bar = new ProgressBar($this->output, count($oldImages));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $bar->start();

        foreach ($oldImages as $oldImage) {
            try {
                $person = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:FilmPerson')
                    ->find($oldImage->getIdpersonne())
                ;
                $filename = $this->getUploadsDirectory() . $oldImage->getFichier();
                $ftpRemotFilename = $this->getFtpUrl() . $oldImage->getFichier();
                $remoteFilename = $this->getAmazonDirectory() . $oldImage->getFichier();

                if (!is_file($filename)) {
                    file_put_contents($filename, file_get_contents($ftpRemotFilename));
                    if (!(@is_array(getimagesize($filename)))) {
                        file_put_contents($filename, file_get_contents($remoteFilename));
                    }
                }
                if (!(@is_array(getimagesize($filename)))) {
                    $this->output->writeln(PHP_EOL . "<error>Cannot download  $filename</error>");
                    continue;
                }

                $bar->advance();

                $media = $this
                    ->getManager()
                    ->getRepository('ApplicationSonataMediaBundle:Media')
                    ->findOneBy(['oldMediaPhoto' => (string)$oldImage->getIdphoto()])
                ;
                if ($this->input->getOption('force-reupload') && $media && $person) {
                    if ($person->getSelfkitImages()->contains($media)) {
                        $person->removeSelfkitImage($media);
                        $this->getManager()->flush();
                    }
                    $media = null;
                }
                if (!$media) {
                    $media = new Media();
                    $media->setContext('film_director');
                    $media->setProviderStatus(1);
                    $media->setProviderName('sonata.media.provider.image');
                    $media->setCreatedAt($oldImage->getDatemodification() ?: $oldImage->getDatecreation());
                    $media->setUpdatedAt($oldImage->getDatemodification() ?: $oldImage->getDatecreation());
                    $media->setBinaryContent($filename);
                    $media->setEnabled(true);
                    $media->setOldMediaPhoto((string)$oldImage->getIdphoto());
                    $media->setOldMediaPhotoType($oldImage->getIdtypephoto());
                    $media->setOldMediaPhotoJury($oldImage->getIdjury());
                    $media->setCopyright($oldImage->getCopyright());
                } elseif ($this->input->getOption('force-reupload')) {
                    $media->setBinaryContent($filename);
                    $media->setThumbsGenerated(false);
                }
                $media->setName($oldImage->getTitre());
                $media->setOldMediaFilm($oldImage->getIdfilm());
                $media->setProviderReference($oldImage->getTitre());
                $this->getMediaManager()->save($media, false);
                if ($person) {
                    if (!$person->getSelfkitImages()->contains($media)) {
                        $person->addSelfkitImage($media);
                        $this->getManager()->flush();
                    }
                }
            } catch (\Exception $e) {
                $this->output->writeln('<error>' . $e->getMessage() . '</error>');
            }
        }
        $bar->finish();
        $this->output->writeln('');
        $this->finalizeImport();
    }

    private function importPersonImagesCount()
    {
        return $count = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldFilmPhoto')
            ->getLegacyPersonImagesCount()
            ;
    }

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
                $this->output->writeln($this->input->getOption('page') . "/$pages");
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
        $bar = new ProgressBar($this->output, count($oldImages));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $bar->start();

        foreach ($oldImages as $oldImage) {
            try {
                $film = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:FilmFilm')
                    ->find($oldImage->getIdfilm())
                ;
                if ($oldImage->getIdpersonne() && $this->isDirector($oldImage->getIdpersonne(), $film)) {
                    $this->output->writeln(PHP_EOL . "<error>Director Image: $filename</error>");
                    continue;
                }

                $filename = $this->getUploadsDirectory() . $oldImage->getFichier();
                $ftpRemotFilename = $this->getFtpUrl() . $oldImage->getFichier();
                $remoteFilename = $this->getAmazonDirectory() . $oldImage->getFichier();

                if (!is_file($filename)) {
                    file_put_contents($filename, file_get_contents($ftpRemotFilename));
                    if (!(@is_array(getimagesize($filename)))) {
                        file_put_contents($filename, file_get_contents($remoteFilename));
                    }
                }
                if (!(@is_array(getimagesize($filename)))) {
                    $this->output->writeln(PHP_EOL . "<error>Cannot download  $filename</error>");
                    continue;
                }

                $bar->advance();

                $media = $this
                    ->getManager()
                    ->getRepository('ApplicationSonataMediaBundle:Media')
                    ->findOneBy(['oldMediaPhoto' => (string)$oldImage->getIdphoto()])
                ;
                if ($this->input->getOption('force-reupload') && $media && $film) {
                    if ($film->getSelfkitImages()->contains($media)) {
                        $film->removeSelfkitImage($media);
                        $this->getManager()->flush();
                    }
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
                    $media->setOldMediaPhoto((string)$oldImage->getIdphoto());
                    $media->setOldMediaPhotoType($oldImage->getIdtypephoto());
                    $media->setOldMediaPhotoJury($oldImage->getIdjury());
                    $media->setCopyright($oldImage->getCopyright());
                }

                $media->setName($oldImage->getTitre());
                $media->setProviderReference($oldImage->getTitre());
                $this->getMediaManager()->save($media, false);
                if ($film) {
                    if (!$film->getSelfkitImages()->contains($media)) {
                        $film->addSelfkitImage($media);
                        $this->getManager()->flush();
                    }
                }
                unlink($filename);
            } catch (\Exception $e) {
                dump($e->getMessage());
            }
        }
        $bar->finish();
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
    public function isDirector($idPerson, FilmFilm $movie)
    {
        foreach ($movie->getDirectors(true) as $director) {
            if ($director instanceof FilmFilmPerson) {
                if ($idPerson == $director->getPerson()->getId()) {
                    return true;
                }
            }
        }
    }
}