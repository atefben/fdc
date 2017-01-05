<?php

namespace Base\CoreBundle\OldImport;

use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\OldMedia;
use Symfony\Component\Console\Helper\ProgressBar;

class MediaImageImporter extends Importer
{
    protected $status = null;
    protected $setCorporate = true;

    public function importOneMediaImage($id)
    {
        $this->getSiteEvent(true);
        $this->getSiteCorporate(true);
        $this->getDefaultTheme(true);

        $oldMedia = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->createQueryBuilder('m')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter(':file_class', self::MEDIA_TYPE_IMAGE)
            ->andWhere('m.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->importItem($oldMedia);
    }

    public function importMediaImages($paginate = null)
    {
        $this->getSiteEvent(true);
        $this->getSiteCorporate(true);
        $this->getDefaultTheme(true);
        $this->output->writeln('<info>Import media images...</info>');
        if ($paginate) {
            $this->output->writeln("<comment>Page $paginate</comment>");
            $pages = 1;
            $count = $this->countMediaImages($paginate);
        } else {
            $count = $this->countMediaImages();
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
                ->setParameter(':file_class', self::MEDIA_TYPE_IMAGE)
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

    public function countMediaImages($paginate = null)
    {
        $qb = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->createQueryBuilder('m')
            ->select('count(m)')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter(':file_class', self::MEDIA_TYPE_IMAGE)
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
     * @return MediaImage
     */
    protected function importItem(OldMedia $oldMedia)
    {
        $mediaImage = null;
        if ($this->isAvailable($oldMedia)) {
            foreach ($this->langs as $lang) {
                $mediaImage = $this->createMediaImageFromOldMedia($oldMedia->getId(), $lang, $this->status, $this->setCorporate);
            }
        }
        return $mediaImage;
    }


    private function isAvailable(OldMedia $oldMedia)
    {
        if ($oldMedia->getPublished() == static::MEDIA_GALLERY_QUOTIDIEN_DIAPORAMA) {
            if ($oldMedia->getCreatedAt()->format('Y') >= 2007) {
                $this->status = null;
                $this->setCorporate = true;
                return true;
            } else {
                $this->status = null;
                $this->setCorporate = false;
                return true;
            }
        }
        if ($oldMedia->getPublished() == static::MEDIA_GALLERY_PHOTOGRAPHER_EYES) {
            if ($oldMedia->getId() >= 11802) {
                $this->status = null;
                $this->setCorporate = true;
                return true;
            } else {
                $this->status = null;
                $this->setCorporate = false;
                return true;
            }
        }
    }

}