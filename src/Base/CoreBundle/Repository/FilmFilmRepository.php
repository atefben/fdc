<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMediaInterface;
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

    /**
     * @param $id
     * @param $festival
     * @return FilmFilm
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
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

    public function getFilmsByIds($ids) {
        $qb = $this->createQueryBuilder('f');

        $qb
            ->where('f.id  IN (:ids)')
            ->setParameter(':ids', $ids)
        ;

        return $qb->getQuery()->getResult();

    }

    /**
     * @param $festival
     * @param $locale
     * @param $selectionSection
     * @return array
     */
    public function getFilmsBySelectionSection($festival, $locale, $selectionSection)
    {
        $qb = $this->createQueryBuilder('f');

        $qb
            ->join('f.translations', 't')
            ->join('f.medias', 'm')
            ->andWhere('m.type = :type')
            ->setParameter('type', FilmFilmMediaInterface::TYPE_POSTER) // add condition for others film images fallback.
            ->andWhere('f.selectionSection = :selectionSection')
            ->setParameter('selectionSection', $selectionSection)
        ;

        $this->addMasterQueries($qb, 'f', $festival, false);
        $this->addTranslationQueries($qb, 't', $locale);


        $qb->orderBy('f.titleVO', 'asc');

        return $qb->getQuery()->getResult();

    }
}