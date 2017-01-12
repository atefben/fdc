<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\EventWidgetImage;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetImage;

class EventWidgetImageRepository extends EntityRepository
{

    /**
     * @return EventWidgetImage[]
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