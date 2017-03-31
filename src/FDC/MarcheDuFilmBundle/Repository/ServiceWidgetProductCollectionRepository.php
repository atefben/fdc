<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class ServiceWidgetProductCollectionRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class ServiceWidgetProductCollectionRepository extends EntityRepository
{
    public function getServiceProductsByPosition($serviceWidget)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.serviceWidget = :serviceWidget')
            ->orderBy('s.position', 'ASC')
            ->setParameter(':serviceWidget', $serviceWidget)
        ;

        return $qb->getQuery()->getResult();
    }
}
