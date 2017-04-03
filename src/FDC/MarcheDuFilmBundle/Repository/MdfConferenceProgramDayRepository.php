<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferenceProgramDayRepository extends EntityRepository
{
    public function getProgramDayById($locale, $theme)
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