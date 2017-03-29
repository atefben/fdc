<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmLabelSectionPositionRepository
 *
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmLabelSectionTranslationRepository extends EntityRepository
{
    public function getLabelSectionsBySectionIdAndLocale($sectionId, $locale)
    {
        $qb = $this->createQueryBuilder('lst')
                   ->select('lst, ls')
                   ->join('lst.translatable', 'ls')
                   ->where('lst.locale = :locale')
                   ->andWhere('ls.id = :sectionId')
                   ->setParameter('locale', $locale)
                   ->setParameter('sectionId', $sectionId)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
