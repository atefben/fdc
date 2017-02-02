<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferenceNewsPageTranslationRepository extends EntityRepository
{
    public function getConferenceNewsPageByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('cnt');
        $qb
            ->where('cnt.locale = :locale')
            ->innerJoin('cnt.translatable', 'cn')
            ->andWhere('cn.type = :slug')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
