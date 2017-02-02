<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class ServiceWidgetProductTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class ServiceWidgetProductTranslationRepository extends EntityRepository
{
    public function getServiceWidgetProductByLocaleAndProductId($locale, $product)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :product')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':product', $product)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
