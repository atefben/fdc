<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class ServiceWidgetProductRepository
 * @package FDC\MarcheDuFilmBundle\Entity
 */
class DispatchDeServiceWidgetTranslationRepository extends EntityRepository
{
    public function getSortedServices($locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->innerJoin('s.translatable', 't')
            ->orderBy('t.position', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
