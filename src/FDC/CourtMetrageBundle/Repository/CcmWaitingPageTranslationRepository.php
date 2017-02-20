<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class CcmWaitingPageTranslationRepository extends EntityRepository
{
    public function findPageByLocaleAndTab($locale, $selectionTab)
    {
        $qb = $this->createQueryBuilder('wpt')
                   ->join('wpt.translatable', 'wp')
                   ->where('wpt.locale = :locale')
                   ->andWhere('wp.page = :selectionTab')
                   ->setParameter('locale', $locale)
                   ->setParameter('selectionTab', $selectionTab)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}