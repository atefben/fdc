<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmMainNavTranslation;

/**
 * Class CcmMainNavTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmMainNavTranslationRepository extends EntityRepository
{
    public function getByTranslatableAndLocale($locale, $translatable)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :translatable')
            ->andWhere('s.status = :publish or s.status = :translate')
            ->setParameter('publish',CcmMainNavTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',CcmMainNavTranslation::STATUS_TRANSLATED)
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':translatable', $translatable)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
