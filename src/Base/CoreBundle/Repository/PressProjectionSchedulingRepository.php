<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\NewsArticleTranslation;

use Doctrine\ORM\EntityRepository;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * PressProjectionSchedulingRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class PressProjectionSchedulingRepository extends EntityRepository
{

    public function getProjectionByDate($date)
    {

        $qb = $this
            ->createQueryBuilder('p')
            ->select('p')
            ->leftjoin('Base\CoreBundle\Entity\FilmProjection', 'fp', 'WITH', 'fp.id = p.projection')
            ->where("DATE_FORMAT(fp.startsAt,'%Y%m%d') = :date");


        $qb = $qb
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();

        return $qb;
    }


}