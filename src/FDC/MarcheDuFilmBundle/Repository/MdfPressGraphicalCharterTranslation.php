<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfPressGraphicalCharterTranslation extends EntityRepository
{
    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('pgct')
            ->join('pgct.translatable', 'pgc')
            ->where('pgct.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'image') {
            $qb
                ->join('pgc.pressGraphicalCharterWidgets', 'pgcw')
                ->andWhere('pgcw.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
