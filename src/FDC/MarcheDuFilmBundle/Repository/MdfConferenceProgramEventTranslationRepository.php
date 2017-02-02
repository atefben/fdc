<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferenceProgramEventTranslationRepository extends EntityRepository
{
    public function getEventByLocaleAndEventId($locale, $eventId)
    {
        $qb = $this->createQueryBuilder('cpet');
        $qb
            ->where('cpet.locale = :locale')
            ->andWhere('cpet.translatable = :eventId')
            ->innerJoin('cpet.translatable', 'cpe')
            ->setParameter(':locale', $locale)
            ->setParameter(':eventId', $eventId)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}