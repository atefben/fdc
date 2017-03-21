<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmRubriquesCollectionRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmRubriquesCollectionRepository extends EntityRepository
{
    public function getWidgetsDependingOnPostion($faqPageId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.faqPage = :faqPage')
            ->orderBy('s.position', 'ASC')
            ->setParameter(':faqPage', $faqPageId)
        ;

        return $qb->getQuery()->getResult();
    }
}
