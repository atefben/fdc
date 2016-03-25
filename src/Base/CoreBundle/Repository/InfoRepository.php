<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use JMS\DiExtraBundle\Annotation as DI;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Entity\InfoArticleTranslation;

/**
 * InfoRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class InfoRepository extends EntityRepository
{


    public function getInfoBySlug($slug, $festival, $locale, $isAdmin, $repository)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin($repository, 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
        ;

        // add query for audio / video encoder
        if (strpos($repository, 'InfoAudio') !== false) {
            $qb
                ->leftjoin('na1.audio', 'na1a')
                ->leftjoin('na1a.translations', 'na1at')
            ;
            $this->addTranslationQueries($qb, 'na1at', 'fr', null, 'MediaAudio');
        } else if (strpos($repository, 'InfoVideo') !== false) {
            $qb
                ->leftjoin('na1.video', 'na1v')
                ->leftjoin('na1v.translations', 'na1vt')
            ;
            $this->addTranslationQueries($qb, 'na1vt', 'fr', null, 'MediaVideo');
        }

        if ($isAdmin === true) {
            $qb
                ->andWhere('(na1t.locale = :locale AND na1t.slug = :slug)')
                ->setParameter('locale', $locale)
                ->setParameter('slug', $slug)
            ;
        } else {
            $this->addMasterQueries($qb, 'na1', $festival);
            $this->addTranslationQueries($qb, 'na1t', $locale, $slug);
        }

        $this->addFDCPressQueries($qb, 's');

        return $qb
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getInfosByDate($locale, $festival, $dateTime, $count)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
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
            ->andWhere('n.displayedHome = 1')
            ->andWhere('(n.publishedAt < :datetime)')
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status) OR
                    (na2t.locale = :locale_fr AND na2t.status = :status) OR
                    (na3t.locale = :locale_fr AND na3t.status = :status) OR
                    (na4t.locale = :locale_fr AND na4t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftjoin('na1.translations', 'na5t')
                ->leftjoin('na2.translations', 'na6t')
                ->leftjoin('na3.translations', 'na7t')
                ->leftjoin('na4.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale AND na5t.status = :status_translated) OR
                    (na6t.locale = :locale AND na6t.status = :status_translated) OR
                    (na7t.locale = :locale AND na7t.status = :status_translated) OR
                    (na8t.locale = :locale AND na8t.status = :status_translated)'
                )
                ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
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
            ->andWhere('(n.publishedAt >= :datetime) AND (n.publishedAt < :datetime2)')
        ;


        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status) OR
                    (na2t.locale = :locale_fr AND na2t.status = :status) OR
                    (na3t.locale = :locale_fr AND na3t.status = :status) OR
                    (na4t.locale = :locale_fr AND na4t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_translated) OR
                    (na2t.locale = :locale AND na2t.status = :status_translated) OR
                    (na3t.locale = :locale AND na3t.status = :status_translated) OR
                    (na4t.locale = :locale AND na4t.status = :status_translated)'
                )
                ->setParameter('status_translated', InfoArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $qb
            ->addOrderBy('rand')
            ->setMaxResults($count)
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime1)
            ->setParameter('datetime2', $dateTime2)
            ->setParameter('id', $id)
            ->setParameter('site_slug', 'site-press')
            ->getQuery()
            ->getResult()
        ;

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
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_translated)'
                )
                ->setParameter('status_translated', InfoArticleTranslation::STATUS_PUBLISHED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $this->addMasterQueries($qb, 'n', $festival);
        $qb = $qb
            ->setParameter('site_slug', 'site-press')
            ->getQuery()
            ->getResult()
        ;

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
        $qb = $this->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftjoin('na.translations', 'nat')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('nv.translations', 'nvt')
            ->leftjoin('ni.translations', 'nit')
            ->andWhere('s.slug = :site')
        ;

        $qb = $qb
            ->andWhere(
                '(nat.locale = :locale_fr AND nat.status = :status)
                OR (nit.locale = :locale_fr AND nit.status = :status)
                OR (naat.locale = :locale_fr AND naat.status = :status)
                OR (nvt.locale = :locale_fr AND nvt.status = :status)')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(nat.locale = :locale AND nat.status = :status_translated)
                    OR (nit.locale = :locale AND nit.status = :status_translated)
                    OR (naat.locale = :locale AND naat.status = :status_translated)
                    OR (nvt.locale = :locale AND nvt.status = :status_translated)')
                ->setParameter('status_translated', InfoArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $this->addMasterQueries($qb, 'n', $festival);
        $qb = $qb
            ->setParameter('site', 'site-press')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    /**
     * get an array of only the $count last Info of $locale version of current
     * $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @param $count
     * @param $locale
     * @return mixed
     */
    public function getLastInfos($festival, $dateTime, $locale, $count)
    {
        $qb = $this->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftjoin('na.translations', 'nat')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('nv.translations', 'nvt')
            ->leftjoin('ni.translations', 'nit')
            ->where('s.slug = :site')
        ;

        $qb = $qb
            ->andWhere(
                '(nat.locale = :locale_fr AND nat.status = :status)
                OR (nit.locale = :locale_fr AND nit.status = :status)
                OR (naat.locale = :locale_fr AND naat.status = :status)
                OR (nvt.locale = :locale_fr AND nvt.status = :status)')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {

            $qb = $qb
                ->leftjoin('na.translations', 'na5t')
                ->leftjoin('naa.translations', 'na6t')
                ->leftjoin('nv.translations', 'na7t')
                ->leftjoin('ni.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale AND na5t.status = :status_translated) OR
                    (na6t.locale = :locale AND na6t.status = :status_translated) OR
                    (na7t.locale = :locale AND na7t.status = :status_translated) OR
                    (na8t.locale = :locale AND na8t.status = :status_translated)'
                )
                ->setParameter('status_translated', InfoArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }
        $qb = $this->addMasterQueries($qb, 'n', $festival);
        $qb = $qb
            ->addOrderBy('n.publishedAt', 'DESC')
            ->setMaxResults($count)
            ->setParameter('site', 'site-press')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getOlderInfo($locale, $festival, $date)
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
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
            ->andWhere('n.publishedAt < :date')
            ->andWhere('n.festival = :festival')
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status) OR
                    (na2t.locale = :locale_fr AND na2t.status = :status) OR
                    (na3t.locale = :locale_fr AND na3t.status = :status) OR
                    (na4t.locale = :locale_fr AND na4t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftjoin('na1.translations', 'na5t')
                ->leftjoin('na2.translations', 'na6t')
                ->leftjoin('na3.translations', 'na7t')
                ->leftjoin('na4.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale AND na5t.status = :status_translated) OR
                    (na6t.locale = :locale AND na6t.status = :status_translated) OR
                    (na7t.locale = :locale AND na7t.status = :status_translated) OR
                    (na8t.locale = :locale AND na8t.status = :status_translated)'
                )
                ->setParameter('status_translated', InfoArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setMaxResults('1')
            ->setParameter('date', $date)
            ->setParameter('festival', $festival)
            ->setParameter('site_slug', 'site-press')
        ;

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getNextInfo($locale, $festival, $date)
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
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
            ->andWhere('n.publishedAt > :date')
            ->andWhere('n.festival = :festival')
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status) OR
                    (na2t.locale = :locale_fr AND na2t.status = :status) OR
                    (na3t.locale = :locale_fr AND na3t.status = :status) OR
                    (na4t.locale = :locale_fr AND na4t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftjoin('na1.translations', 'na5t')
                ->leftjoin('na2.translations', 'na6t')
                ->leftjoin('na3.translations', 'na7t')
                ->leftjoin('na4.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale AND na5t.status = :status_translated) OR
                    (na6t.locale = :locale AND na6t.status = :status_translated) OR
                    (na7t.locale = :locale AND na7t.status = :status_translated) OR
                    (na8t.locale = :locale AND na8t.status = :status_translated)'
                )
                ->setParameter('status_translated', InfoArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $qb
            ->orderBy('n.publishedAt', 'ASC')
            ->setMaxResults('1')
            ->setParameter('date', $date)
            ->setParameter('festival', $festival)
            ->setParameter('site_slug', 'site-press')
        ;

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getAllInfo($locale, $festival)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
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
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status) OR
                    (na2t.locale = :locale_fr AND na2t.status = :status) OR
                    (na3t.locale = :locale_fr AND na3t.status = :status) OR
                    (na4t.locale = :locale_fr AND na4t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        $qb = $qb
            ->andWhere('n.publishedAt <= :today')
            ->setParameter('today', date("Y-m-d H:i:s"))
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftjoin('na1.translations', 'na5t')
                ->leftjoin('na2.translations', 'na6t')
                ->leftjoin('na3.translations', 'na7t')
                ->leftjoin('na4.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale AND na5t.status = :status_translated) OR
                    (na6t.locale = :locale AND na6t.status = :status_translated) OR
                    (na7t.locale = :locale AND na7t.status = :status_translated) OR
                    (na8t.locale = :locale AND na8t.status = :status_translated)'
                )
                ->setParameter('status_translated', InfoArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setParameter('festival', $festival)
            ->setParameter('site_slug', 'site-press')
        ;

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }
}