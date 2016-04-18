<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * FilmPrizeRepository class.
 * 
 * \@extends EntityRepository
*  @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmPrizeRepository extends EntityRepository
{
    public function findTranslations($locale)
    {
        return $this->createQueryBuilder('fp')
            ->join('translations', 'fpt')
            ->where('fpt.locale = :locale')
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }
}