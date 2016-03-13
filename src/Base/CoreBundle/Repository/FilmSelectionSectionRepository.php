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
}