<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FilmAwardRepository class.
 *
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmAwardRepository extends EntityRepository
{
    public function getApiAwards($festival)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.festival = :festival')
            ->setParameter('festival', $festival)
            ->orderBy('a.position', 'ASC');

        return $query->getQuery();

    }

    public function getApiAward($id, $festival)
    {
        return $this->createQueryBuilder('a')
            ->where('a.festival = :festival')
            ->andWhere('a.id = :id')
            ->setParameter('festival', $festival)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}