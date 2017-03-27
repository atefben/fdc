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
            ->where('s.locale = :locale')
            ->setParameter(':locale', $locale)
            ->andWhere('s.translatable = :translatable')
            ->setParameter('published', CcmParticiperPageLayerTranslation::STATUS_PUBLISHED)
            ->setParameter('translatable', $translatable)
            ->join('s.translatable', 't')
            ->orderBy('t.layerPosition', 'ASC')
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere('s.status = :translated')
                ->setParameter('translated', CcmParticiperPageLayerTranslation::STATUS_TRANSLATED)
                ->join('t.translations', 'tt')
                ->andWhere('tt.locale = :locale_fr and tt.status = :published')
                ->setParameter(':locale_fr', 'fr')
            ;
        } else {
            $qb
                ->andWhere('s.status = :published')
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
