<?php

namespace Base\CoreBundle\Repository;


use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFilm;

/**
 * Class FilmProjectionRepository
 * @package Base\CoreBundle\Repository
 */
class FilmProjectionRepository extends EntityRepository
{

    public function getProjectionsByFestivalAndDateAndRoom($festival, $date, $room, $isPress)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->join('p.room', 'r')
            ->where('p.festival = :festival')
            ->andWhere('p.room = :room')
            ->andWhere('(p.startsAt >= :startDate AND p.startsAt <= :endDate)');

        if ($isPress == false) {
            $qb = $qb->andWhere('p.type != "Séance de presse"');
        }

        $qb = $qb->setParameter('festival', $festival)
            ->setParameter('room', $room)
            ->setParameter('startDate', $date. ' 00:00:00')
            ->setParameter('endDate', $date. ' 23:59:59')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }


    public function getProjectionsByFestivalYearAndProgrammationSection($festival, $programmationSection)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->where('fp.festival = :festival')
            ->andWhere('fp.programmationSection = :programmation_section')
            ->setParameter('programmation_section', $programmationSection)
            ->setParameter('festival', $festival)
            ->addOrderBy('fp.startsAt', 'asc')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }
    /**
     * @param $festival
     * @param null $time
     * @param null $filmId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getApiProjections($festival, $time = null, $filmId = null)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->addOrderBy('fp.startsAt', 'desc')
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
                ->andWhere('fp.startsAt BETWEEN :begin AND :end')
                ->setParameter('begin', $begin)
                ->setParameter('end', $end)
            ;
        }

        if ($filmId) {
            $qb->join('fp.programmationFilms', 'pf')
                ->andWhere('pf.film = :film_id')
                ->setParameter(':film_id', $filmId)
            ;
        }

        $this->addMasterQueries($qb, 'fp', $festival, false);

        return $qb;
    }

    /**
     * @param $festival
     * @param \DateTime $dateTime
     * @return array
     * @todo Uncomment condition
     * @todo remove limit
     */
    public function getNewsApiProjections($festival, \DateTime $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->addOrderBy('fp.startsAt', 'desc')
            ->join('fp.programmationFilms', 'pf')
            ->andWhere('pf.film IS NOT NULL')
        ;


        // To be uncommented.
//        $begin = clone $dateTime;
//        $begin->setTime(0, 0, 0);
//
//        $end = clone $dateTime;
//        $end->setTimestamp($dateTime->getTimestamp() + 3600);
//
//        $qb
//            ->andWhere('fp.startsAt BETWEEN :begin AND :end')
//            ->setParameter('begin', $begin)
//            ->setParameter('end', $end)
//        ;

        // To be removed
        $qb->setMaxResults(20);

        $this->addMasterQueries($qb, 'fp', $festival, false);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $festival
     * @param $count
     * @return array
     * @todo uncomment date condition
     */
    public function getApiNextProjections($festival, $count)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            //->andWhere('fp.startsAt > :datetime')
            //->setParameter('datetime', new \DateTime())
            ->join('fp.programmationFilms', 'pf')
            ->andWhere('pf.film IS NOT NULL')
        ;

        $this->addMasterQueries($qb, 'fp', $festival, false);

        $qb
            ->addOrderBy('fp.startsAt', 'desc')
            ->setMaxResults($count)
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param FilmFilm $film
     * @return array
     */
    public function getNextProjectionByFilm(FilmFilm $film)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.programmationFilms', 'pf')
            ->where('pf.film = :film_id')
            ->setParameter(':film_id', $film->getId())
            ->andWhere('p.startsAt > :start_at')
            ->setParameter('start_at', new \DateTime())
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $date
     * @return array|\Doctrine\ORM\QueryBuilder
     */
    public function getProjectionByDate($date)
    {

        $qb = $this
            ->createQueryBuilder('p')
            ->select('p')
            ->where("DATE_FORMAT(p.startsAt,'%Y%m%d') = :date")
        ;


        $qb = $qb
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

}