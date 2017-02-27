<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Entity\CcmParticiperPageTranslation;
use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmParticiperPageTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmParticiperPageTranslationRepository extends EntityRepository
{
    public function getAllPagesByLocale($locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.status = :publish or s.status = :translate')
            ->setParameter('publish',CcmParticiperPageTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',CcmParticiperPageTranslation::STATUS_TRANSLATED)
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }

    public function getPageBySlugAndLocale($slug, $locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.slug = :slug')
            ->andWhere('s.status = :publish or s.status = :translate')
            ->setParameter('publish',CcmParticiperPageTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',CcmParticiperPageTranslation::STATUS_TRANSLATED)
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
