<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfPressGalleryWidgetTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Entity
 */
class MdfPressGalleryWidgetTranslationRepository extends EntityRepository
{
    public function getSortedPressGalleryWidgets($locale)
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
