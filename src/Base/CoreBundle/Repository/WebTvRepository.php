<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\WebTv;
use Base\CoreBundle\Entity\WebTvTranslation;


/**
 * WebTvRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class WebTvRepository extends EntityRepository
{

    /**
     * get an array of only the $locale version WebTvs of current $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getApiWebTvs($festival, $dateTime, $locale)
    {
        $qb = $this->createQueryBuilder('wt')
            ->join('wt.mediaVideos', 'mv')
            ->join('wt.translations', 'wtt')
            ->join('mv.translations', 'mvt')
            ->where('mv.displayedWebTv = :displayedWebTv');

        $qb = $this->addMasterQueries($qb, 'mv', $festival);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);

        $qb = $qb->andWhere('mv.displayedMobile = :displayed_mobile')
            ->setParameter('displayedWebTv', true)
            ->setParameter('displayed_mobile', true)
            ->getQuery()
        ;

        return $qb;
    }

    /**
     *  Get the $locale version of webTv by $id and verify publish date is between $dateTime
     *
     * @param $id
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getApiWebTv($id, $festival, $dateTime, $locale)
    {
        $qb = $this->createQueryBuilder('wt')
            ->join('wt.mediaVideos', 'mv')
            ->join('wt.translations', 'wtt')
            ->join('mv.translations', 'mvt')
            ->where('mv.displayedWebTv = :displayedWebTv');

        $qb = $this->addMasterQueries($qb, 'mv', $festival);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);

        $qb = $qb->andWhere('mv.displayedMobile = :displayed_mobile')
            ->andWhere('mv.id = :id')
            ->setParameter('id', $id)
            ->setParameter('displayedWebTv', true)
            ->setParameter('displayed_mobile', true)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return $qb;
    }

    /**
     * @param $slug
     * @param $locale
     * @param $festival
     * @return WebTv
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getWebTvBySlug($slug, $locale, $festival)
    {
        $qb = $this->createQueryBuilder('wt');
        $qb = $qb->join('wt.translations', 'wtt')
            ->where('wtt.slug = :slug')
            ->setParameter('slug', $slug);

        $qb = $this->addTranslationQueries($qb, 'wtt', $locale);
        $qb = $qb
            ->andWhere('wt.festival = :festival')
            ->setParameter('festival', $festival)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $locale
     * @param $festival
     * @return array
     */
    public function getWebTvByLocale($locale, $festival)
    {
        $qb = $this->createQueryBuilder('wt');

        $qb = $qb->join('wt.translations', 'wtt')
            ->join('wt.mediaVideos', 'mv')
            ->join('mv.translations', 'mvt')
            ->where('wt.festival = :festival')
            ->setParameter('festival', $festival);

        $qb = $this->addTranslationQueries($qb, 'wtt', $locale);
        $qb = $qb->andWhere('SIZE(wt.mediaVideos) >= 1');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $locale
     * @param $festival
     * @param array $excludes
     * @param int $limit
     * @return array
     */
    public function getRandomWebTvs($locale, $festival, $excludes = array(), $limit = 10)
    {
        $qb = $this->createQueryBuilder('wt');

        $qb = $qb->select('wt,
                RAND() as HIDDEN rand')
            ->join('wt.translations', 'wtt')
            ->join('wt.mediaVideos', 'mv')
            ->join('mv.translations', 'mvt')
            ->where('wt.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('SIZE(wt.mediaVideos) >= 1')
        ;

        if ($excludes) {
            $qb = $qb
                ->andWhere('wt.id NOT IN (:excludes)')
                ->setParameter(':excludes', $excludes)
            ;
        }

        $qb = $this->addTranslationQueries($qb, 'wtt', $locale);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);

        $qb = $qb
            ->orderBy('rand')
            ->setMaxResults((int)$limit)
        ;


        return $qb->getQuery()->getResult();
    }
}