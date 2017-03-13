<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class CcmShortFilmCompetitionTabTranslationRepository extends EntityRepository
{
    public function findTabByLocaleAndType($locale, $type, $year = null)
    {
        $qb = $this->createQueryBuilder('sfctt')
                   ->join('sfctt.translatable', 'sfct')
                   ->where('sfctt.locale = :locale')
                   ->andWhere('sfct.type = :type')
                   ->setParameter('locale', $locale)
                   ->setParameter('type', $type)
        ;

        if ($year) {
            $qb->andWhere('sfct.dateJury = :year')
                ->setParameter('year', $year);
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
