<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfWhoAreWeTeamTranslationRepository extends EntityRepository
{
    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('wawtt')
            ->join('wawtt.translatable', 'wawt')
            ->where('wawtt.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'image') {
            $qb
                ->join('wawt.whoAreWeTeamWidgets', 'wawtw')
                ->andWhere('wawtw.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
