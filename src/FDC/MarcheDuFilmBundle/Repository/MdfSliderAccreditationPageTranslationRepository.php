<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\MdfSliderAccreditationPageTranslation;

/**
 * Class MdfSliderAccreditationPageTranslationRepository
 *
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfSliderAccreditationPageTranslationRepository extends EntityRepository
{
    public function getByLocaleAndStatus($locale)
    {
        $qb = $this
            ->createQueryBuilder('i')
            ->where('i.locale = :locale')
            ->andWhere('i.status = :publish or i.status = :translate')
            ->setParameter('publish',MdfSliderAccreditationPageTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',MdfSliderAccreditationPageTranslation::STATUS_TRANSLATED)
            ->setParameter('locale', $locale)
            ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
