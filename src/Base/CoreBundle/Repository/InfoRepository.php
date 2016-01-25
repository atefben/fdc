<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use JMS\DiExtraBundle\Annotation as DI;

use Base\CoreBundle\Entity\InfoArticleTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * InfoRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class InfoRepository extends EntityRepository
{
    public function getInfoBySlug($slug, $festival, $locale, $dateTime, $isAdmin)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->leftjoin('na2.translations', 'na2t')
            ->leftjoin('na3.translations', 'na3t')
            ->leftjoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        if ($isAdmin === true) {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.slug = :info_slug) OR
                    (na2t.locale = :locale AND na2t.slug = :info_slug) OR
                    (na3t.locale = :locale AND na3t.slug = :info_slug) OR
                    (na4t.locale = :locale AND na4t.slug = :info_slug)'
                );
        } else {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status AND na1t.slug = :info_slug) OR
                    (na2t.locale = :locale AND na2t.status = :status AND na2t.slug = :info_slug) OR
                    (na3t.locale = :locale AND na3t.status = :status AND na3t.slug = :info_slug) OR
                    (na4t.locale = :locale AND na4t.status = :status AND na4t.slug = :info_slug)'
                )
                ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED);
        }

        $qb = $qb
            ->setParameter('info_slug', $slug)
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getOneOrNullResult();

        return $qb;
    }

    public function getSameDayInfo($festival, $locale, $dateTime, $count, $id)
    {
        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n,
                RAND() as HIDDEN rand')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->leftjoin('na2.translations', 'na2t')
            ->leftjoin('na3.translations', 'na3t')
            ->leftjoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.id != :id')
            ->andWhere('(n.publishedAt >= :datetime) AND (n.publishedAt < :datetime2)');


        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale AND na1t.status = :status) OR
                (na2t.locale = :locale AND na2t.status = :status) OR
                (na3t.locale = :locale AND na3t.status = :status) OR
                (na4t.locale = :locale AND na4t.status = :status)'
            )
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED);


        $qb = $qb
            ->addOrderBy('rand')
            ->setMaxResults($count)
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime1)
            ->setParameter('datetime2', $dateTime2)
            ->setParameter('id', $id)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getResult();

        return $qb;
    }

    public function getInfoArticles($locale, $festival, $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale AND na1t.status = :status)'
            )
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED);

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getResult();

        return $qb;
    }

    /**
     * get an array of only the $locale version Info of current $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getInfos($festival, $dateTime, $locale)
    {
        return $this->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftjoin('na.translations', 'nat')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('nv.translations', 'nvt')
            ->leftjoin('ni.translations', 'nit')
            ->where('n.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
            ->andWhere(
                '(nat.locale = :locale AND nat.status = :status)
                OR (nit.locale = :locale AND nit.status = :status)
                OR (naat.locale = :locale AND naat.status = :status)
                OR (nvt.locale = :locale AND nvt.status = :status)'
            )
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('status', TranslateChildInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'site-evenementiel')
            ->getQuery()
            ->getResult();
    }

    /**
     *  Get the $locale version of Info of current $festival by $id and verify publish date is between $dateTime
     *
     * @param $id
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getInfoById($id, $festival, $dateTime, $locale)
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