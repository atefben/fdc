<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfWhoAreWeTeamWidgetTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Entity
 */
class MdfWhoAreWeTeamWidgetTranslationRepository extends EntityRepository
{
    public function getSortedWhoAreWeTeamWidgets($locale)
    {
        $qb = $this->createQueryBuilder('wt');
        $qb
            ->where('wt.locale = :locale')
            ->innerJoin('wt.translatable', 'w')
            ->orderBy('w.position', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
