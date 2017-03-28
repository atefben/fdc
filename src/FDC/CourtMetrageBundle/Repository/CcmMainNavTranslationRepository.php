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
            ->setParameter(':locale', $locale)
            ->innerJoin('s.translatable', 't')
            ->setParameter(':translatable', $translatable)
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere('s.status = :translated')
                ->setParameter('translated',CcmMainNavTranslation::STATUS_TRANSLATED)
                ->join('t.translations', 'tt')
                ->andWhere('tt.locale = :locale_fr and tt.status = :published')
                ->setParameter(':locale_fr', 'fr')
                ->setParameter('published',CcmMainNavTranslation::STATUS_PUBLISHED)
            ;
        } else {
            $qb
                ->andWhere('s.status = :published')
                ->setParameter('published',CcmMainNavTranslation::STATUS_PUBLISHED)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
