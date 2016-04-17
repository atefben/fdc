<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * SettingsRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class SettingsRepository extends EntityRepository
{
    public function getFestivalDate()
    {
        return $this->createQueryBuilder('s')
            ->select('f.festivalStartsAt, f.festivalEndsAt')
            ->leftJoin('s.festival', 'f')
            ->where('s.slug = :slug')
            ->setParameter('slug', 'fdc-year')
            ->getQuery()
            ->getArrayResult();
    }
}