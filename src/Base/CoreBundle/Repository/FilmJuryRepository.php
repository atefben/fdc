<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmJuryType;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FilmJuryRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmJuryRepository extends EntityRepository
{
    public function getApiJuries($festival, $type)
    {
        $query = $this->createQueryBuilder('j')
            ->where('j.festival = :festival')
            ->setParameter('festival', $festival)
        ;

        if ($type !== null) {
            $query = $query->andWhere('j.type = :type')
                ->setParameter('type', $type)
            ;
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
            ->getOneOrNullResult()
            ;
    }

    public function getJurysByType($festival, $locale, $type)
    {
        $qb = $this->createQueryBuilder('j');

        $qb
            ->join('j.translations', 't')
            ->join('j.person', 'p')
            ->andWhere('p.firstname IS NOT NULL')
            ->andWhere('p.lastname IS NOT NULL')
            ->andWhere('j.type = :type')
            ->setParameter('type', $type)
        ;
        $this->addMasterQueries($qb, 'j', $festival, false);
        $this->addTranslationQueries($qb, 't', $locale, null);

        return $qb->getQuery()->getResult();
    }
}