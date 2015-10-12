<?php

namespace Base\CoreBundle\Repository;

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
     * get an array of WebTvs of current $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @return mixed
     */
    public function getApiWebTvs($festival, $dateTime)
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
            ->setParameter('locale', 'fr')
            ->setParameter('status', WebTvTranslationInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery();
    }

    /**
     * Get a webTv by $id and verify publish date is between $dateTime
     * @param $id
     * @param $dateTime
     * @return mixed
     */
    public function getApiWebTv($id, $dateTime)
    {
        return $this->createQueryBuilder('wt')
            ->join('wt.mediaVideos', 'mv')
            ->join('mv.sites', 's')
            ->join('wt.translations', 'wtt')
            ->join('mv.translations', 'mvt')
            ->where('s.slug = :site')
            ->andWhere('mv.inWebTv = :inWebTv')
            ->andWhere('mvt.locale = :locale')
            ->andWhere('mvt.status = :status')
            ->andWhere('wtt.locale = :locale')
            ->andWhere('wtt.status = :status')
            ->andWhere('(mv.publishedAt IS NULL OR mv.publishedAt <= :datetime)')
            ->andWhere('(mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :datetime)')
            ->andWhere('mv.id = :id')
            ->setParameter('id', $id)
            ->setParameter('inWebTv', true)
            ->setParameter('locale', 'fr')
            ->setParameter('status', WebTvTranslationInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery()
            ->getOneOrNullResult();
    }
}