<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfContentTemplateWidgetFileRepository extends EntityRepository
{
    public function getFileWidgetsByPageType($type)
    {
        $qb = $this->createQueryBuilder('ctfw')
                   ->join('ctfw.contentTemplate', 'ct')
                   ->andWhere('ct.type = :type')
                   ->setParameter('type', $type)
                   ->orderBy('ctfw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getFileWidgetsByPageId($pageId)
    {
        $qb = $this->createQueryBuilder('ctfw')
            ->join('ctfw.contentTemplate', 'ct')
            ->andWhere('ct.id = :pageId')
            ->setParameter('pageId', $pageId)
            ->orderBy('ctfw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
