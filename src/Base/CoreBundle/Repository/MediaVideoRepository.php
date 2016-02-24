<?php

namespace Base\CoreBundle\Repository;


use Base\CoreBundle\Component\Repository\EntityRepository;

class MediaVideoRepository extends EntityRepository
{

    public function get2VideosFromTheLast10($festival, $locale, $excludeWebTv = null)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb
            ->select('mv,
            RAND() as hidden rand')
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->setParameter('festival', $festival)
        ;

        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addAWSEncodersQueries($qb, 'mvt');

        if ($excludeWebTv) {
            $qb
                ->andWhere('mv.webTv != :webTv')
                ->setParameter('webTv', $excludeWebTv)
            ;
        }

        $qb
            ->orderBy('rand')
            ->setMaxResults(2)
        ;

        return $qb->getQuery()->getResult();
    }

    public function getWebTvPublishedVideos($locale, $festival, $webTv)
    {
        $qb = $this->createQueryBuilder('mv');
        $qb = $qb
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('mv.webTv = :webTv')
            ->setParameter('webTv', $webTv)
        ;

        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $qb
            ->orderBy('mvt.title', 'asc');
        return $qb->getQuery()->getResult();
    }

    public function getFilmTrailersMediaVideos($festival, $locale, $film)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb
            ->join('mv.associatedFilms', 'mvaf')
            ->join('mv.translations', 'mvt')
            ->join('mvaf.association', 'f')
            ->where('f.id = :film')
            ->setParameter('film', $film)
        ;

        $qb = $this->addMasterQueries($qb, 'mv', $festival, true);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addAWSEncodersQueries($qb, 'mvt');

        $qb
            ->andWhere('mv.displayedTrailer = 1')
            ->orderBy('mv.publishedAt', 'desc')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getLastMediaVideoTrailerOfEachFilmFilm($festival, $locale, $in = null, $selectionSection = null)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb
            ->select('mv lastVideo, f.id film_id')
            ->join('mv.associatedFilms', 'mvaf')
            ->join('mv.translations', 'mvt')
            ->join('mvaf.association', 'f')
            ->where('mv.displayedTrailer = :displayedTrailer')
            ->setParameter('displayedTrailer', true)
        ;
        if ($in) {
            $qb
                ->andWhere('f.id in (:film)')
                ->setParameter('film', $in)
            ;
        }

        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addMasterQueries($qb, 'f', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addAWSEncodersQueries($qb, 'mvt');

        $qb
            ->orderBy('f.titleVO', 'desc')
            ->orderBy('mv.publishedAt', 'desc')
            ->groupBy('film_id')
        ;

        if ($selectionSection) {
            $qb
                ->andWhere('f.selectionSection = :selectionSection')
                ->setParameter('selectionSection', $selectionSection)
            ;
        }

        return $qb->getQuery()->getResult();
    }

    public function getAvailableVideosByWebTv($festival, $locale, $webtv)
    {

        $qb = $this->createQueryBuilder('mv');
        $qb
            ->join('mv.translations', 'mvt')
            ->join('mv.webTv', 'wtv')
            ->where('mv.webTv = :webTv')
            ->setParameter('webTv', $webtv)
        ;

        $qb = $this->addMasterQueries($qb, 'mv', $festival, true);
        $qb = $this->addMasterQueries($qb, 'wtv', $festival, false);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addAWSEncodersQueries($qb, 'mvt');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $festival
     * @param $locale
     * @param $film
     * @return array
     */
    public function getAvailableTrailersByFilm($festival, $locale, $film)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb
            ->join('mv.associatedFilms', 'mvaf')
            ->join('mv.translations', 'mvt')
            ->join('mvaf.association', 'f')
            ->where('mv.displayedTrailer = :displayedTrailer')
            ->setParameter('displayedTrailer', true)
            ->andWhere('f.id = :film_id')
            ->setParameter('film_id', $film)
        ;

        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addMasterQueries($qb, 'f', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addAWSEncodersQueries($qb, 'mvt');

        $qb
            ->orderBy('f.titleVO', 'desc')
            ->orderBy('mv.publishedAt', 'desc')
        ;

        return $qb->getQuery()->getResult();
    }

}