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
            ->join('pstp.schedulesCollection', 'psc')
            ->join('psc.programDay', 'pd')
            ->join('pd.daysCollection', 'pdc')
            ->where('pstt.locale = :locale')
            ->setParameter(':locale', $locale)
            ->andWhere('pdc.program IS NOT NULL')
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere('pstt.status = :statusTranslated')
                ->setParameter(':statusTranslated', CcmProgramScheduleTypeTranslation::STATUS_TRANSLATED)
                ->join('pst.translations', 'tt')
                ->andWhere('tt.locale = :locale_fr and tt.status = :statusPublished')
                ->setParameter(':statusPublished', CcmProgramScheduleTypeTranslation::STATUS_PUBLISHED)
                ->setParameter(':locale_fr', 'fr')
            ;
        } else {
            $qb
                ->andWhere('pstt.status = :statusPublished')
                ->setParameter(':statusPublished', CcmProgramScheduleTypeTranslation::STATUS_PUBLISHED)
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
