<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPageTranslation;

class MdfConferenceNewsPageTranslationRepository extends EntityRepository
{
    public function getConferenceNewsPageByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('cnt');
        $qb
            ->where('cnt.locale = :locale')
            ->andWhere('cnt.status = :publish or cnt.status = :translate')
            ->innerJoin('cnt.translatable', 'cn')
            ->andWhere('cn.type = :slug')
            ->setParameter('publish',MdfConferenceNewsPageTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',MdfConferenceNewsPageTranslation::STATUS_TRANSLATED)
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
