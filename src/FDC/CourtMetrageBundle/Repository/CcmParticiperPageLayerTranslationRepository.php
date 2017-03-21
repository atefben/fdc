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
            ->andWhere('s.translatable = :translatable')
            ->andWhere('s.status = :publish or s.status = :translate')
            ->setParameter('publish', CcmParticiperPageLayerTranslation::STATUS_PUBLISHED)
            ->setParameter('translate', CcmParticiperPageLayerTranslation::STATUS_TRANSLATED)
            ->setParameter(':locale', $locale)
            ->setParameter('translatable', $translatable)
            ->join('s.translatable', 't')
            ->orderBy('t.layerPosition', 'ASC')
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
