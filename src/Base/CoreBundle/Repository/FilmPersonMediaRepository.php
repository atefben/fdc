<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FilmPersonMediaRepository class.
 *
 * \@extends EntityRepository
 * @author   Stevens-Son ONEPHANDARA
 * \@company Ohwee
 */
class FilmPersonMediaRepository extends EntityRepository
{
    /**
     * @param $search
     * @param $yearStart
     * @param $yearEnd
     * @param $since
     * @return FilmPersonMedia[]
     */
    public function getMedias($search, $yearStart, $yearEnd, $since = null)
    {
        $qb = $this
            ->createQueryBuilder('fpm')
            ->innerJoin('fpm.media', 'fm')
            ->innerJoin('fpm.person', 'p')
            ->innerJoin('p.films', 'ffp')
            ->innerJoin('ffp.film', 'film')
            ->innerJoin('film.festival', 'festival')
            ->andWhere('p.firstname LIKE :search OR p.lastname LIKE :search OR p.asianName LIKE :search')
            ->setParameter('search', '%'.$search.'%');

        if($yearStart && $yearEnd) {
            $qb->andWhere('festival.year BETWEEN :yearStart AND :yearEnd')
                ->setParameter('yearStart', '%'.$yearStart.'%')
                ->setParameter('yearEnd', '%'.$yearEnd.'%')
            ;
        }

        if ($since) {
            $qb
                ->andWhere('fpm.updatedAt <= :since')
                ->setParameter(':since', $since)
            ;
        }

        return $qb
            ->addOrderBy('fpm.updatedAt', 'desc')
            ->getQuery()
            ->getResult();
    }

}