<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetImage;

class InfoWidgetImageRepository extends EntityRepository
{

    /**
     * @return InfoWidgetImage[]
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