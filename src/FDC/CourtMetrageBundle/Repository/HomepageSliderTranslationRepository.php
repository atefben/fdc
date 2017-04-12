<?php

namespace FDC\CourtMetrageBundle\Repository;


use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;

class HomepageSliderTranslationRepository extends EntityRepository
{
    public function getOrderedSlidersByLocale($locale)
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->join('t.translatable', 's')
            ->where('t.locale = :locale')
            ->andWhere('s.homepage is not null')
            ->orderBy('s.position', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
