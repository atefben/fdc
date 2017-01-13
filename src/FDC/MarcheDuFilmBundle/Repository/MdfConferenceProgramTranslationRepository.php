<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferenceProgramTranslationRepository extends EntityRepository
{
    public function getConferenceProgramPageByLocaleAndTheme($locale, $theme)
    {
        $qb = $this->createQueryBuilder('cpt');
        $qb
            ->where('cpt.locale = :locale')
            ->innerJoin('cpt.translatable', 'cp')
            ->andWhere('cp.theme = :theme')
            ->setParameter(':locale', $locale)
            ->setParameter(':theme', $theme)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
