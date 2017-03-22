<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Entity\CatalogPushTranslation;
use FDC\CourtMetrageBundle\Entity\CatalogPush;
use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;

class CatalogPushTranslationRepository extends EntityRepository
{
    public function findCatalogsByLocaleOrderByPosition($locale)
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->join('c.translatable', 't')
            ->where('c.locale = :locale')
            ->orderBy('t.position', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
