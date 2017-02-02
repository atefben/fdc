<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class ServiceWidgetRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class ServiceWidgetTranslationRepository extends EntityRepository
{
    public function getServiceWidgetByLocaleAndWidgetId($locale, $service)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :service')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':service', $service)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
