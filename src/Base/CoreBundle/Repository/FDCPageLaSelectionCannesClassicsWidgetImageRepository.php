<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetImage;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetImage;

class FDCPageLaSelectionCannesClassicsWidgetImageRepository extends EntityRepository
{

    /**
     * @return FDCPageLaSelectionCannesClassicsWidgetImage[]
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