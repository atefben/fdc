<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class DispatchDeServiceTranslation
 *
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class DispatchDeServiceTranslationRepository extends EntityRepository
{
    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('dst')
            ->join('dst.translatable', 'ds')
            ->where('dst.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'image') {
            $qb
                ->join('ds.dispatchDeServiceWidgets', 'dsw')
                ->andWhere('dsw.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
