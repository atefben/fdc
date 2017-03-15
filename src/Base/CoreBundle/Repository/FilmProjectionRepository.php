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

    public function getAllExceptTypes($festival, $types)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->join('p.programmationFilms', 'pf')
            ->where('p.festival = :festival')
            ->andWhere('p.type NOT IN (:types)')
            ->orderBy('p.startsAt', 'ASC')
            ->setParameter('festival', $festival)
            ->setParameter('types', $types)
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getAllTypes($festival)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->select('p.type')
            ->where('p.festival = :festival')
            ->setParameter('festival', $festival)
            ->groupBy('p.type')
            ->getQuery()
            ->getArrayResult()
        ;

        $qb = array_column($qb, 'type');

        return $qb;
    }

    public function getAllSelectionsIds($festival, $locale)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->select('ss.id')
            ->join('p.programmationFilms', 'pf')
            ->join('pf.film', 'f')
            ->join('f.selectionSection', 'ss')
            ->where('p.festival = :festival')
            ->setParameter('festival', $festival)
            ->groupBy('ss.id')
            ->getQuery()
            ->getArrayResult()
        ;

        $qb = array_column($qb, 'id');

        return $qb;
    }

    public function getProjectionsByFestivalAndDateAndRoom($festival, $date, $room, $isPress)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->join('p.room', 'r')
            ->where('p.festival = :festival')
            ->andWhere('p.type != :projection_type')
            ->setParameter('projection_type', 'Divers')
        ;

        if ($room != false) {
            $qb = $qb
                ->andWhere('p.room = :room');
        }
        if ($date != false) {
            $qb
                ->andWhere('(p.startsAt >= :startDate AND p.startsAt <= :endDate)')
                ->setParameter('startDate', $date . ' 00:00:00')
                ->setParameter('endDate', $date . ' 23:59:59')
            ;
        }

        if ($isPress == false) {
            $qb = $qb
                ->andWhere('p.type NOT IN (:types)')
                ->setParameter('types', array('Séance de presse', 'Conférence de presse'))
            ;
        }

        $qb = $qb->setParameter('festival', $festival);
        if ($room != false) {
            $qb = $qb->setParameter('room', $room);
        }
        $qb = $qb
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
     * @param \DateTime|null $dateTime
     * @param \DateTime $limitDate
     * @return array
     */
    public function getNewsApiProjections($festival, \DateTime $dateTime = null, \DateTime $limitDate = null)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->addOrderBy('fp.startsAt', 'desc')
            ->join('fp.programmationFilms', 'pf')
            ->andWhere('pf.film IS NOT NULL')
        ;

        if ($limitDate) {
            $qb
                ->andWhere('fp.startsAt <= :limitDate')
                ->setParameter(':limitDate', $limitDate)
            ;
        }

        if ($dateTime) {
            if($festival->getFestivalEndsAt() == $dateTime) {
                $qb->setMaxResults(3);
            }

            // To be uncommented.
            $begin = clone $dateTime;
            $begin->setTime(0, 0, 0);

            $end = clone $dateTime;
            $end->setTime(23, 59, 59);

            $qb
                ->andWhere('fp.startsAt BETWEEN :begin AND :end')
                ->setParameter('begin', $begin)
                ->setParameter('end', $end)
            ;
        }

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
            ->andWhere('fp.startsAt > :datetime')
            ->setParameter('datetime', new \DateTime())
            ->join('fp.programmationFilms', 'pf')
            ->andWhere('pf.film IS NOT NULL')
            ->andWhere('fp.type NOT IN (:types)')
            ->setParameter('types', array('Séance de presse', 'Conférence de presse'))
        ;

        $this->addMasterQueries($qb, 'fp', $festival, false);

        $qb
            ->addOrderBy('fp.startsAt', 'asc')
            ->setMaxResults($count)
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param FilmFilm $film
     * @param null $types
     * @return array
     */
    public function getNextProjectionByFilm(FilmFilm $film, $types = null)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.programmationFilms', 'pf')
            ->andWhere('pf.film = :film_id')
            ->setParameter(':film_id', $film->getId())
            //->andWhere('p.startsAt > :start_at')
            ->addOrderBy('p.startsAt', 'asc')
        ;

        if ($types !== null) {
            $qb
                ->andWhere('p.type IN (:types)')
                ->setParameter('types', $types)
            ;
        }

        //$qb->setParameter('start_at', new \DateTime());

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