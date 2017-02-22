<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmSubNavTranslation;

/**
 * Class CcmSubNavTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmSubNavTranslationRepository extends EntityRepository
{
    public function getByTranslatableAndLocale($locale, $translatable)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :translatable')
            ->andWhere('s.status = :publish or s.status = :translate')
            ->setParameter('publish',CcmSubNavTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',CcmSubNavTranslation::STATUS_TRANSLATED)
            ->setParameter(':locale', $locale)
            ->setParameter(':translatable', $translatable)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
