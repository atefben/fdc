<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmFilmMediaInterface;

/**
 * Class FilmFilmMediaRepository
 * @package Base\CoreBundle\Repository
 */
class FilmFilmMediaRepository extends EntityRepository
{
    /**
     * @param $search
     * @param $yearStart
     * @param $yearEnd
     * @param $since
     * @return FilmFilmMedia[]
     */
    public function getMedias($search, $yearStart, $yearEnd, $since = null)
    {
        $qb = $this->createQueryBuilder('ffm')
            ->innerJoin('ffm.media', 'fm')
            ->innerJoin('ffm.film', 'f')
            ->innerJoin('f.festival', 'festival')
            ->innerJoin('f.translations', 'ft')
            ->andWhere('ffm.type != :pdf')
            ->setParameter(':pdf', FilmFilmMediaInterface::TYPE_PRESS_PDF)
            ->andWhere('f.titleVO LIKE :search OR ft.title LIKE :search OR fm.titleVf LIKE :search OR fm.titleVa LIKE :search')
            ->setParameter('search', '%' . $search . '%')
        ;

        if ($yearStart && $yearEnd) {
            $qb->andWhere('festival.year BETWEEN :yearStart AND :yearEnd')
                ->setParameter('yearStart', $yearStart)
                ->setParameter('yearEnd', $yearEnd)
            ;
        }

        if ($since) {
            $qb
                ->andWhere('ffm.updatedAt <= :since')
                ->setParameter(':since', $since)
            ;
        }

        return $qb
            ->addOrderBy('ffm.updatedAt', 'desc')
            ->getQuery()
            ->getResult();
    }

}