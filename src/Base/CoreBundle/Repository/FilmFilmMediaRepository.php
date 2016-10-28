<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FilmFilmMediaRepository class.
 *
 * \@extends EntityRepository
 * @author   Stevens-Son ONEPHANDARA
 * \@company Ohwee
 */
class FilmFilmMediaRepository extends EntityRepository
{
    public function getMedias($search, $yearStart, $yearEnd)
    {
        $qb = $this->createQueryBuilder('ffm')
            ->leftJoin('ffm.media', 'fm')
            ->leftJoin('ffm.film', 'f')
            ->leftJoin('f.translations', 'ft')
            ->andWhere('ffm.media IS NOT NULL')
            ->andWhere('ffm.film IS NOT NULL')
            ->andWhere('f.titleVO LIKE :search OR ft.title LIKE :search OR fm.titleVf LIKE :search OR fm.titleVa LIKE :search')
            ->setParameter('search', '%'.$search.'%');

        if($yearStart && $yearEnd) {
            $qb->andWhere('ffm.createdAt BETWEEN :yearStart AND :yearEnd')
                ->setParameter('yearStart', '%'.$yearStart.'%')
                ->setParameter('yearEnd', '%'.$yearEnd.'%')
            ;
        }

        return $qb->getQuery()->getResult();
    }

}