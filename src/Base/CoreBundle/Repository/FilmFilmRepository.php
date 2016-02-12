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
            ->setParameter('displayedTrailer', true);

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
            ->andWhere('mv.displayedTrailer = :displayedTrailer')
            ->setParameter('id', $id)
            ->setParameter('displayedTrailer', true);

        $qb = $this->addMasterQueries($qb, 'mv', $festival);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addMobileQueries($qb, 'mv');


        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getFilmsThatHaveTrailers($festival, $locale, $selectionSection = null)
    {
        $qb = $this->createQueryBuilder('f');
        $qb
            ->join('f.translations', 't')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.association', 'm')
            ->join('m.translations', 'mt')
            ->where('f.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('t.locale = :locale')
            ->andWhere('mt.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($selectionSection) {
            $qb
                ->andWhere('f.selectionSection = :selectionSection')
                ->setParameter('selectionSection', $selectionSection)
            ;

        }
        return $qb->getQuery()->getResult();
    }
}