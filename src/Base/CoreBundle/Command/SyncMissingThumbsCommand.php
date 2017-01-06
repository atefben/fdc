<?php

/*
 * This file is part of the Sonata package.
*
* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Sonata\MediaBundle\Command\BaseCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This command can be used to re-generate the thumbnails for all uploaded medias.
 * Useful if you have existing media content and added new formats.
 */
class SyncMissingThumbsCommand extends BaseCommand
{
    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this
            ->setName('base:media:sync-missing-thumbnails')
            ->setDescription('Sync missing uploaded image thumbs with new media formats')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->isLocked()) {
            $output->writeln('The sync is locked');
            die;
        }
        $this->lock();
        $this->output = $output;
        $medias = $this->getMedias();

        $progress = new ProgressBar($output, count($medias));
        $progress->start();
        foreach ($medias as $media) {
            $progress->advance();
            $provider = $this->getMediaPool()->getProvider($media->getProviderName());
            try {
                $provider->removeThumbnails($media);
            } catch (\Exception $e) {
                $this->log(sprintf('<error>Unable to remove old thumbnails, media: %s - %s </error>', $media->getId(), $e->getMessage()));
                continue;
            }

            try {
                $provider->generateThumbnails($media);
            } catch (\Exception $e) {
                $this->log(sprintf('<error>Unable to generated new thumbnails, media: %s - %s </error>', $media->getId(), $e->getMessage()));
                continue;
            }
            $media
                ->setIgnoreListener(true)
                ->setThumbsGenerated(true)
            ;
            $this->getDoctrineManager()->flush();
        }
        $progress->finish();
        $output->writeln('');
        $this->unlock();
    }

    /**
     * @return Media[]
     */
    private function getMedias()
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('ApplicationSonataMediaBundle:Media')
            ->findBy(['thumbsGenerated' => false], ['id' => 'desc'], 10)
            ;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this
            ->getContainer()
            ->get('doctrine')
            ->getManager()
            ;
    }

    /**
     * Write a message to the output.
     * @param string $message
     */
    protected function log($message)
    {
        $this->output->writeln($message);
    }

    /**
     * @return string
     */
    private function getLockFile()
    {
        return $this->getContainer()->get('kernel')->getRootDir() . '/../cron_thumbs_lock';
    }

    /**
     * @return string
     */
    private function isLocked()
    {
        return is_file($this->getLockFile()) && file_get_contents($this->getLockFile()) == '1';
    }

    /**
     * @return string
     */
    private function lock()
    {
        file_put_contents($this->getLockFile(), '1');
    }

    /**
     * @return string
     */
    private function unlock()
    {
        file_put_contents($this->getLockFile(), '0');
    }
}
