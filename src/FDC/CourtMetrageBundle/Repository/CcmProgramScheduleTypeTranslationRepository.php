<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Entity\CcmProgramScheduleTypeTranslation;
use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmProgramScheduleTypeTranslationRepository
 */
class CcmProgramScheduleTypeTranslationRepository extends EntityRepository
{
    public function getAvailableTypes($locale)
    {
        $qb = $this
            ->createQueryBuilder('pstt')
            ->join('pstt.translatable', 'pst')
            ->join('pst.programSchedule', 'pstp')
            ->where('pstt.locale = :locale')
            ->setParameter(':locale', $locale)
            ->andWhere('pstt.status = :statusPublished or pstt.status = :statusTranslated')
            ->setParameter(':statusPublished', CcmProgramScheduleTypeTranslation::STATUS_PUBLISHED)
            ->setParameter(':statusTranslated', CcmProgramScheduleTypeTranslation::STATUS_TRANSLATED)
        ;

        return $qb->getQuery()->getResult();
    }
}
