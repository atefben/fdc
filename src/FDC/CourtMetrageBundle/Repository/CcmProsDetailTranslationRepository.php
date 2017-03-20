<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmProsDetailTranslation;

/**
 * Class CcmProsDetailTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmProsDetailTranslationRepository extends EntityRepository
{
    public function getByLocaleAndStatus($locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.status = :statusPublished or s.status = :statusTranslated')
            ->orderBy('s.name', 'ASC')
            ->setParameter(':locale', $locale)
            ->setParameter(':statusPublished', CcmProsDetailTranslation::STATUS_PUBLISHED)
            ->setParameter(':statusTranslated', CcmProsDetailTranslation::STATUS_TRANSLATED)
        ;

        return $qb->getQuery()->getResult();
    }
}
