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
    public function getByPageAndLocale($slug, $locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->join('s.translatable', 't', 'WITH', 't.page = :slug')
            ->orderBy('t.layerPosition', 'ASC')
            ->andWhere('s.status = :publish or s.status = :translate')
            ->setParameter('publish',CcmParticiperPageLayerTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',CcmParticiperPageLayerTranslation::STATUS_TRANSLATED)
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getResult();
    }
}
