<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FilmFilmRepository class.
 * 
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmFilmRepository extends EntityRepository
{
    public function paginate($page, $offset)
    {
        return new Paginator($this->createQueryBuilder('ff')
            ->setFirstResult(($page * $offset) - 1)
            ->setMaxResults($offset));
    }
}