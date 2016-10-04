<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\NewsArticleTranslation;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\Site;

/**
 * MediaRepository class.
 *
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class MediaRepository extends EntityRepository
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
            ->leftjoin('Base\CoreBundle\Entity\MediaImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $qb = $this->addMasterQueries($qb, 'mi', $festival);
        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addFDCEventQueries($qb, 's');
        $qb = $qb->setMaxResults(100)
            ->orderBy('mi.publishedAt', 'DESC')
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
    public function getImageMediaCorporate($locale, $festival, Site $site = null)
    {
        $qb = $this->createQueryBuilder('m')
            ->innerJoin('m.sites', 's')
            ->innerJoin('m.festival', 'f')
            ->leftjoin('Base\CoreBundle\Entity\MediaImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('Base\CoreBundle\Entity\MediaVideo', 'mv', 'WITH', 'mv.id = m.id')
            ->leftjoin('Base\CoreBundle\Entity\MediaAudio', 'ma', 'WITH', 'ma.id = m.id')
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
            ->leftjoin('Base\CoreBundle\Entity\MediaImage', 'mi', 'WITH', 'mi.id = m.id')
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
            ->leftjoin('Base\CoreBundle\Entity\MediaVideo', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $this->addMasterQueries($qb, 'mi', $festival);
        $this->addTranslationQueries($qb, 'mit', $locale);$qb = $this->addFDCEventQueries($qb, 's');
        $this->addAWSVideoEncodersQueries($qb, 'mit');
        return $qb->setMaxResults(100)
            ->orderBy('mi.publishedAt', 'DESC')
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
            ->leftjoin('Base\CoreBundle\Entity\MediaAudio', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $qb = $this->addMasterQueries($qb, 'mi', $festival);
        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addFDCEventQueries($qb, 's');
        $qb = $qb->setMaxResults(100)
            ->orderBy('mi.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $qb;
    }

}