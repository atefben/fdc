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

    /**
     * @param $festival
     * @param \DateTime|null $day
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getApiProjections($festival, $day = null, $filmId = null)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->addOrderBy('fp.startsAt', 'desc');
        ;

        if ($day && is_string($day) && preg_match('/(19|20|21)[0-9]{2}-[0-9]{1,2}-[0-9]{1,2}/', $day)) {
            $split = explode('-', $day);
            if (count($split) === 3) {
                $date = new \DateTime;
                $date->setDate($split[0], $split[1], $split[2]);

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
            ->where("DATE_FORMAT(p.startsAt,'%Y%m%d') = :date");


        $qb = $qb
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();

        return $qb;
    }

}