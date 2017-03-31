<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\MdfContactPageTranslation;

/**
 * Class MdfContactPageTranslationRepository
 *
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfContactPageTranslationRepository extends EntityRepository
{
    public function getByLocaleAndStatus($locale)
    {
        $qb = $this
            ->createQueryBuilder('i')
            ->where('i.locale = :locale')
            ->andWhere('i.status = :publish or i.status = :translate')
            ->setParameter('publish',MdfContactPageTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',MdfContactPageTranslation::STATUS_TRANSLATED)
            ->setParameter('locale', $locale)
            ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
