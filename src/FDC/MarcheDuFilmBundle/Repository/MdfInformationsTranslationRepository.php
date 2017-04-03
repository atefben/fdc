<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\MdfInformationsTranslation;

/**
 * Class MdfInformationsTranslationRepository
 *
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfInformationsTranslationRepository extends EntityRepository
{
    public function getByLocaleAndStatus($locale)
    {
        $qb = $this
            ->createQueryBuilder('i')
            ->where('i.locale = :locale')
            ->andWhere('i.status = :publish or i.status = :translate')
            ->setParameter('publish',MdfInformationsTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',MdfInformationsTranslation::STATUS_TRANSLATED)
            ->setParameter('locale', $locale)
            ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
