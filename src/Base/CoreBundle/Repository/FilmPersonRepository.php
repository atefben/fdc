<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Interfaces\FilmFunctionInterface;

use Doctrine\ORM\EntityRepository;

/**
 * FilmPersonRepository class.
 *
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmPersonRepository extends EntityRepository
{
    public function getArtist($locale, $slug)
    {
        return $this->createQueryBuilder('fp')
            ->leftJoin('fp.translations', 'fpt')
            ->leftJoin('fp.nationality', 'fpc')
            ->leftJoin('fpc.translations', 'fpct')
            ->leftJoin('fp.nationality2', 'fpc2')
            ->leftJoin('fpc2.translations', 'fpct2')
            ->where('fp.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getDirectorsRandomly($count)
    {
        return $this->createQueryBuilder('fp')
            ->select('
                fp,
                RAND() as HIDDEN rand
            ')
            ->leftJoin('fp.films', 'ffp')
            ->leftJoin('ffp.functions', 'ffpf')
            ->leftJoin('ffpf.function', 'ff')
            ->where('ff.id = :id_director')
            ->setParameter('id_director', FilmFunctionInterface::ID_DIRECTOR)
            ->addOrderBy('rand')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }

}