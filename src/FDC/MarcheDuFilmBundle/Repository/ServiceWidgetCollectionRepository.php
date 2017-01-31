<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class ServiceWidgetCollectionRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class ServiceWidgetCollectionRepository extends EntityRepository
{
    public function getWidgetsDependingOnPostion($service)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.service = :service')
            ->orderBy('s.position', 'ASC')
            ->setParameter(':service', $service)
        ;

        return $qb->getQuery()->getResult();
    }
}
