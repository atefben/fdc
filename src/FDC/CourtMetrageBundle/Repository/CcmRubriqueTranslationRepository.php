<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmRubriqueTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmRubriqueTranslationRepository extends EntityRepository
{
    public function getRubriqueByLocaleAndTranslatableId($locale, $translatable)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :translatable')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':translatable', $translatable)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
