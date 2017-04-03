<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmLabelSectionContentTextTranslationRepository
 *
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmLabelSectionContentTextTranslationRepository extends EntityRepository
{
    public function getLabelContentTextWidgetsByLocaleAndSectionId($locale, $sectionId)
    {
        $qb = $this->createQueryBuilder('lctwt')
                   ->select('lctwt, lctw')
                   ->join('lctwt.translatable', 'lctw')
                   ->join('lctw.labelSection', 'ls')
                   ->where('lctwt.locale = :locale')
                   ->andWhere('ls.id = :sectionId')
                   ->setParameter('locale', $locale)
                   ->setParameter('sectionId', $sectionId)
                   ->orderBy('lctw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
