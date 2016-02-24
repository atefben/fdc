<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\NewsArticleTranslation;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FilmFilmRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmFilmRepository extends EntityRepository
{
    public function getApiFilms($festival, $selection)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->setParameter('festival', $festival)
        ;

        if ($selection !== null) {
            $query = $query->andWhere('f.selection = :selection')
                ->setParameter('selection', $selection)
            ;
        }

        return $query;
    }

    public function getApiFilm($id, $festival)
    {
        return $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.id = :id')
            ->setParameter('festival', $festival)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getApiFilmTrailers($festival, $locale)
    {
        $qb = $this->createQueryBuilder('f')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.translations', 'mvt')
            ->where('mv.displayedTrailer = :displayedTrailer')
            ->setParameter('displayedTrailer', true)
        ;

        $qb = $this->addMasterQueries($qb, 'mv', $festival);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addMobileQueries($qb, 'mv');

        return $qb->getQuery();
    }

    public function getApiTrailers($id, $festival, $locale)
    {
        $qb = $this->createQueryBuilder('f')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.translations', 'mvt')
            ->where('f.id = :id')
            ->andWhere('mv.displayedTrailer = :displayed_trailer')
            ->setParameter('id', $id)
            ->setParameter('displayed_trailer', true)
        ;

        $qb = $this->addMasterQueries($qb, 'mv', $festival);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addMobileQueries($qb, 'mv');


        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getFilmsThatHaveTrailers($festival, $locale, $selectionSection = null)
    {
        $qb = $this->createQueryBuilder('f')
            ->join('f.translations', 't')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.sites', 's')
            ->join('mv.translations', 'mvt')
            ->where('mv.displayedTrailer = :displayed_trailer')
            ->where('mv.displayedTrailer = :displayed_trailer')
            ->andWhere('t.slug IS NOT NULL')
            ->andWhere("t.slug != ''")
            ->setParameter('displayed_trailer', true)
        ;

        $this->addMasterQueries($qb, 'mv', $festival);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addFDCEventQueries($qb, 's');
        $qb->orderBy('t.title', 'asc');


        if ($selectionSection) {
            $qb
                ->andWhere('f.selectionSection = :selectionSection')
                ->setParameter('selectionSection', $selectionSection)
            ;
        }

        return $qb->getQuery()->getResult();
    }
}