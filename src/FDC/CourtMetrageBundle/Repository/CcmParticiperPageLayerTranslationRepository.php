<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerTranslation;
use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmParticiperPageLayerTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmParticiperPageLayerTranslationRepository extends EntityRepository
{
    public function getByTranslatableAndLocale($translatable, $locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale_fr')
            ->andWhere('s.translatable = :translatable')
            ->andWhere('s.status = :publish')
            ->setParameter('publish', CcmParticiperPageLayerTranslation::STATUS_PUBLISHED)
            ->setParameter(':locale_fr', 'fr')
            ->setParameter('translatable', $translatable)
            ->join('s.translatable', 't')
            ->orderBy('t.layerPosition', 'ASC')
        ;
        if ($locale != 'fr') {
            $qb
                ->join('t.translations', 'tt')
                ->andWhere('tt.locale = :locale and tt.status = :translated')
                ->setParameter(':locale', $locale)
                ->setParameter('translated',CcmParticiperPageLayerTranslation::STATUS_TRANSLATED)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
