<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Entity\HomepageActualite;
use FDC\CourtMetrageBundle\Entity\HomepageActualiteTranslation;
use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;

class HomepageActualiteTranslationRepository extends EntityRepository
{
    public function findActualiteForHomepage($locale)
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->join('t.translatable', 'a')
            ->where('t.locale = :locale')
            ->andWhere('a.isActive = 1')
            ->andWhere('a.homepage is not null')
            ->setMaxResults(3)
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
