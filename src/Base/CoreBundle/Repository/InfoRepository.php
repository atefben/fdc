<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\InfoArticleTranslation;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\Theme;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * InfoRepository class.
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class InfoRepository extends EntityRepository
{
    public function dashboardSearch($params, $locales)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'nai', 'WITH', 'nai.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'nav', 'WITH', 'nav.id = n.id')
            ->leftJoin('naa.translations', 'naat')
            ->leftJoin('na.translations', 'nat')
            ->leftJoin('nai.translations', 'nait')
            ->leftJoin('nav.translations', 'navt')
            ->setParameter('status', $params['status'])
            ->setParameter('locales', $locales)
        ;

        $this->addDashboardTranslatorQueries($qb, ['naat', 'nat', 'nait', 'navt'], $params);

        if (isset($params['id']) && !empty($params['id'])) {
            $qb
                ->andWhere('n.id = :id')
                ->setParameter('id', $params['id'])
            ;
        }

        if (isset($params['priorityStatus']) && !empty($params['priorityStatus']) &&
            $params['priorityStatus'] != 'all'
        ) {
            $qb
                ->andWhere('
                    (na.priorityStatus = :priorityStatus OR
                    naa.priorityStatus = :priorityStatus OR
                    nai.priorityStatus = :priorityStatus OR
                    nav.priorityStatus = :priorityStatus)
                ')
                ->setParameter('priorityStatus', $params['priorityStatus'])
            ;
        }

        if (!empty($params['sortField']) && !empty($params['sortValue'])) {
            $qb->orderBy('n.' . $params['sortField'], $params['sortValue']);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     *  Get the $locale version of Info of current $festival by $id and verify publish date is between $dateTime
     * @param $id
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getApiInfoById($id, $festival, $dateTime, $locale)
    {
        $qb = $this->createQueryBuilder('n')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'nai', 'WITH', 'nai.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'nav', 'WITH', 'nav.id = n.id')
            ->leftJoin('naa.translations', 'naat')
            ->leftJoin('na.translations', 'nat')
            ->leftJoin('nai.translations', 'nait')
            ->leftJoin('nav.translations', 'navt')
            ->where('n.festival = :festival')
            ->andWhere('n.id = :id')
            ->andWhere('n.displayedMobile = :displayed_mobile')
        ;

        $qb = $qb
            ->andWhere('
                (nat.locale = :locale_fr AND nat.status = :status) OR
                (naat.locale = :locale_fr AND naat.status = :status) OR
                (nait.locale = :locale_fr AND nait.status = :status) OR
                (navt.locale = :locale_fr AND navt.status = :status)')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftJoin('naa.translations', 'na5t')
                ->leftJoin('na.translations', 'na6t')
                ->leftJoin('nai.translations', 'na7t')
                ->leftJoin('nav.translations', 'na8t')
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
        return $qb
            ->setParameter('id', $id)
            ->setParameter('festival', $festival)
            ->setParameter('displayed_mobile', true)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @param $locale
     * @param FilmFestival $festival
     * @param \DateTime $dateTime
     * @param \DateTime $limitDate
     * @return Info[]
     */
    public function getNewsApiSameDayInfos($locale, FilmFestival $festival, \DateTime $dateTime, \DateTime $limitDate = null)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n,
                RAND() as HIDDEN rand')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.displayedMobile = :displayed_mobile')
            ->setParameter('displayed_mobile', true)
        ;

        if ($limitDate) {
            $qb
                ->andWhere('n.publishedAt <= :limitDate')
                ->setParameter(':limitDate', $limitDate)
            ;
        }

        if ($festival->getFestivalStartsAt() >= $dateTime) { //before
            $this->addMasterQueries($qb, 'n', $festival, true);
            $qb
                ->andWhere(':festivalStartAt  >= n.publishedAt')
                ->setParameter('festivalStartAt', $festival->getFestivalStartsAt())
            ;
        } else if ($festival->getFestivalEndsAt() <= $dateTime) { //after
            $this->addMasterQueries($qb, 'n', $festival, true);
            $qb
                ->andWhere(':festivalEndAt < n.publishedAt')
                //->setParameter('festivalEndAt', $festival->getFestivalEndsAt())
                ->setParameter('festivalEndAt', '2016-05-23 00:00:00')
            ;;
        } else { //live
            $morning = clone $dateTime;
            $morning->setTime(0, 0, 0);
            $midnight = clone $dateTime;
            $midnight->setTime(23, 59, 59);

            $qb
                ->andWhere('n.festival = :festival')
                ->andWhere('n.publishedAt BETWEEN :morning AND :midnight')
                ->setParameter('morning', $morning)
                ->setParameter('midnight', $midnight)
            ;
            $this->addMasterQueries($qb, 'n', $festival, true);
        }

        $qb
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
            $qb
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

        return $qb
            ->addOrderBy('n.publishedAt', 'desc')
            ->setParameter('festival', $festival->getId())
            ->getQuery()
            ->getResult()
            ;
    }

    public function getInfoBySlug($slug, $festival, $locale, $isAdmin, $repository, $site = 'site-press')
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftJoin($repository, 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
        ;

        // add query for audio / video encoder
        if (strpos($repository, 'InfoAudio') !== false) {
            $qb
                ->leftJoin('na1.audio', 'na1a')
                ->leftJoin('na1a.translations', 'na1at')
            ;
            $this->addTranslationQueries($qb, 'na1at', 'fr', null, 'MediaAudio');
        } else if (strpos($repository, 'InfoVideo') !== false) {
            $qb
                ->leftJoin('na1.video', 'na1v')
                ->leftJoin('na1v.translations', 'na1vt')
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

        $qb
            ->andWhere("s.slug = :site")
            ->setParameter(':site', $site)
        ;

        return $qb
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @param $locale
     * @param $festival
     * @param $dateTime
     * @param null $count
     * @param string $site
     * @param bool $displayedOnCorpoHome
     * @return Info[]
     */
    public function getInfosByDate($locale, $festival, $dateTime, $count = null, $site = 'site-press', $displayedOnCorpoHome = false, Theme $theme = null, $format = null)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere('n.theme is not null')
            ->andWhere('na1.header is not null or na2.header is not null or na3.header is not null or na4.video is not null')
            ->andWhere('s.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
            ->setParameter('datetime', $dateTime)
        ;

        if ($theme) {
            $qb
                ->andWhere('n.theme = :themeId')
                ->setParameter(':themeId', $theme->getId())
            ;
        }

        if ($format) {
            $qb
                ->andWhere('n.typeClone <> :format')
                ->setParameter(':format', $format)
            ;
        }

        if ($festival) {
            $qb
                ->andWhere('n.festival = :festival')
                ->setParameter('festival', $festival)
            ;
        }

        $qb
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
            $qb
                ->leftJoin('na1.translations', 'na5t')
                ->leftJoin('na2.translations', 'na6t')
                ->leftJoin('na3.translations', 'na7t')
                ->leftJoin('na4.translations', 'na8t')
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

        if ($count) {
            $qb->setMaxResults($count);
        }

        if ($displayedOnCorpoHome) {
            $qb
                ->andWhere('n.displayedOnCorpoHome = :displayedOnCorpoHome')
                ->setParameter(':displayedOnCorpoHome', true)
            ;
        }

        return $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getSameDayInfo($festival, $locale, $dateTime, $count, $id, $mobile = null)
    {
        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';
        $now = new \DateTime();

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n,
                RAND() as HIDDEN rand')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.id != :id')
            ->andWhere('n.publishedAt BETWEEN :datetime1 AND :datetime2')
            ->andWhere('n.publishedAt <= :now')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
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

        if ($mobile !== null) {
            $qb
                ->andWhere('n.displayedMobile = :displayedMobile')
                ->setParameter('displayedMobile', $mobile)
            ;
        }

        $qb = $qb
            ->addOrderBy('rand')
            ->setMaxResults($count)
            ->setParameter('festival', $festival)
            ->setParameter('now', $now)
            ->setParameter('datetime1', $dateTime1)
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
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
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
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getInfos($festival, $dateTime, $locale)
    {
        $qb = $this->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftJoin('na.translations', 'nat')
            ->leftJoin('naa.translations', 'naat')
            ->leftJoin('nv.translations', 'nvt')
            ->leftJoin('ni.translations', 'nit')
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
     * @param $locale
     * @param $festival
     * @param $since
     * @param int $maxResults
     * @param $before
     * @return Info[]
     */
    public function getInfoRetrospective($locale, $festival, $since = null, $maxResults = null, $before = null)
    {
        $qb = $this->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftJoin('na.translations', 'nat')
            ->leftJoin('naa.translations', 'naat')
            ->leftJoin('nv.translations', 'nvt')
            ->leftJoin('ni.translations', 'nit')
            ->andWhere(
                '(nat.locale = :locale_fr AND nat.status = :status)
                OR (nit.locale = :locale_fr AND nit.status = :status)
                OR (naat.locale = :locale_fr AND naat.status = :status)
                OR (nvt.locale = :locale_fr AND nvt.status = :status)')
            ->setParameter(':locale_fr', 'fr')
            ->setParameter(':status', TranslateChildInterface::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb
                ->andWhere(
                    '(nat.locale = :locale AND nat.status = :status_translated)
                    OR (nit.locale = :locale AND nit.status = :status_translated)
                    OR (naat.locale = :locale AND naat.status = :status_translated)
                    OR (nvt.locale = :locale AND nvt.status = :status_translated)')
                ->setParameter(':locale', $locale)
                ->setParameter('status_translated', TranslateChildInterface::STATUS_TRANSLATED)
            ;
        }

        $this->addMasterQueries($qb, 'n', $festival, false);
        $this->addFDCCorpoQueries($qb, 's');

        if ($since) {
            $qb
                ->andWhere('n.publishedAt > :since')
                ->setParameter(':since', $since)
            ;
        }

        if ($before) {
            $qb
                ->andWhere('n.publishedAt < :before')
                ->setParameter(':before', $before)
            ;
        }

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * get an array of only the $count last Info of $locale version of current
     * $festival and verify publish date is between $dateTime
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
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftJoin('na.translations', 'nat')
            ->leftJoin('naa.translations', 'naat')
            ->leftJoin('nv.translations', 'nvt')
            ->leftJoin('ni.translations', 'nit')
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
                ->leftJoin('na.translations', 'na5t')
                ->leftJoin('naa.translations', 'na6t')
                ->leftJoin('nv.translations', 'na7t')
                ->leftJoin('ni.translations', 'na8t')
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

    /**
     * get an array of only the $count last Info of $locale version of current
     * $festival and verify publish date is between $dateTime
     * @param $festival
     * @param $dateTime
     * @param $count
     * @param $locale
     * @return Info[]
     */
    public function getApiLastInfos($festival, $dateTime, $locale, $count, \DateTime $limitDate = null)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere('n.displayedMobile= :displayedMobile')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
        ;

        if ($limitDate) {
            $qb
                ->andWhere('n.publishedAt <= :limitDate')
                ->setParameter(':limitDate', $limitDate)
            ;
        }

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status) OR
                    (na2t.locale = :locale_fr AND na2t.status = :status) OR
                    (na3t.locale = :locale_fr AND na3t.status = :status) OR
                    (na4t.locale = :locale_fr AND na4t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', TranslateChildInterface::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftJoin('na1.translations', 'na5t')
                ->leftJoin('na2.translations', 'na6t')
                ->leftJoin('na3.translations', 'na7t')
                ->leftJoin('na4.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale AND na5t.status = :status_translated) OR
                    (na6t.locale = :locale AND na6t.status = :status_translated) OR
                    (na7t.locale = :locale AND na7t.status = :status_translated) OR
                    (na8t.locale = :locale AND na8t.status = :status_translated)'
                )
                ->setParameter('status_translated', TranslateChildInterface::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('displayedMobile', true)
        ;

        $qb = $qb
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    /**
     * @param $locale
     * @param $festival
     * @param $since
     * @param int $page
     * @param int $count
     * @param \DateTime|null $limitDate
     * @return Info[]
     */
    public function getApiInfoHome2017($locale, $festival, $since, $page = 1, $count = 10, \DateTime $limitDate = null)
    {
        $now = new \DateTime();
        $qb = $this->createQueryBuilder('n')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftJoin('na.translations', 'nat')
            ->leftJoin('naa.translations', 'naat')
            ->leftJoin('nv.translations', 'nvt')
            ->leftJoin('ni.translations', 'nit')
            ->andWhere('n.displayedMobile = :displayedMobile')
            ->setParameter('displayedMobile', true)
            ->andWhere('n.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('n.publishedAt >= :since and (n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
            ->setParameter('since', $since)
            ->setParameter('now', $now)
            ->andWhere(
                '(nat.locale = :locale_fr AND nat.status = :status)
                OR (nit.locale = :locale_fr AND nit.status = :status)
                OR (naat.locale = :locale_fr AND naat.status = :status)
                OR (nvt.locale = :locale_fr AND nvt.status = :status)')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', InfoArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($limitDate) {
            $qb
                ->andWhere('n.publishedAt >= :limitDate')
                ->setParameter(':limitDate', $limitDate)
            ;
        }

        if ($locale != 'fr') {
            $qb
                ->leftJoin('na.translations', 'na5t')
                ->leftJoin('naa.translations', 'na6t')
                ->leftJoin('nv.translations', 'na7t')
                ->leftJoin('ni.translations', 'na8t')
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

        if (null !== $page && null !== $count) {
            $qb
                ->setMaxResults($count)
                ->setFirstResult(($page - 1) * $count)
            ;
        }

        return $qb
            ->addOrderBy('n.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;

    }

    public function getOlderInfo($locale, $festival, $date, $site = 'site-press', $exclude)
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.publishedAt <= :date')
        ;

        if ($exclude) {
            $qb
                ->andWhere('n.id <> :nid')
                ->setParameter(':nid', $exclude)
            ;
        }

        $qb
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
            $qb
                ->leftJoin('na1.translations', 'na5t')
                ->leftJoin('na2.translations', 'na6t')
                ->leftJoin('na3.translations', 'na7t')
                ->leftJoin('na4.translations', 'na8t')
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

        if ($festival) {
            $qb
                ->andWhere('n.festival = :festival')
                ->setParameter('festival', $festival)
            ;
        }

        return $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setMaxResults('1')
            ->setParameter('date', $date)
            ->setParameter('site_slug', $site)
            ->getQuery()
            ->getResult()
            ;

    }

    public function getNextInfo($locale, $festival, $date, $site = 'site-press', $exclude = null)
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('n.publishedAt >= :date')
            ->setParameter('date', $date)
        ;

        if ($exclude) {
            $qb
                ->andWhere('n.id <> :nid')
                ->setParameter(':nid', $exclude)
            ;
        }

        $qb
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
            $qb
                ->leftJoin('na1.translations', 'na5t')
                ->leftJoin('na2.translations', 'na6t')
                ->leftJoin('na3.translations', 'na7t')
                ->leftJoin('na4.translations', 'na8t')
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

        if ($festival) {
            $qb
                ->andWhere('n.festival = :festival')
                ->setParameter('festival', $festival)
            ;
        }

        $qb
            ->orderBy('n.publishedAt', 'ASC')
            ->setMaxResults('1')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getAllInfo($locale, $festival)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\InfoArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\InfoVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
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
                ->leftJoin('na1.translations', 'na5t')
                ->leftJoin('na2.translations', 'na6t')
                ->leftJoin('na3.translations', 'na7t')
                ->leftJoin('na4.translations', 'na8t')
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