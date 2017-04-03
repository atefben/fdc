<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmLabelSectionContentThreeColumnsTranslationRepository
 *
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmLabelSectionContentThreeColumnsTranslationRepository extends EntityRepository
{
    public function getLabelContentThreeColumnWidgetsByLocaleAndSectionId($locale, $sectionId)
    {
        $qb = $this->createQueryBuilder('lctcwt')
                   ->select('lctcwt, lctcw')
                   ->join('lctcwt.translatable', 'lctcw')
                   ->join('lctcw.labelSection', 'ls')
                   ->where('lctcwt.locale = :locale')
                   ->andWhere('ls.id = :sectionId')
                   ->setParameter('locale', $locale)
                   ->setParameter('sectionId', $sectionId)
                   ->orderBy('lctcw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
