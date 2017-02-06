<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfWhoAreWeTeamContactWidgetTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Entity
 */
class MdfWhoAreWeTeamContactWidgetTranslationRepository extends EntityRepository
{
    public function getSortedWhoAreWeTeamContactWidgets($locale)
    {
        $qb = $this->createQueryBuilder('cwt');
        $qb
            ->where('cwt.locale = :locale')
            ->innerJoin('cwt.translatable', 'cw')
            ->orderBy('cw.position', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
