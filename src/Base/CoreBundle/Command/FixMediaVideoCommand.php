<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\OldMediaI18n;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class FixMediaVideoCommand extends ContainerAwareCommand
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var InputInterface
     */
    private $input;

    protected function configure()
    {
        $this
            ->setName('base:core:fix-video')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL)
            ->addOption('offset', null, InputOption::VALUE_OPTIONAL, null)
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;


        $id = $input->getOption('id');
        $offset = $input->getOption('offset');
        $limit = $input->getOption('limit');

        if ($id) {
            $mediaVideo = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaVideo')
                ->find($id)
            ;
            if ($mediaVideo instanceof MediaVideo) {
                foreach ($mediaVideo->getTranslations() as $mediaVideoTrans) {
                    if ($mediaVideoTrans instanceof MediaVideoTranslation) {
                        $this->createClone($mediaVideoTrans);
                    }
                }
            }
            $output->writeln("<info>Video $id has been checked</info>");
        } else {
            $mediaVideos = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaVideo')
                ->createQueryBuilder('m')
                ->andWhere('m.oldMediaId is not null')
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult()
            ;

            if ($mediaVideos) {
                $progress = new ProgressBar($output, count($mediaVideos));
                $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
                $progress->start();
                foreach ($mediaVideos as $mediaVideo) {
                    if (!($mediaVideo instanceof MediaVideo)) {
                        continue;
                    }
                    foreach ($mediaVideo->getTranslations() as $mediaVideoTrans) {
                        if ($mediaVideoTrans instanceof MediaVideoTranslation && $mediaVideoTrans->getFile()) {
                            $this->createClone($mediaVideoTrans);
                        }
                    }
                }

                $progress->finish();
                $output->writeln('<info>Done</info>');
            } else {
                $output->writeln('<info>Videos not found</info>');
            }

        }
    }

    private function createClone(MediaVideoTranslation $mediaVideoTrans)
    {
        if (strpos($mediaVideoTrans->getLocale(), 'clone') !== false) {
            return;
        }
        $clone = $mediaVideoTrans->getTranslatable()->findTranslationByLocale($mediaVideoTrans->getLocale() . '-clone');
        if ($clone) {
            return;
        }
        $reference = $this->getReference($mediaVideoTrans->getFile());
        $oldMediaI18n = $this->getOldMediai18n($mediaVideoTrans->getTranslatable()->getOldMediaId(), $mediaVideoTrans->getLocale());
        $origin = $this->getOldVideoPath($oldMediaI18n, $mediaVideoTrans->getLocale());
        dump('Origin : ' . $origin);
        dump('Reference: ' . $reference);
        if (!$origin || !$reference) {
            return;
        }

        $sizeOrigin = (int)filesize($origin);
        dump('Size Origin: '. $sizeOrigin);
        $sizeReference = (int)$this->getSize($reference);
        dump('Size Reference: '. $sizeReference);

        if (($sizeOrigin - $sizeReference) > 100) {
            $this->createMediaVideoTranslationClone($mediaVideoTrans, $origin);
        }
        unlink($origin);
    }

    private function getOldMediai18n($id, $locale)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:OldMediaI18n')
            ->findOneBy([
                'id'      => $id,
                'culture' => $locale == 'zh' ? 'cn' : $locale,
            ])
            ;
    }

    private function getOldVideoPath(OldMediaI18n $oldMediaI18n, $locale)
    {
        $file = null;
        if ($oldMediaI18n->getDeliveryUrl()) {
            $path = $oldMediaI18n->getDeliveryUrl();
            $pathArray = explode(',', $path);
            if (count($pathArray) > 2) {
                $path = $pathArray[0] . max(array_slice($pathArray, 1, count($pathArray) - 2)) . end($pathArray);
                $file = $this->createVideo('http://canneshd-a.akamaihd.net/' . trim($path));
            }
        }

        if (!$file && $oldMediaI18n->getHdFormatFilename()) {
            $path = $oldMediaI18n->getHdFormatFilename();
            if (false !== strpos($path, '.smil')) {
                $file = $this->getVideoFromSmil($path);
            } else {
                $file = $this->createVideo('http://canneshd-a.akamaihd.net/' . trim($path));
            }

        }

        if (!$file && $locale == 'fr') {
            $biOldMediaI18n = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:OldMediai18n')
                ->findOneBy(['culture' => 'bi', 'id' => $oldMediaI18n->getId()])
            ;
            if ($biOldMediaI18n && $biOldMediaI18n->getHdFormatFilename()) {
                try {
                    $url = 'http://www.festival-cannes.fr/' . $biOldMediaI18n->getHdFormatFilename();
                    $contentFile = file_get_contents($url);
                    $crawler = new Crawler($contentFile);
                    $base = $crawler->filter('meta[name=httpBase]')->last()->attr('content');
                    $filename = $crawler->filter('video')->last()->attr('src');
                    $file = $this->createVideo(trim($base) . trim($filename));
                } catch (\Exception $e) {
                    $this->output->writeln('<error>' . $e->getMessage() . '</error>');
                }
            }
        }

        if (!$file && $oldMediaI18n->getHdFormatFilename()) {
            try {
                $url = 'http://www.festival-cannes.fr/' . ltrim($oldMediaI18n->getHdFormatFilename(), '/');
                $contentFile = file_get_contents($url);
                $crawler = new Crawler($contentFile);
                $base = $crawler->filter('meta[name=httpBase]')->last()->attr('content');
                $filename = $crawler->filter('video')->last()->attr('src');
                $file = $this->createVideo(trim($base) . trim($filename));
            } catch (\Exception $e) {
                $this->output->writeln('<error>' . $e->getMessage() . '</error>');
            }
        }

        return $file;
    }

    private function getSize($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($ch);
        curl_close($ch);

        if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {

            // Contains file size in bytes
            $contentLength = (int)$matches[1];
            return $contentLength;
        }
        return false;
    }

    private function getReference(Media $file)
    {
        $provider = $this->getContainer()->get($file->getProviderName());
        $format = $provider->getFormatName($file, 'reference');
        return $provider->generatePublicUrl($file, $format);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }


    private function is404($url)
    {
        $headers = @get_headers($url);
        $httpStatus = intval(substr($headers[0], 9, 3));
        if ($httpStatus < 400) {
            return false;
        }
        return true;
    }

    private function getVideoFromSmil($smil)
    {
        try {
            $url = 'http://www.festival-cannes.fr/' . $smil;
            $contentFile = file_get_contents($url);
            $crawler = new Crawler($contentFile);
            $base = $crawler->filter('meta[name=httpBase]')->last()->attr('content');
            $filename = $crawler->filter('video')->last()->attr('src');
            $aBase = str_replace('canneshd-f', 'canneshd-a', $base);
            if (!$this->is404(trim($aBase) . trim($filename))) {
                $file = $this->createVideo(trim($aBase) . trim($filename));
            } else {
                $file = $this->createVideo(trim($base) . trim($filename));
            }

            return $file;
        } catch (\Exception $e) {
            $this->output->writeln('<error>' . $e->getMessage() . '</error>');
        }
    }

    /**
     * @param $url
     * @return null|string
     */
    private function createVideo($url)
    {
        $url = str_replace('canneshd-f', 'canneshd-a', $url);
        return $this->createFile($url, 'video');
    }

    /**
     * @param string $url
     * @param string $type
     * @return null|string
     */
    private function createFile($url, $type)
    {
        dump($url);
        if ($this->is404($url)) {
            return null;
        }
        $folder = $this->getContainer()->get('kernel')->getRootDir() . "/../web/uploads/old/$type/";
        exec("mkdir -p $folder");
        $file = md5($url) . '.' . pathinfo($url, PATHINFO_EXTENSION);

        if (is_file("$folder$file") && filesize("$folder$file")) {
            return $folder . $file;
        }

        set_time_limit(0);
        $fp = fopen("$folder$file", 'w+');
        $ch = curl_init(str_replace(" ", "%20", $url));
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            dump("cURL error ({$errno}):\n {$error_message}");
        }
        curl_close($ch);
        fclose($fp);

        if (!is_file($folder . $file) || !filesize("$folder$file")) {
            return null;
        }

        return $folder . $file;
    }


    private function createMediaVideoTranslationClone(MediaVideoTranslation $model, $file)
    {
        $clone = new MediaVideoTranslation();
        $clone
            ->setLocale($model->getLocale() . '-clone')
            ->setTranslatable($model->getTranslatable())
            ->setTitle($model->getTitle())
            ->setJobMp4State(MediaVideoTranslation::ENCODING_STATE_IN_PROGRESS)
            ->setJobWebmState(MediaVideoTranslation::ENCODING_STATE_IN_PROGRESS)
            ->setStatus($model->getStatus())
        ;
        $this->getDoctrineManager()->persist($clone);

        $media = new Media();
        $media->setName($model->getFile()->getName());
        $media->setBinaryContent($file);
        $media->setEnabled(true);
        $media->setProviderReference($model->getFile()->getName());
        $media->setContext('media_video');
        $media->setProviderStatus(1);
        $media->setProviderName('sonata.media.provider.video');
        if ($media->getId() == null) {
            $this->getMediaManager()->save($media);
        }
        $clone->setFile($media);

        $this->getDoctrineManager()->flush();

        return $clone;

    }


    /**
     * @return object|\Sonata\MediaBundle\Entity\MediaManager
     */
    public function getMediaManager()
    {
        return $this->getContainer()->get('sonata.media.manager.media');
    }
}