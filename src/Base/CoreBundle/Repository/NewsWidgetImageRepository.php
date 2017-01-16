<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\NewsWidgetImage;

class NewsWidgetImageRepository extends EntityRepository
{

    /**
     * @return NewsWidgetImage[]
     */
    public function getOldItems()
    {
        $qb = $this->createQueryBuilder('w');

        $qb
            ->andWhere('w.oldImportReference is not null')
        ;

        return $qb->getQuery()->getResult();
    }
}