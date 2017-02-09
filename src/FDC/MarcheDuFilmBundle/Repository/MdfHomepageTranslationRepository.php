<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfHomepageTranslationRepository
 *
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfHomepageTranslationRepository extends EntityRepository
{
    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('ht')
            ->join('ht.translatable', 'h')
            ->where('ht.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'gallery') {
            $qb
                ->andWhere('h.gallery = :gallery')
                ->setParameter('gallery', $filters['id'])
            ;
        }

        if ($filters['type'] == 'image') {
            $qb
                ->join('h.slidersTop', 'hst')
                ->join('h.sliders', 'hs')
                ->join('h.services', 'hserv')
                ->andWhere(
                    $qb->expr()->orX(
                        'hst.image = :image',
                        'hs.image = :image',
                        'hserv.image = :image'
                    )
                )
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
