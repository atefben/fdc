<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\MediaTranslationInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FilmFilmRepository class.
 * 
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class FilmFilmRepository extends EntityRepository
{
    public function getApiFilms($festival, $selection)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->setParameter('festival', $festival);

        if ($selection !== null) {
            $query = $query->andWhere('f.selection = :selection')
                ->setParameter('selection', $selection);
        }

        return $query;
    }

    public function getApiFilm($id, $festival)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.id = :id')
            ->setParameter('festival', $festival)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        return $query;
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
            ->getQuery();
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
            ->getOneOrNullResult();;
    }
}