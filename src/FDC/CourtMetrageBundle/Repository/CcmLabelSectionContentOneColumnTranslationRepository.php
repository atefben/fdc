<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmLabelSectionContentOneColumnTranslationRepository
 *
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmLabelSectionContentOneColumnTranslationRepository extends EntityRepository
{
    public function getLabelContentOneColumnWidgetsByLocaleAndSectionId($locale, $sectionId)
    {
        $qb = $this->createQueryBuilder('lcocwt')
                   ->select('lcocwt, lcocw')
                   ->join('lcocwt.translatable', 'lcocw')
                   ->join('lcocw.labelSection', 'ls')
                   ->where('lcocwt.locale = :locale')
                   ->andWhere('ls.id = :sectionId')
                   ->setParameter('locale', $locale)
                   ->setParameter('sectionId', $sectionId)
                   ->orderBy('lcocw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
