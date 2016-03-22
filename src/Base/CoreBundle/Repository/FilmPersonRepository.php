<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\FilmPerson;
use Base\CoreBundle\Interfaces\FilmFunctionInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

/**
 * FilmPersonRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmPersonRepository extends EntityRepository
{
    /**
     * @param $slug
     * @return FilmPerson
     * @throws NonUniqueResultException
     */
    public function getArtist($slug)
    {
        return $this
            ->createQueryBuilder('fp')
            ->leftJoin('fp.translations', 'fpt')
            ->leftJoin('fp.nationality', 'fpc')
            ->leftJoin('fpc.translations', 'fpct')
            ->leftJoin('fp.nationality2', 'fpc2')
            ->leftJoin('fpc2.translations', 'fpct2')
            ->where('fp.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getDirectorsRandomly($festival, $count, $exclude)
    {
        return $this
            ->createQueryBuilder('fp')
            ->select('
                fp,
                RAND() as HIDDEN rand
            ')
            ->join('fp.films', 'ffp')
            ->join('ffp.film', 'film')
            ->join('ffp.functions', 'ffpf')
            ->join('ffpf.function', 'ff')
            ->join('fp.medias', 'fpm')
            ->andWhere('fp.firstname IS NOT NULL')
            ->andWhere('fp.firstname != :empty')
            ->setParameter('empty', "")
            ->andWhere('film.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('ff.id = :id_director')
            ->setParameter('id_director', FilmFunctionInterface::FUNCTION_DIRECTOR)
            ->andWhere('(fp.portraitImage IS NOT NULL OR fpm.media IS NOT NULL)')
            ->andWhere('fp.id != :exclude')
            ->setParameter('exclude', $exclude)
            ->addOrderBy('rand')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
            ;
    }

}