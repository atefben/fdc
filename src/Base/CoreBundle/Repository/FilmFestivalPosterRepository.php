<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFestivalPoster;

/**
 * Class FilmFestivalPosterRepository
 * @package Base\CoreBundle\Repository
 */
class FilmFestivalPosterRepository extends EntityRepository
{
    /**
     * @param $locale
     * @param $search
     * @param $yearStart
     * @param $yearEnd
     * @param $since
     * @return FilmFestivalPoster[]
     */
    public function getMedias($locale, $search, $yearStart, $yearEnd, $since = null)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->distinct()
            ->innerJoin('fp.festival', 'f')
            ->innerJoin('fp.translations', 't')
            ->andWhere('f.year BETWEEN :yearStart AND :yearEnd')
            ->setParameter('yearStart', $yearStart)
            ->setParameter('yearEnd', $yearEnd)
        ;

        if ($search) {
            $qb
                ->andWhere('t.locale = :locale')
                ->setParameter(':locale', $locale)
                ->andWhere('t.title LIKE :search OR t.description = :search')
                ->setParameter('search', '%' . $search . '%')
            ;
        }

        if ($since) {
            $qb
                ->andWhere('fp.updatedAt <= :since')
                ->setParameter(':since', $since)
            ;
        }

        return $qb
            ->addOrderBy('fp.updatedAt', 'desc')
            ->getQuery()
            ->getResult()
            ;
    }
}