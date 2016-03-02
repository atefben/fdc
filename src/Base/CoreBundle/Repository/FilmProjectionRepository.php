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