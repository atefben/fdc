<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmProsPageTranslation;

/**
 * Class CcmProsPageTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmProsPageTranslationRepository extends EntityRepository
{
    public function getByLocaleAndStatus($locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.status = :statusPublished or s.status = :statusTranslated')
            ->setParameter(':locale', $locale)
            ->setParameter(':statusPublished', CcmProsPageTranslation::STATUS_PUBLISHED)
            ->setParameter(':statusTranslated', CcmProsPageTranslation::STATUS_TRANSLATED)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
