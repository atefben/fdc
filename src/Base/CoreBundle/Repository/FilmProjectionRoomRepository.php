<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

class FilmProjectionRoomRepository extends EntityRepository
{
    public function getApiRooms($festival, $time, $filmId)
    {
        $qb = $this
            ->createQueryBuilder('r')
            ->join('r.projections', 'p')
        ;

        if ($time) {
            $date = new \DateTime;
            $date->setTimestamp($time);

            $begin = new \DateTime();
            $begin->setDate($date->format('Y'), $date->format('m'), $date->format('d'));
            $begin->setTime(0, 0, 0);

            $end = new \DateTime;
            $end->setDate($date->format('Y'), $date->format('m'), $date->format('d'));
            $end->setTime(23, 59, 59);

            $qb
                ->andWhere('p.startsAt BETWEEN :begin AND :end')
                ->setParameter('begin', $begin)
                ->setParameter('end', $end)
            ;
        }
        if ($filmId) {
            $qb->join('.programmationFilms', 'f')
                ->andWhere('f.film = :film_id')
                ->setParameter(':film_id', $filmId)
            ;
        }

        $this->addMasterQueries($qb, 'p', $festival, false);

        return $qb;
    }
}