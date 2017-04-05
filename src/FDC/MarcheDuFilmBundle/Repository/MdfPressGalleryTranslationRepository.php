<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfPressGalleryTranslationRepository extends EntityRepository
{
    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('pgt')
            ->join('pgt.translatable', 'pg')
            ->where('pgt.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'image') {
            $qb
                ->join('pg.pressGalleryWidgets', 'pgw')
                ->andWhere('pgw.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
