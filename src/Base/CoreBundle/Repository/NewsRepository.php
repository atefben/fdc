<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\NewsTranslationInterface;

use Doctrine\ORM\EntityRepository;

/**
 * NewsRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class NewsRepository extends EntityRepository
{

    /**
     * get an array of only the $locale version News of current $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getNews($festival, $dateTime, $locale, $count)
    {
        return $this->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\NewsArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('na.translations', 'nat')
            ->where('n.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
            ->andWhere(
                '(nat.locale = :locale AND nat.status = :status) OR
                (naat.locale = :locale AND naat.status = :status)'
            )
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('status', NewsTranslationInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery()
            ->setHint('knp_paginator.count', (int)$count);
    }

    public function getNewsCount($festival, $dateTime, $locale)
    {
        return $this->createQueryBuilder('n')
            ->select('COUNT(n)')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\NewsArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('na.translations', 'nat')
            ->where('n.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
            ->andWhere(
            '(nat.locale = :locale AND nat.status = :status) OR
                            (naat.locale = :locale AND naat.status = :status)'
            )
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('status', NewsTranslationInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery()
            ->getSingleScalarResult();
    }


    /**
     *  Get the $locale version of News of current $festival by $id and verify publish date is between $dateTime
     *
     * @param $id
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getNewsById($id, $festival, $dateTime, $locale)
    {
        return $this->createQueryBuilder('wt')
            ->join('wt.mediaVideos', 'mv')
            ->join('mv.sites', 's')
            ->join('wt.translations', 'wtt')
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('mv.inWebTv = :inWebTv')
            ->andWhere('mvt.locale = :locale')
            ->andWhere('mvt.status = :status')
            ->andWhere('wtt.locale = :locale')
            ->andWhere('wtt.status = :status')
            ->andWhere('(mv.publishedAt IS NULL OR mv.publishedAt <= :datetime)')
            ->andWhere('(mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :datetime)')
            ->andWhere('mv.id = :id')
            ->setParameter('festival', $festival)
            ->setParameter('id', $id)
            ->setParameter('inWebTv', true)
            ->setParameter('locale', $locale)
            ->setParameter('status', WebTvTranslationInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery()
            ->getOneOrNullResult();
    }
}