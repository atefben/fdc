<?php

namespace FDC\CorporateBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use FDC\CorporateBundle\Entity\CorpoMediaLibraryItem;


/**
 * Class CorpoMediaLibraryItemRepository
 * @package FDC\CorporateBundle\Repository
 */
class CorpoMediaLibraryItemRepository extends EntityRepository
{
    /**
     * @param $locale
     * @param $search
     * @param $image
     * @param $video
     * @param $audio
     * @param $yearStart
     * @param $yearEnd
     * @param int $page
     * @return CorpoMediaLibraryItem[]
     */
    public function getItems($locale, $search, $image, $video, $audio, $yearStart, $yearEnd, $page = 1)
    {
        $qb = $this
            ->createQueryBuilder('i')
            ->andWhere('i.festivalYear is not null')
        ;

        if ($locale) {
            $qb
                ->andWhere('i.locale = :locale or i.locale is null')
                ->setParameter(':locale', $locale)
            ;
        }

        if ($search) {
            $qb
                ->andWhere('i.search like :search')
                ->setParameter(':search', "%$search%")
            ;
        }

        if ($yearStart) {
            $qb
                ->andWhere('i.festivalYear >= :yearStart')
                ->setParameter(':yearStart', $yearStart)
            ;
        }

        if ($yearEnd) {
            $qb
                ->andWhere('i.festivalYear <= :yearEnd')
                ->setParameter(':yearEnd', $yearEnd)
            ;
        }

        if (!$image) {
            $qb
                ->andWhere('i.type != :image')
                ->setParameter(':image', 'image')
            ;
        }
        if (!$video) {
            $qb
                ->andWhere('i.type != :video')
                ->setParameter(':video', 'video')
            ;
        }
        if (!$audio) {
            $qb
                ->andWhere('i.type != :audio')
                ->setParameter(':audio', 'audio')
            ;
        }

        return $qb
            ->addOrderBy('i.sortedAt', 'desc')
            ->setMaxResults(31)
            ->setFirstResult(($page - 1) * 30)
            ->getQuery()
            ->getResult()
            ;
    }
}
