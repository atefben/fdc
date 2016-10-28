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
            ->leftJoin('fpm.media', 'fm')
            ->leftJoin('fpm.person', 'p')
            ->leftJoin('p.translations', 'pt')
            ->andWhere('fpm.media IS NOT NULL')
            ->andWhere('fpm.person IS NOT NULL')
            ->andWhere('p.firstname LIKE :search OR p.lastname LIKE :search OR p.asianName LIKE :search')
            ->setParameter('search', '%'.$search.'%');

        if($yearStart && $yearEnd) {
            $qb->andWhere('fpm.createdAt BETWEEN :yearStart AND :yearEnd')
                ->setParameter('yearStart', $yearStart)
                ->setParameter('yearEnd', $yearEnd)
            ;
        }

        return $qb->getQuery()->getResult();
    }

}