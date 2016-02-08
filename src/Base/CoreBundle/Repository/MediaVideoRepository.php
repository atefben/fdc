<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MediaVideoRepository extends EntityRepository
{

    public function get2VideosFromTheLast10($locale, $festival, $excludeWebTv = null)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('mvt.locale = :locale')
            ->setParameter('locale', $locale);

        if ($excludeWebTv) {
            $qb
                ->andWhere('mv.webTv != :webTv')
                ->setParameter('webTv', $excludeWebTv);
        }

        $qb
            ->andWhere('mvt.status in (1, 5)')
            ->setMaxResults(10);

        $results = $qb->getQuery()->getResult();
        if (count($results) > 2) {
            return array_rand($results, 2);
        }
        return $results;
    }

    public function getWebTvPublishedVideos($locale, $festival, $webTv)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('mv.webTv = :webTv')
            ->setParameter('webTv', $webTv)
            ->andWhere('mvt.locale = :locale')
            ->setParameter('locale', $locale)
            ->andWhere('mvt.status in (1, 5)')
        ;
        return $qb->getQuery()->getResult();
    }

}