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

    public function getConferenceProgramImageWidgetsByPageId($pageId)
    {
        $qb = $this->createQueryBuilder('ctiw')
                   ->join('ctiw.conferenceProgram', 'cp')
                   ->andWhere('cp.id = :pageId')
                   ->setParameter('pageId', $pageId)
                   ->orderBy('ctiw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getImageWidgetsByPageId($pageId)
    {
        $qb = $this->createQueryBuilder('ctiw')
            ->join('ctiw.contentTemplate', 'ct')
            ->where('ct.id = :pageId')
            ->setParameter('pageId', $pageId)
            ->orderBy('ctiw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getOneImageWidgetsByPageId($pageId)
    {
        $qb = $this->createQueryBuilder('ctiw')
            ->join('ctiw.contentTemplate', 'ct')
            ->where('ct.id = :pageId')
            ->setParameter('pageId', $pageId)
            ->orderBy('ctiw.position', 'ASC')
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
