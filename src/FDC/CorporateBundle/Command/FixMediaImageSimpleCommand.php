<?php

namespace FDC\CorporateBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaImageSimpleTranslation;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixMediaImageSimpleCommand extends ContainerAwareCommand
{

    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $output;

    protected function configure()
    {

        $this
            ->setName('corpo:fix:media:image-simple')
            ->addOption('first-result', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->input = $input;
        $this->output = $output;
        $medias = $this->getMediaImages();
        if ($medias) {
            $progress = new ProgressBar($output, count($medias));
            $progress->start();

            foreach ($medias as $media) {
                $progress->advance();
                foreach ($media->getTranslations() as $mediaTrans) {
                    if ($mediaTrans instanceof MediaImageSimpleTranslation && $mediaTrans->getFile()) {
                        $file = $mediaTrans->getFile();
                        $url = $this->getMediaPublicUrl($file, 'reference');
                        $urlProd = str_replace('preprod', 'prod', $url);
                        if ($this->is404($url) && !$this->is404($urlProd)) {
                            $path = $this->getUploadsDirectory() . basename($urlProd);
                            @file_put_contents($path, file_get_contents($urlProd));
                            if (@is_array(getimagesize($path))) {
                                $newFile = new Media();
                                $newFile->setContext($file->getContext());
                                $newFile->setProviderStatus($file->getProviderStatus());
                                $newFile->setProviderName($file->getProviderName());
                                $newFile->setCreatedAt(new \DateTime());
                                $newFile->setBinaryContent($path);
                                $newFile->setEnabled(true);
                                $newFile->setCopyright($file->getCopyright());

                                $this->getDoctrineManager()->persist($newFile);
                                $this->getDoctrineManager()->flush();
                                $mediaTrans->setFile($newFile);
                                $this->generatePresets($newFile);
                                $this->getDoctrineManager()->remove($file);
                                $this->getDoctrineManager()->flush();
                            }
                            unlink($path);
                        }
                    }
                }
            }

            $progress->finish();
            $output->writeln('');
        } else {
            $output->writeln('No medias image to update');
        }
    }

    private function getMediaImages()
    {
        $criteria = [];
        if ($this->input->getOption('id')) {
            $criteria['id'] = $this->input->getOption('id');
        }
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaImageSimple')
            ->findBy($criteria, null, $this->input->getOption('max-results'), $this->input->getOption('first-result'))
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

    /**
     * @return string
     */
    private function getUploadsDirectory()
    {
        $directory = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/mediaTemp/';

        if (!is_dir($directory)) {
            mkdir($directory);
        }

        return $directory;
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
        $this->getDoctrineManager()->flush();
    }

    public function getMediaPool()
    {
        return $this->getContainer()->get('sonata.media.pool');
    }

}