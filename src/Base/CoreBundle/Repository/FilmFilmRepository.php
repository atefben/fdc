<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\NewsArticleTranslation;

use Doctrine\ORM\EntityRepository;
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

    public function getApiFilmTrailers($festival, $dateTime)
    {
        return $this->createQueryBuilder('f')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.sites', 's')
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('mv.displayedTrailer = :displayedTrailer')
            ->andWhere('mvt.status = :status OR mvt.status = :status_translated')
            ->andWhere('(mv.publishedAt IS NULL OR mv.publishedAt <= :datetime)')
            ->andWhere('(mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :datetime)')
            ->setParameter('festival', $festival)
            ->setParameter('displayedTrailer', true)
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
            ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery()
            ;
    }

    public function getApiTrailers($id, $festival, $dateTime)
    {
        return $this->createQueryBuilder('f')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.sites', 's')
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->andWhere('f.id = :id')
            ->andWhere('s.slug = :site')
            ->andWhere('mv.displayedTrailer = :displayedTrailer')
            ->andWhere('mvt.locale = :locale')
            ->andWhere('mvt.status = :status OR mvt.status = :status_translated')
            ->andWhere('(mv.publishedAt IS NULL OR mv.publishedAt <= :datetime)')
            ->andWhere('(mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :datetime)')
            ->setParameter('id', $id)
            ->setParameter('festival', $festival)
            ->setParameter('displayedTrailer', true)
            ->setParameter('locale', 'fr')
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
            ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery()
            ->getOneOrNullResult()
            ;;
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