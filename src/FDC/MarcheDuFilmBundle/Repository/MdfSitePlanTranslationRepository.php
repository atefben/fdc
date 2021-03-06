<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\MdfSitePlanTranslation;

/**
 * Class MdfSitePlanTranslationRepository
 *
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfSitePlanTranslationRepository extends EntityRepository
{
    public function getByLocaleAndStatus($locale)
    {
        $qb = $this
            ->createQueryBuilder('i')
            ->where('i.locale = :locale')
            ->andWhere('i.status = :publish or i.status = :translate')
            ->setParameter('publish',MdfSitePlanTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',MdfSitePlanTranslation::STATUS_TRANSLATED)
            ->setParameter('locale', $locale)
            ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
