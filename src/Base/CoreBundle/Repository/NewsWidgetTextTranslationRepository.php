<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

class NewsWidgetTextTranslationRepository extends EntityRepository
{

    public function getOldItems()
    {
        $qb = $this->createQueryBuilder('nwtt');

        $qb
            ->innerJoin('nwtt.translatable', 'nwt')
            ->innerJoin('nwt.news', 'n')
            ->andWhere('n.oldNewsId is not null')
        ;

        return $qb->getQuery()->getResult();
    }
}