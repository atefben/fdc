<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\MediaTranslationInterface;

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

    public function getApiFilmTrailers($festival, $dateTime, $locale)
    {
        return $this->createQueryBuilder('f')
            ->join('f.mediaVideos', 'mv')
            ->join('mv.sites', 's')
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('mv.inTrailer = :inTrailer')
            ->andWhere('mvt.locale = :locale')
            ->andWhere('mvt.status = :status')
            ->andWhere('(mv.publishedAt IS NULL OR mv.publishedAt <= :datetime)')
            ->andWhere('(mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :datetime)')
            ->setParameter('festival', $festival)
            ->setParameter('inTrailer', true)
            ->setParameter('locale', $locale)
            ->setParameter('status', MediaTranslationInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery()
            ;
    }

    public function getApiTrailers($id, $festival, $dateTime, $locale)
    {
        return $this->createQueryBuilder('f')
            ->join('f.mediaVideos', 'mv')
            ->join('mv.sites', 's')
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->andWhere('f.id = :id')
            ->andWhere('s.slug = :site')
            ->andWhere('mv.inTrailer = :inTrailer')
            ->andWhere('mvt.locale = :locale')
            ->andWhere('mvt.status = :status')
            ->andWhere('(mv.publishedAt IS NULL OR mv.publishedAt <= :datetime)')
            ->andWhere('(mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :datetime)')
            ->setParameter('id', $id)
            ->setParameter('festival', $festival)
            ->setParameter('inTrailer', true)
            ->setParameter('locale', 'fr')
            ->setParameter('status', MediaTranslationInterface::STATUS_PUBLISHED)
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
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.translations', 'mvt')
            ->where('f.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('t.locale = :locale')
            ->andWhere('mvt.locale = :locale')
            ->andWhere('mvt.status IN (1,5)')
            ->setParameter('locale', $locale)
            ->andWhere('mv.displayedTrailer = 1')
            ->andWhere('(mv.publishedAt IS NULL OR mv.publishedAt <= :datetime)')
            ->andWhere('(mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :datetime)')
            ->setParameter(':datetime', new \DateTime())
            ->orderBy('t.title', 'asc')
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