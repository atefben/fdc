<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfContentTemplateWidgetImageRepository extends EntityRepository
{
    public function getImageWidgetsByPageType($type)
    {
        $qb = $this->createQueryBuilder('ctiw')
                   ->join('ctiw.contentTemplate', 'ct')
                   ->andWhere('ct.type = :type')
                   ->setParameter('type', $type)
                   ->orderBy('ctiw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}