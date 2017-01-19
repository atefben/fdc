<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfGlobalEventsScheduleTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfGlobalEventsScheduleTranslationRepository extends EntityRepository
{
    public function getScheduleByLocaleAndScheduleId($locale, $schedule)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :schedule')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':schedule', $schedule)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
