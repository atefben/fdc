<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfContentTemplateWidgetGalleryRepository extends EntityRepository
{
    public function getGalleryWidgetsByPageType($type)
    {
        $qb = $this->createQueryBuilder('ctgw')
                   ->join('ctgw.contentTemplate', 'ct')
                   ->andWhere('ct.type = :type')
                   ->setParameter('type', $type)
                   ->orderBy('ctgw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}