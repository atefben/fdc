<?php

namespace Base\CoreBundle\OldImport;

use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\OldMedia;
use Symfony\Component\Console\Helper\ProgressBar;

class MediaAudioImporter extends Importer
{
    protected $status = null;
    protected $setCorporate = true;

    public function importOneMediaAudio($id)
    {
        $this->getSiteEvent(true);
        $this->getSiteCorporate(true);
        $this->getDefaultTheme(true);

        $oldMedia = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->createQueryBuilder('m')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter(':file_class', self::MEDIA_TYPE_AUDIO)
            ->andWhere('m.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->importItem($oldMedia);
    }

    public function importMediaAudios($paginate = null)
    {
        $this->getSiteEvent(true);
        $this->getSiteCorporate(true);
        $this->getDefaultTheme(true);
        $this->output->writeln('<info>Import media audios...</info>');
        if ($paginate) {
            $this->output->writeln("<comment>Page $paginate</comment>");
            $pages = 1;
            $count = $this->countMediaAudios($paginate);
        } else {
            $count = $this->countMediaAudios();
            $pages = ceil($count / 100);
        }
        $progress = new ProgressBar($this->output, $count);
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();

        for ($page = 1; $page <= $pages; $page++) {
            $oldMedias = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:OldMedia')
                ->createQueryBuilder('m')
                ->andWhere('m.fileClass = :file_class')
                ->setParameter(':file_class', self::MEDIA_TYPE_AUDIO)
                ->setMaxResults(100)
                ->setFirstResult((($paginate ?: $page) - 1) * 100)
                ->getQuery()
                ->getResult()
            ;

            foreach ($oldMedias as $oldMedia) {
                $progress->advance();
                $this->importItem($oldMedia);
            }

            //$this->getManager()->clear();
            //unset($oldArticles);

            $this->getSiteEvent(true);
            $this->getSiteCorporate(true);
            $this->getDefaultTheme(true);
        }

        $progress->finish();
        $this->output->writeln('');

        return $this;
    }

    public function countMediaAudios($paginate = null)
    {
        $qb = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->createQueryBuilder('m')
            ->select('count(m)')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter(':file_class', self::MEDIA_TYPE_AUDIO)
        ;

        if ($paginate) {
            return count($qb
                ->select('m')
                ->setFirstResult(($paginate - 1) * 100)
                ->setMaxResults(100)
                ->getQuery()
                ->getResult()
            );
        }

        return $qb
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param OldMedia $oldMedia
     * @return MediaAudio
     */
    protected function importItem(OldMedia $oldMedia)
    {
        $mediaAudio = null;
        if ($this->isAvailable($oldMedia)) {
            foreach ($this->langs as $lang) {
                $mediaAudio = $this->createMediaAudioFromOldMedia($oldMedia->getId(), $lang, $this->status, $this->setCorporate);
            }
        }
        return $mediaAudio;
    }


    private function isAvailable(OldMedia $oldMedia)
    {
        if ($oldMedia->getPublished() == static::MEDIA_QUOTIDIEN_AUDIO) {
                $this->setCorporate = true;
                $this->status = null;
                return true;
        }
    }

}