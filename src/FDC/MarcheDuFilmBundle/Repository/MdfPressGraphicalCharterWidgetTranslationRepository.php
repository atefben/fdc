<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfPressGraphicalCharterWidgetTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Entity
 */
class MdfPressGraphicalCharterWidgetTranslationRepository extends EntityRepository
{
    public function getSortedPressGraphicalCharterWidgets($locale)
    {
        $qb = $this->createQueryBuilder('pg');
        $qb
            ->where('pg.locale = :locale')
            ->innerJoin('pg.translatable', 'pgt')
            ->orderBy('pgt.position', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
