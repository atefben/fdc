<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

class FilmSelectionSectionRepository extends EntityRepository
{
    public function getApiSections($filmId = null)
    {
        $qb = $this->createQueryBuilder('s');

        if ($filmId) {
            $qb
                ->join('s.films', 'f')
                ->where('f.id = :film_id')
                ->setParameter('film_id', $filmId)
            ;
        }

        return $qb;
    }

    /**
     * Get selection section by ids
     * @param array $ids
     * @return array
     */
    public function getAllByIds(array $ids)
    {
        return $this
            ->_em
            ->createQueryBuilder()
            ->from($this->getClassName(), 's', 's.id')
            ->select('s')
            ->andWhere('s.id in (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult()
        ;
    }
}