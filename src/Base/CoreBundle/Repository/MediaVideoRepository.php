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
            ->setParameter('locale', $locale)
        ;

        if ($excludeWebTv) {
            $qb
                ->andWhere('mv.webTv != :webTv')
                ->setParameter('webTv', $excludeWebTv)
            ;
        }

        $qb
            ->andWhere('mvt.status in (1, 5)')
            ->setMaxResults(10)
        ;

        $results = $qb->getQuery()->getResult();
        if (count($results) > 2) {
            return array_rand($results, 2);
        }
        return $results;
    }

    public function getWebTvPublishedVideos($locale, $festival, $webTv)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('mv.webTv = :webTv')
            ->setParameter('webTv', $webTv)
            ->andWhere('mvt.locale = :locale')
            ->setParameter('locale', $locale)
            ->andWhere('mvt.status in (1, 5)')
            ->orderBy('mvt.title', 'asc')
        ;
        return $qb->getQuery()->getResult();
    }

    public function getFilmTrailersMediaVideos($locale, $film)
    {
        $qb = $this->createQueryBuilder('v');

        $qb
            ->join('v.associatedFilms', 'maf')
            ->join('v.translations', 't')
            ->join('maf.association', 'f')
            ->where('f.id = :film')
            ->setParameter('film', $film)
            ->andWhere('t.locale = :locale')
            ->setParameter('locale', $locale)
            ->andWhere('t.status IN (1,5)')
            ->andWhere('v.displayedTrailer = 1')
            ->andWhere('(v.publishedAt IS NULL OR v.publishedAt <= :datetime)')
            ->andWhere('(v.publishEndedAt IS NULL OR v.publishEndedAt >= :datetime)')
            ->setParameter(':datetime', new \DateTime())
            ->orderBy('t.title', 'asc')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $locale
     * @param integer $film
     */
    public function getVideosByFilm($locale, $film)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb
            ->join('mv.translations', 'mvt')
            ->where('mv.locale = :locale')
            ->setParameter('locale', $locale)
            ->andWhere('m')
        ;
    }

}