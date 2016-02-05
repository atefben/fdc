<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\WebTv;
use Base\CoreBundle\Entity\WebTvTranslationInterface;

use Doctrine\ORM\EntityRepository;

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
            ->setParameter('festival', $festival)
            ->setParameter('inWebTv', true)
            ->setParameter('locale', $locale)
            ->setParameter('status', WebTvTranslationInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery();
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
        $qb->join('wt.translations', 'wtt')
            ->where('wtt.slug = :slug')
            ->setParameter('slug', $slug)
            ->andWhere('wtt.locale = :locale')
            ->setParameter('locale', $locale)
            ->andWhere('wt.festival = :festival')
            ->setParameter('festival', $festival);
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

        $qb->join('wt.translations', 'wtt')
            ->where('wt.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('wtt.locale = :locale')
            ->setParameter('locale', $locale)
            ->andWhere('wtt.status in (1, 5)')
            ->andWhere('SIZE(wt.mediaVideos) >= 1')
        ;

        return $qb->getQuery()->getResult();
    }
}