<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Persistence\ObjectManager;
use Sonata\MediaBundle\Entity\MediaManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportSelfkitPdfCommand extends ContainerAwareCommand
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
            ->setName('base:import:selfkit-pdf')
            ->addOption('count', null, InputOption::VALUE_NONE, 'Count element')
            ->addOption('page', null, InputOption::VALUE_OPTIONAL, 'Pagination')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'Film soif id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->input = $input;
        if ($input->getOption('page')) {
            $this->firstResult = ((int)$input->getOption('page') - 1) * $this->maxResults;
        }
        if ($input->getOption('count')) {
            $count = $this->importFilmPdfCount();
            $output->writeln("<info>There are <comment>$count</comment> PDF items for film to import</info>");
        } else if ($input->getOption('id')) {
            $this->importFilmPdf($input->getOption('id'));
        } else {
            $this->importFilmPdf();
        }

    }

    private function importFilmPdf($id = null)
    {
        if ($id) {
            $oldImages = [];
            $movie = $this->getManager()->getRepository('BaseCoreBundle:FilmFilm')->find($id);
            if ($movie) {
                $oldImages = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:OldFilmPhoto')
                    ->getLegacyFilmPdf($movie)
                ;
            }

        } else {
            $maxResults = null;
            if (null !== $this->firstResult) {
                $maxResults = $this->maxResults;
                $pages = ceil($this->importFilmPdfCount() / $maxResults);
                $this->output->writeln($this->input->getOption('page') . "/$pages");
            }
            $oldImages = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldFilmPhoto')
                ->getLegacyFilmPdf(null, $this->firstResult, $maxResults)
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
            $bar->advance();
            try {
                $film = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:FilmFilm')
                    ->find($oldImage->getIdfilm())
                ;

                $filename = $this->getUploadsDirectory() . $oldImage->getFichier();
                $remoteFilename = $this->getAmazonDirectory() . $oldImage->getFichier();

                if (!is_file($filename)) {
                    file_put_contents($filename, file_get_contents($remoteFilename));
                }
                if (!(@filesize($filename))) {
                    dump('Ignore ' . $filename);
                    continue;
                }
                $media = $this
                    ->getManager()
                    ->getRepository('ApplicationSonataMediaBundle:Media')
                    ->findOneBy(['oldMediaPhoto' => (string)$oldImage->getIdphoto()])
                ;
                if (!$media) {
                    $media = new Media();
                    $media->setContext('pdf');
                    $media->setProviderStatus(1);
                    $media->setProviderName('sonata.media.provider.pdf');
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
                    if (!$film->getSelfkitPdfFiles()->contains($media)) {
                        $film->addSelfkitPdfFile($media);
                        $this->getManager()->flush();
                    }
                }
            } catch (\Exception $e) {
                dump($e->getMessage());
            }
        }
        $bar->finish();
        $this->output->writeln('');
        $this->finalizeImport();
    }

    protected function importFilmPdfCount()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldFilmPhoto')
            ->getLegacyFilmPdfCount()
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
}