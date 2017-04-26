<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class ProgramIndustryDispatchWidgetTranslationRepository
 */
class ProgramIndustryDispatchWidgetTranslationRepository extends EntityRepository
{
    public function getSortedServices($locale)
    {
        $qb = $this->createQueryBuilder('w');
        $qb
            ->where('w.locale = :locale')
            ->innerJoin('w.translatable', 't')
            ->orderBy('t.position', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
