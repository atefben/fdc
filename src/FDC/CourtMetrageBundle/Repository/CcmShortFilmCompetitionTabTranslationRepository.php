<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class CcmShortFilmCompetitionTabTranslationRepository extends EntityRepository
{
    public function findTabByLocaleAndType($locale, $type, $year = null)
    {
        $qb = $this->createQueryBuilder('sfctt')
                   ->where('sfctt.locale = :locale')
                    ->join('sfctt.translatable', 'sfct')
                    ->andWhere('sfct.type = :type')
                    ->andWhere('sfct.date = :year')
                    ->setParameter('year', $year)
                   ->setParameter('locale', $locale)
                   ->setParameter('type', $type)
        ;

//        if ($year) {
//            $qb
//        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
