<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FilmJuryRepository class.
 *
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmJuryRepository extends EntityRepository
{
    public function getApiJuries($festival, $type)
    {
        $query = $this->createQueryBuilder('j')
            ->where('j.festival = :festival')
            ->setParameter('festival', $festival);

        if ($type !== null) {
            $query = $query->andWhere('j.type = :type')
                ->setParameter('type', $type);
        }

        $query = $query->orderBy('j.position', 'ASC');

        return $query->getQuery();

    }

    public function getApiJury($id, $festival)
    {
        return $this->createQueryBuilder('j')
            ->where('j.festival = :festival')
            ->andWhere('j.id = :id')
            ->setParameter('festival', $festival)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}