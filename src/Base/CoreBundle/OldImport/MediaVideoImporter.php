<?php

namespace Base\CoreBundle\OldImport;

use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated;
use Base\CoreBundle\Entity\OldMedia;
use Symfony\Component\Console\Helper\ProgressBar;

class MediaVideoImporter extends Importer
{
    protected $status = null;
    protected $setCorporate = true;

    public function importOneMediaVideo($id)
    {
        $this->getSiteEvent(true);
        $this->getSiteCorporate(true);
        $this->getDefaultTheme(true);

        $oldMedia = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->createQueryBuilder('m')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter(':file_class', self::MEDIA_TYPE_VIDEO)
            ->andWhere('m.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->importItem($oldMedia);
    }

    public function importMediaVideos($paginate = null)
    {
        $this->getSiteEvent(true);
        $this->getSiteCorporate(true);
        $this->getDefaultTheme(true);
        $this->output->writeln('<info>Import media videos...</info>');
        if ($paginate) {
            $this->output->writeln("<comment>Page $paginate</comment>");
            $pages = 1;
            $count = $this->countMediaVideos($paginate);
        } else {
            $count = $this->countMediaVideos();
            $pages = ceil($count / 10);
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
                ->setParameter(':file_class', self::MEDIA_TYPE_VIDEO)
                ->setMaxResults(10)
                ->setFirstResult((($paginate ?: $page) - 1) * 10)
                ->getQuery()
                ->getResult()
            ;

            foreach ($oldMedias as $oldMedia) {
                $progress->advance();
                $this->importItem($oldMedia);
            }

            $this->getSiteEvent(true);
            $this->getSiteCorporate(true);
            $this->getDefaultTheme(true);
        }

        $progress->finish();
        $this->output->writeln('');

        return $this;
    }

    public function countMediaVideos($paginate = null)
    {
        $qb = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->createQueryBuilder('m')
            ->select('count(m)')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter(':file_class', self::MEDIA_TYPE_VIDEO)
        ;

        if ($paginate) {
            return count($qb
                ->select('m')
                ->setFirstResult(($paginate - 1) * 10)
                ->setMaxResults(10)
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
     * @return MediaVideo
     */
    protected function importItem(OldMedia $oldMedia)
    {
        $mediaVideo = null;
        if ($this->isAvailable($oldMedia)) {
            foreach ($this->langs as $lang) {
                $mediaVideo = $this->createMediaVideoFromOldMedia($oldMedia->getId(), $lang, $this->status, $this->setCorporate);
                if ($mediaVideo) {
                    $this->associateFilms($mediaVideo, $oldMedia);
                }
            }
        }
        return $mediaVideo;
    }

    protected function associateFilms(MediaVideo $mediaVideo, OldMedia $oldMedia)
    {
        $associatedFilms = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMediaAssociation')
            ->findBy([
                'id' => $oldMedia->getId(),
                'objectClass' => 'Film',
            ])
        ;

        foreach ($associatedFilms as $associatedFilm) {
            $movie = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->find($associatedFilm->getObjectId())
            ;
            if (!$movie) {
                continue;
            }
            $associatedMediaVideo = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:MediaVideoFilmFilmAssociated')
                ->findOneBy([
                    'mediaVideo'  => $mediaVideo->getId(),
                    'association' => $movie->getId(),
                ])
            ;

            if (!$associatedMediaVideo) {
                $associatedMediaVideo = new MediaVideoFilmFilmAssociated();
                $associatedMediaVideo
                    ->setAssociation($movie)
                    ->setMediaVideo($mediaVideo)
                ;
                $this->getManager()->persist($associatedMediaVideo);
            }
            $this->getManager()->flush();
        }
    }


    private function isAvailable(OldMedia $oldMedia)
    {
        $isQuotidien = $oldMedia->getIsOnline() == static::MEDIA_QUOTIDIEN_VIDEO;
        $trailerIds = [2, 3, 4, 5];
        if (in_array($oldMedia->getVideoType(), $trailerIds) || $isQuotidien) {
                $this->setCorporate = true;
                $this->status = null;
                return true;
        }
    }

}