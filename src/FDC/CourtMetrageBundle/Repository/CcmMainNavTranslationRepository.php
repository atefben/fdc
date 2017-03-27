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
            ->where('s.locale = :locale_fr')
            ->andWhere('s.translatable = :translatable')
            ->andWhere('s.status = :published')
            ->setParameter('published',CcmMainNavTranslation::STATUS_PUBLISHED)
            ->setParameter(':locale_fr', 'fr')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':translatable', $translatable)
        ;
        if ($locale != 'fr') {
            $qb
                ->join('t.translations', 'tt')
                ->andWhere('tt.locale = :locale and tt.status = :translated')
                ->setParameter(':locale', $locale)
                ->setParameter('translated',CcmMainNavTranslation::STATUS_TRANSLATED)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
