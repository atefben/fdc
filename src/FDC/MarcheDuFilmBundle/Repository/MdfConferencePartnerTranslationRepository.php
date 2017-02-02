<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferencePartnerTranslationRepository extends EntityRepository
{
    public function getConferencePartnerPageByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('cpt');
        $qb
            ->where('cpt.locale = :locale')
            ->innerJoin('cpt.translatable', 'cp')
            ->andWhere('cp.type = :slug')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
