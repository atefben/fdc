<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferenceInfoAndContactTranslationRepository extends EntityRepository
{
    public function getConferenceInfoAndContactPageByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('ict');
        $qb
            ->where('ict.locale = :locale')
            ->innerJoin('ict.translatable', 'ic')
            ->andWhere('ic.type = :slug')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
