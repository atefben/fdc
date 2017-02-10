<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\MdfNewsPageTranslation;

/**
 * Class MdfNewsPageTranslationRepository
 *
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfNewsPageTranslationRepository extends EntityRepository
{
    public function getByLocaleAndStatus($locale)
    {
        $qb = $this
            ->createQueryBuilder('i')
            ->where('i.locale = :locale')
            ->andWhere('i.status = :publish or i.status = :translate')
            ->setParameter('publish',MdfNewsPageTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',MdfNewsPageTranslation::STATUS_TRANSLATED)
            ->setParameter('locale', $locale)
            ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
