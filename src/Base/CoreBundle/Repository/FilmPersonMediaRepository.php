<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
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
    public function getMedias($search, $yearStart, $yearEnd)
    {
        $qb = $this->createQueryBuilder('fpm')
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

        return $qb->getQuery()->getResult();
    }

}