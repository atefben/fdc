<?php

namespace Base\CoreBundle\Repository;

class MediaVideoRepository extends TranslationRepository
{

    public function get2VideosFromTheLast10($festival, $locale, $excludeWebTv = null)
    {
        $qb = $this->createQueryBuilder('mv');
        $qb
            ->select('mv')
            ->join('mv.translations', 'mvt')
        ;

        $this->addImageQueries($qb, 'mv', 'mvt');
        $this->addMasterQueries($qb, 'mv', $festival);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        if ($excludeWebTv) {
            $qb
                ->andWhere('mv.webTv != :webTv')
                ->setParameter('webTv', $excludeWebTv)
            ;
        }

        $qb
            ->orderBy('mv.publishedAt', 'desc')
            ->setMaxResults(10)
        ;

        $results = $qb->getQuery()->getResult();

        //random key but different from 1st result
        $rand1 = array_rand($results);
        $rand2  = array_rand($results);
        while($rand1 == $rand2) {
            $rand2 = array_rand($results);
        }

        $result[0] = $results[$rand1];
        $result[1] = $results[$rand2];

        return $result;
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

        $this->addImageQueries($qb, 'mv', 'mvt');
        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        $qb
            ->andWhere('mv.displayedTrailer = 1')
            ->orderBy('mvt.title', 'asc')
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

        $this->addImageQueries($qb, 'mv', 'mvt');
        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addMasterQueries($qb, 'f', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', 'fr');
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        $qb
            ->orderBy('f.titleVO', 'desc')
            ->addOrderBy('mv.publishedAt', 'desc')
            ->groupBy('film_id')
            ->addGroupBy('mv.id')
        ;

        if ($selectionSection) {
            $qb
                ->andWhere('f.selectionSection = :selectionSection')
                ->setParameter('selectionSection', $selectionSection)
            ;
        }

        return $qb->getQuery()->getResult();
    }

    public function getLastMediaVideoOfEachWebTv($festival, $locale, $in)
    {

        $qb = $this->createQueryBuilder('mv');

        $qb
            ->select('mv lastVideo, wtv.id channel')
            ->join('mv.translations', 'mvt')
            ->join('mv.webTv', 'wtv')
            ->join('wtv.translations', 'wtvt')
            ->where('wtv.id IN (:in)')
            ->setParameter('in', $in)
        ;

        $this->addImageQueries($qb, 'mv', 'mvt');
        $this->addMasterQueries($qb, 'mv', $festival, false);
        $this->addMasterQueries($qb, 'wtv', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', 'fr');
        $this->addTranslationQueries($qb, 'wtvt', 'fr');
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        $qb
            ->orderBy('mv.publishedAt', 'desc')
            ->groupBy('channel', 'lastVideo')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getLastMediaVideoByWebTv($festival, $webtv)
    {

        $qb = $this->createQueryBuilder('mv');

        $qb
            ->join('mv.translations', 'mvt')
            ->join('mv.webTv', 'wtv')
            ->leftJoin('mv.image', 'img')
            ->join('wtv.translations', 'wtvt')
            ->andWhere('wtv.id IN (:in)')
            ->setParameter('in', $webtv->getId())
        ;

        $this->addImageQueries($qb, 'mv', 'mvt', 'img');
        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addMasterQueries($qb, 'wtv', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', 'fr');
        $this->addTranslationQueries($qb, 'wtvt', 'fr');
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        $qb
            ->orderBy('mv.publishedAt', 'desc')
            ->setMaxResults(1)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getAvailableMediaVideosByWebTv($festival, $locale, $in)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb
            ->select('mv')
            ->join('mv.translations', 'mvt')
            ->join('mv.webTv', 'wtv')
            ->join('wtv.translations', 'wtvt')
            ->where('wtv.id IN (:in)')
            ->andWhere('(mv.image IS NOT NULL OR mvt.imageAmazonUrl IS NOT NULL)')
            ->setParameter('in', $in)
            ->andWhere('mv.displayedWebTv = :displayedWebTv')
            ->setParameter('displayedWebTv', true)
        ;

        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addMasterQueries($qb, 'wtv', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addTranslationQueries($qb, 'wtvt', $locale);
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        $qb
            ->orderBy('mv.publishedAt', 'desc')
        ;

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

        $this->addImageQueries($qb, 'mv', 'mvt');
        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addMasterQueries($qb, 'f', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        $qb
            ->orderBy('f.titleVO', 'desc')
            ->orderBy('mv.publishedAt', 'desc')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getApiLiveMediaVideos($festival, $locale, $maxResults = 5)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb
            ->select('mv')
            ->join('mv.translations', 'mvt')
            ->join('mv.webTv', 'wtv')
            ->join('wtv.translations', 'wtvt')
            ->andWhere('(mv.image IS NOT NULL OR mvt.imageAmazonUrl IS NOT NULL)')
            ->andWhere('mv.displayedHome = :displayedHome')
            ->setParameter('displayedHome', true)
            ->setMaxResults($maxResults)
        ;

        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addMasterQueries($qb, 'wtv', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', $locale, null, true);
        $this->addTranslationQueries($qb, 'wtvt', $locale);
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        $qb
            ->orderBy('mv.publishedAt', 'desc')
        ;

        return $qb->getQuery()->getResult();
    }



}