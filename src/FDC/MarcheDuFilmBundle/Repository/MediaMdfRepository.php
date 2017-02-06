<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Entity\MediaMdfAudioTranslation;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfImageTranslation;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfVideoTranslation;
use Base\CoreBundle\Entity\NewsArticleTranslation;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\Site;

/**
 * MediaMdfRepository class.
 *
 * \@extends EntityRepository
 */
class MediaMdfRepository extends EntityRepository
{

    /**
     * Find all displayed images
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function getImageMedia($locale, $festival)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $qb = $this->addMasterQueries($qb, 'mi', $festival);
        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addFDCEventQueries($qb, 's');
        $qb = $qb->orderBy('mi.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $qb;
    }

    /**
     * @param $locale
     * @param $festival
     * @param Site|null $site
     * @return array|\Doctrine\ORM\QueryBuilder
     */
    public function getOldMedia($locale, $festival, Site $site = null)
    {
        $qb = $this->createQueryBuilder('m')
            ->innerJoin('m.sites', 's')
            ->innerJoin('m.festival', 'f')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo', 'mv', 'WITH', 'mv.id = m.id')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio', 'ma', 'WITH', 'ma.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->leftjoin('mv.translations', 'mvt')
            ->leftjoin('ma.translations', 'mat')
            ->andWhere('f.id = :festival')
        ;
        $qb->setParameter('festival', $festival);

        if ($site) {
            $qb
                ->distinct(true)
                ->andWhere('s.id = :sid')
                ->setParameter(':sid', $site->getId())
            ;
        }

        $qb = $qb
            ->andWhere("m.publishEndedAt IS NULL")
        ;

        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addTranslationQueries($qb, 'mat', $locale);
        $qb = $qb
            ->orderBy('ma.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();

        //dump($qb);exit;

        return $qb;
    }

    public function searchTest($locale, $search, $photo = false, $video = false, $audio = false, $yearStart = null, $yearEnd = null, $limit = 500) {
        $qb = $this->createQueryBuilder('m')
            ->leftJoin('m.theme', 't')
            ->leftJoin('t.translations', 'tt')
            ->andWhere('m.displayedAll = 1');

            $qb->leftJoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfImage', 'mi', 'WITH', 'mi.id = m.id')
                ->leftJoin('mi.translations', 'mit');
            $qb->leftJoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo', 'mv', 'WITH', 'mv.id = m.id')
                ->leftJoin('mv.translations', 'mvt');
            $qb->leftJoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio', 'ma', 'WITH', 'ma.id = m.id')
                ->leftJoin('ma.translations', 'mat');

        $qb = $qb->andWhere("m.publishEndedAt IS NULL")
            ->orderBy('m.publishedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        return $qb;
    }

    public function searchMedias($locale, $search, $photo = false, $video = false, $audio = false, $yearStart = null, $yearEnd = null, $limit = 30, $page = 1) {

        $qb = $this->createQueryBuilder('m')
            ->leftJoin('m.theme', 't')
            ->leftJoin('t.translations', 'tt')
            ->leftJoin('m.tags', 'mediatags')
            ->leftJoin('mediatags.tag', 'tag')
            ->leftJoin('tag.translations', 'tagt');

        $searchOr = array('tt.name LIKE :search', 'tagt.name LIKE :search');

        if($photo) {
            $qb->leftJoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfImage', 'mi', 'WITH', 'mi.id = m.id')
                ->leftJoin('mi.translations', 'mit')
                ->andWhere('(m.associatedFilm IS NOT NULL) OR (m.displayedHome = 1)');

            $qb = $this->addTranslationQueries($qb, 'mit', $locale);

            $searchOr[] = 'mit.legend LIKE :search';
        }

        if($video) {
            $qb->leftJoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo', 'mv', 'WITH', 'mv.id = m.id')
                ->leftJoin('mv.translations', 'mvt')
                ->leftJoin('mv.webTv', 'w')
                ->leftJoin('w.translations', 'wt')
                ->andWhere('mv.displayedAll = 1 OR mv.displayedWebTv = 1 OR mv.displayedTrailer = 1');

            $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
            $qb = $this->addTranslationQueries($qb, 'wt', $locale);

            $searchOr[] = 'mvt.title LIKE :search';
            $searchOr[] = 'wt.name LIKE :search';
        }

        if($audio) {
            $qb->leftJoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio', 'ma', 'WITH', 'ma.id = m.id')
                ->leftJoin('ma.translations', 'mat')
                ->andWhere('m.displayedAll = 1');

            $qb = $this->addTranslationQueries($qb, 'mat', $locale);

            $searchOr[] = 'mat.title LIKE :search';

        }

        $qb->andWhere('('.implode(' OR ', $searchOr).')');

        $qb->setParameter('search', '%'.$search.'%');

        if($yearStart && $yearEnd) {
            $qb->innerJoin('m.festival', 'f')
                ->andWhere('f.year BETWEEN :yearStart AND :yearEnd')
                ->setParameter('yearStart', $yearStart)
                ->setParameter('yearEnd', $yearEnd);
        }

        //because of entity relations
        $max = $limit * 4;

        $qb = $qb->andWhere("m.publishEndedAt IS NULL")
            ->orderBy('m.publishedAt', 'DESC')
            ->setMaxResults($max)
            ->getQuery()
            ->getResult();

        return $qb;
    }

    /**
     * @param $locale
     * @param $festival
     * @param Site|null $site
     * @return array|\Doctrine\ORM\QueryBuilder
     */
    public function getMedia($locale, $festival, Site $site = null)
    {
        $qb = $this->createQueryBuilder('m')
            ->innerJoin('m.sites', 's')
            ->innerJoin('m.festival', 'f')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo', 'mv', 'WITH', 'mv.id = m.id')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio', 'ma', 'WITH', 'ma.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->leftjoin('mv.translations', 'mvt')
            ->leftjoin('ma.translations', 'mat')
            ->andWhere('f.id = :festival')
            ->andWhere('m.displayedAll = 1')
        ;
        $qb->setParameter('festival', $festival);

        if ($site) {
            $qb
                ->distinct(true)
                ->andWhere('s.id = :sid')
                ->setParameter(':sid', $site->getId())
            ;
        }

        $qb = $qb
            ->andWhere("m.publishEndedAt IS NULL")
        ;

        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addTranslationQueries($qb, 'mat', $locale);
        $qb = $qb
            ->orderBy('ma.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();

        //dump($qb);exit;

        return $qb;
    }

    /**
     * Find all displayed images of the day
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function getImageMediaByDay($locale, $festival, $dateTime)
    {

        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';

        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('(m.publishedAt >= :datetime) AND (m.publishedAt < :datetime2)')
            ->andWhere('m.displayedHome = 1');

        $qb = $this->addMasterQueries($qb, 'mi', $festival, false);
        $qb
            ->andWhere("mit.locale = 'fr' AND mit.status = :status_published")
            ->setParameter('status_published', NewsArticleTranslation::STATUS_PUBLISHED)
        ;
        $qb = $this->addFDCEventQueries($qb, 's');
        $qb = $qb
            ->setParameter('datetime', $dateTime1)
            ->setParameter('datetime2', $dateTime2);

        $qb = $qb
            ->orderBy('mi.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $qb;
    }

    /**
     * Find all displayed video
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function getVideoMedia($locale, $festival)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $this->addMasterQueries($qb, 'mi', $festival);
        $this->addTranslationQueries($qb, 'mit', $locale);$qb = $this->addFDCEventQueries($qb, 's');
        $this->addAWSVideoEncodersQueries($qb, 'mit');
        return $qb->orderBy('mi.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find all displayed audio
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function getAudioMedia($locale, $festival)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $qb = $this->addMasterQueries($qb, 'mi', $festival);
        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addFDCEventQueries($qb, 's');
        $qb = $qb->orderBy('mi.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $qb;
    }

}