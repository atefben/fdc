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
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SyncMissingThumbsCommand
 * @package Base\CoreBundle\Command
 */
class SyncThumbsSonataMediaCommand extends BaseCommand
{
    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this
            ->setName('base:media:sync-sonata-thumbnails')
            ->setDescription('Sync missing uploaded image thumbs with new media formats')
            ->addOption('first-result', null, InputOption::VALUE_OPTIONAL, 10)
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL, 10)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->input = $input;

        $medias = $this->getMedias();
        $progress = new ProgressBar($output, count($medias));
        $progress->start();
        foreach ($medias as $media) {
            $progress->advance();
            $provider = $this->getMediaPool()->getProvider($media->getProviderName());
            try {
                $provider->removeThumbnails($media);
            } catch (\Exception $e) {
                $message = 'Unable to remove old thumbnails, media: %s - %s';
                $logMessage = sprintf($message, $media->getId(), $e->getMessage());
                $this->log($e, $logMessage);
                continue;
            }

            try {
                $provider->generateThumbnails($media);
            } catch (\Exception $e) {
                $message = 'Unable to generated new thumbnails, media: %s - %s';
                $logMessage = sprintf($message, $media->getId(), $e->getMessage());
                $this->log($e, $logMessage);
            }

            $media
                ->setIgnoreListener(true)
                ->setThumbsGenerated(true)
            ;
            $this->getDoctrineManager()->flush();
        }
        $progress->finish();
        $output->writeln('');
    }

    /**
     * @return Media[]
     */
    private function getMedias()
    {
        $criteria = [];
        if ($this->input->getOption('id')) {
            $criteria['id'] = $this->input->getOption('id');
        }
        return $this
            ->getDoctrineManager()
            ->getRepository('ApplicationSonataMediaBundle:Media')
            ->findBy($criteria, null, $this->input->getOption('max-results'), $this->input->getOption('first-result'))
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
     * @param \Exception $e
     * @param $message
     */
    protected function log(\Exception $e, $message)
    {
        $this->output->writeln("<error>$message</error>");
        $monologMessage = 'Error message: ' . $message . PHP_EOL . 'Error Trace: ' . $e->getTraceAsString();
        $this->getContainer()->get('logger')->addError($monologMessage);
    }

    /**
     * @return string
     */
    private function getLockFile()
    {
        if ($this->input->getOption('from-bo')) {
            return $this->getContainer()->get('kernel')->getRootDir() . '/../cron_thumbs_bo_lock';
        }
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
