<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\PushFilmMobile;

/**
 * Class PushFilmMobileRepository
 * @package Base\CoreBundle\Repository
 */
class PushFilmMobileRepository extends EntityRepository
{
    /**
     * @return PushFilmMobile[]
     */
    public function getByDailyFilms()
    {
        $start = new \DateTime();
        $start->setTime(0, 0, 0);

        $end = new \DateTime();
        $end->setTime(23, 59, 59);

        return $this
            ->createQueryBuilder('p')
            ->innerJoin('p.film', 'film')
            ->andWhere('film.publishedAt BETWEEN :start AND :end')
            ->setParameter(':start', $start)
            ->setParameter(':end', $end)
            ->getQuery()
            ->getResult()
        ;
    }
}
