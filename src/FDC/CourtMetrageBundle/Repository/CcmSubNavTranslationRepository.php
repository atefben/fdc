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
            ->where('s.translatable = :translatable')
            ->andWhere('s.locale = :locale')
            ->setParameter(':translatable', $translatable)
            ->setParameter(':locale', $locale)
        ;
        
        if ($locale != 'fr') {
            $qb
                ->innerJoin('s.translatable', 't')
                ->join('t.translations', 'tr')
                ->andWhere('s.status = :statusTranslated')
                ->andWhere('tr.status = :publish')
                ->setParameter('publish',CcmSubNavTranslation::STATUS_PUBLISHED)
                ->setParameter('statusTranslated', CcmSubNavTranslation::STATUS_TRANSLATED)
            ;

        } else {
            $qb
                ->andWhere('s.status = :publish')
                ->setParameter('publish',CcmSubNavTranslation::STATUS_PUBLISHED)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
