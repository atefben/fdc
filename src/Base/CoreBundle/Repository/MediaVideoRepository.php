<?php

namespace Base\CoreBundle\Repository;


use Base\CoreBundle\Component\Repository\EntityRepository;

class MediaVideoRepository extends EntityRepository
{

    public function get2VideosFromTheLast10($locale, $festival, $excludeWebTv = null)
    {
        $qb = $this->createQueryBuilder('mv');

        $qb = $qb
            ->select('mv,
            RAND() as hidden rand')
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->setParameter('festival', $festival)
        ;

        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);

        if ($excludeWebTv) {
            $qb = $qb
                ->andWhere('mv.webTv != :webTv')
                ->setParameter('webTv', $excludeWebTv)
            ;
        }

        $qb = $qb
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
            ->setParameter('webTv', $webTv);

        $qb = $qb->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $qb
            ->orderBy('mvt.title', 'asc')
        ;
        return $qb->getQuery()->getResult();
    }

    public function getFilmTrailersMediaVideos($locale, $film)
    {
        $qb = $this->createQueryBuilder('v');

        $qb = $qb
            ->join('v.associatedFilms', 'maf')
            ->join('v.translations', 'vt')
            ->join('maf.association', 'f')
            ->where('f.id = :film')
            ->setParameter('film', $film);

        $qb = $qb->addTranslationQueries($qb, 'vt', $locale);
        $qb = $qb
            ->andWhere('v.displayedTrailer = 1')
            ->andWhere('(v.publishedAt IS NULL OR v.publishedAt <= :datetime)')
            ->andWhere('(v.publishEndedAt IS NULL OR v.publishEndedAt >= :datetime)')
            ->setParameter(':datetime', new \DateTime())
            ->orderBy('vt.title', 'asc')
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
        $qb = $qb
            ->join('mv.translations', 'mvt')
            ->where('mv.locale = :locale')
            ->setParameter('locale', $locale)
            ->andWhere('m')
        ;
    }

}