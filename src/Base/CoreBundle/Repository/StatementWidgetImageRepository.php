<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\StatementWidgetImage;

class StatementWidgetImageRepository extends EntityRepository
{

    /**
     * @return StatementWidgetImage[]
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