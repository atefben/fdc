<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class PressCoverageWidgetTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Entity
 */
class PressCoverageWidgetTranslationRepository extends EntityRepository
{
    public function getSortedPressCoverageWidgets($locale)
    {
        $qb = $this->createQueryBuilder('pc');
        $qb
            ->where('pc.locale = :locale')
            ->innerJoin('pc.translatable', 'pct')
            ->orderBy('pct.position', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
