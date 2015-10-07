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
    public function getFestivalSettings()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.id', 'desc')
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleResult();
    }
}