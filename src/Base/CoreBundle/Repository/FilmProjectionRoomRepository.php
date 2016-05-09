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
            ->join('p.programmationFilms', 'pf')
            ->andWhere('pf.film IS NOT NULL')
        ;

//        if ($time) {
//            $date = new \DateTime;
//            $date->setTimestamp($time);
//
//            $begin = new \DateTime();
//            $begin->setDate($date->format('Y'), $date->format('m'), $date->format('d'));
//            $begin->setTime(0, 0, 0);
//
//            $end = new \DateTime;
//            $end->setDate($date->format('Y'), $date->format('m'), $date->format('d'));
//            $end->setTime(23, 59, 59);
//
//            $qb
//                ->andWhere('p.startsAt BETWEEN :begin AND :end')
//                ->setParameter('begin', $begin)
//                ->setParameter('end', $end)
//            ;
//        }
        if ($filmId) {
            $qb->join('r.programmationFilms', 'f')
                ->andWhere('f.film = :film_id')
                ->setParameter(':film_id', $filmId)
            ;
        }

//        $this->addMasterQueries($qb, 'p', $festival, false);
        $qb->addOrderBy('p.startsAt', 'asc');

        return $qb;
    }

    public function getProjectionsByFestivalAndDate($festival, $date)
    {
        $qb = $this
            ->createQueryBuilder('r')
            ->join('r.projections', 'p')
            ->where('p.festival = :festival')
            ->andWhere('(p.startsAt >= :startDate AND p.endsAt <= :endDate)')
            ->setParameter('festival', $festival)
            ->setParameter('startDate', $date. ' 00:00:00')
            ->setParameter('endDate', $date. ' 23:59:59')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

}