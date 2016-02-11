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

    public function getProjectionSchedulingByDate($locale, $festival, $date)
    {

        $qb = $this
            ->createQueryBuilder('p')
            ->select('p')
            ->leftjoin('Base\CoreBundle\Entity\FilmProjection', 'fp', 'WITH', 'fp.id = p.projection')
            ->leftjoin('fp.translations', 'fpt')
            ->where('n.festival = :festival')
            ->andWhere('fpt.locale = :locale')
            ->andWhere('DATE(fp.startsAt) = :date');


        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('date', $date)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();

        return $qb;
    }


}