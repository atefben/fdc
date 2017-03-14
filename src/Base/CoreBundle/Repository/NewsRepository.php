<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use DateTime;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * NewsRepository class.
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class NewsRepository extends EntityRepository
{
    public function dashboardSearch($params, $locales)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->setParameter('status', $params['status'])
            ->setParameter('locales', $locales)
        ;

        $this->addDashboardTranslatorQueries($qb, array('na1t', 'na2t', 'na3t', 'na4t'), $params);

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
                    (na1.priorityStatus = :priorityStatus OR
                    na2.priorityStatus = :priorityStatus OR
                    na3.priorityStatus = :priorityStatus OR
                    na4.priorityStatus = :priorityStatus)
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
     * @param $locale
     * @param $festival
     * @param $dateTime
     * @return array
     */
    public function getNewsApiSameDayNews($locale, FilmFestival $festival, \DateTime $dateTime)
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.displayedMobile = :displayed_mobile')
            ->setParameter('displayed_mobile', true)
        ;

        $festivalEndsAt = new \DateTime('2016-05-23 00:00:00');

        if ($festival->getFestivalStartsAt() >= $dateTime) {
            $this->addMasterQueries($qb, 'n', $festival, true);
            $qb
                ->andWhere(':festivalStartAt  >= n.publishedAt')
                ->setParameter('festivalStartAt', $festival->getFestivalStartsAt())
            ;
        } else if ($festivalEndsAt < $dateTime) {
            $this->addMasterQueries($qb, 'n', $festival, true);
            $qb
                ->andWhere(':festivalEndAt < n.publishedAt')
                //->setParameter('festivalEndAt', $festival->getFestivalEndsAt())
                ->setParameter('festivalEndAt', $festivalEndsAt->format('Y-m-d H:i:s'))
            ;;
        } else {
            $morning = clone $dateTime;
            $morning->setTime(0, 0, 0);
            $midnight = clone $dateTime;
            $midnight->setTime(23, 59, 59);

            $qb
                ->andWhere('n.publishedAt BETWEEN :morning AND :midnight')
                ->setParameter('morning', $morning)
                ->setParameter('midnight', $midnight)
            ;
            $this->addMasterQueries($qb, 'n', $festival, true);
        }

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
        $qb = $qb
            ->orderBy('n.publishedAt', 'desc')
            ->setParameter('festival', $festival->getId())
            ->getQuery()
            ->getResult()
        ;
        return $qb;
    }

    public function getApiLastsNews($locale, $festival, $dateTime, $count)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere('n.displayedMobile= :displayedMobile')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
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
     * @return News[]
     */
    public function getApiNewsHome2017($locale, $festival, $since, $page = 1, $count = 10)
    {
        $now = new DateTime();
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere('n.displayedMobile= :displayedMobile')
            ->setParameter('displayedMobile', true)
            ->andWhere('n.festival = :festival')
            ->setParameter('festival', $festival)
            ->andWhere('n.publishedAt >= :since and (n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
            ->setParameter('since', $since)
            ->setParameter('now', $now)
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

    /**
     * @param $slug
     * @param $festival
     * @param $locale
     * @param $isAdmin
     * @param $repository
     * @param string $site
     * @return News
     */
    public function getNewsBySlug($slug, $festival, $locale, $isAdmin, $repository, $site = 'site-evenementiel')
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftJoin($repository, 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->andWhere('s.slug = :site')
            ->setParameter(':site', $site)
        ;

        // add query for audio / video encoder
        if (strpos($repository, 'NewsAudio') !== false) {
            $qb
                ->leftJoin('na1.audio', 'na1a')
                ->leftJoin('na1a.translations', 'na1at')
            ;
            $this->addTranslationQueries($qb, 'na1at', 'fr', null, 'MediaAudio');
        } else if (strpos($repository, 'NewsVideo') !== false) {
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

        return $qb
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getSameDayNews($festival, $locale, $dateTime, $count, $id, $mobile = null, $focusArticles = null)
    {
        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';
        $now = new \DateTime();

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n,
                RAND() as HIDDEN rand')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
        ;
        $qb
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.id != :id')
            ->andWhere('n.publishedAt BETWEEN :datetime1 AND :datetime2')
            ->andWhere('n.publishedAt <= :now')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
        ;

        if ($locale != 'fr') {
            $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_translated) OR
                    (na2t.locale = :locale AND na2t.status = :status_translated) OR
                    (na3t.locale = :locale AND na3t.status = :status_translated) OR
                    (na4t.locale = :locale AND na4t.status = :status_translated)'
                )
                ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        } else {
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
        }

        $qb
            ->addOrderBy('rand')
            ->setParameter('festival', $festival)
            ->setParameter('now', $now)
            ->setParameter('datetime1', $dateTime1)
            ->setParameter('datetime2', $dateTime2)
            ->setParameter('id', $id)
            ->setParameter('site_slug', 'site-evenementiel')
        ;

        if ($mobile !== null) {
            $qb
                ->andWhere('n.displayedMobile = :displayedMobile')
                ->setParameter('displayedMobile', $mobile)
            ;
        }

        if ($focusArticles !== null) {
            $id1 = (isset($focusArticles[0])) ? $focusArticles[0] : null;
            $id2 = (isset($focusArticles[1])) ? $focusArticles[1] : null;;

            if ($id1) {
                $qb
                    ->andWhere('n.id <> :id1')
                    ->setParameter('id1', $id1->getId())
                ;
            }
            if ($id2) {
                $qb
                    ->andWhere('n.id <> :id2')
                    ->setParameter('id2', $id2->getId())
                ;
            }
        }

        if ($count) {
            $qb->setMaxResults($count);
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getNewsByDate($locale, $festival, $dateTime, $count)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.displayedHome = 1')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
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
                ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        } else {
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
        }

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
        ;

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getAllNews($locale, $festival)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
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

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setParameter('site_slug', 'site-evenementiel')
        ;

        $this->addMasterQueries($qb, 'n', $festival, true);

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getOlderNewsButSameDay($locale, $festival, $dateTime, $count)
    {

        $dateTimeMax = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.displayedHome = 1')
            ->andWhere('(n.publishedAt >= :datetime_max) AND (n.publishedAt < :datetime)')
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

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('datetime_max', $dateTimeMax)
            ->setParameter('site_slug', 'site-evenementiel')
        ;

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getOlderNews($locale, $festival, $date, $site = 'site-evenementiel')
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.publishedAt < :date')
        ;

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

        if ($festival) {
            $qb
                ->andWhere('n.festival = :festival')
                ->setParameter('festival', $festival)
            ;
        }

        $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setMaxResults('1')
            ->setParameter('date', $date)
            ->setParameter('site_slug', $site)
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;

    }

    public function getNextNews($locale, $festival, $date, $site = 'site-evenementiel')
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.publishedAt > :date')
        ;

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


        if ($festival) {
            $qb
                ->andWhere('n.festival = :festival')
                ->setParameter('festival', $festival)
            ;
        }
        $qb
            ->orderBy('n.publishedAt', 'ASC')
            ->setMaxResults('1')
            ->setParameter('date', $date)
            ->setParameter('site_slug', $site)
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    public function getLastsNews($locale, $festival, $dateTime, $count)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
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

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
        ;

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getNewsArticles($locale, $festival, $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NOT NULL AND n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftJoin('na1.translations', 'na2t')
                ->andWhere(
                    '(na2t.locale = :locale AND na2t.status = :status_translated)'
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
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getNewsPhotos($locale, $festival, $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NOT NULL AND n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftJoin('na1.translations', 'na2t')
                ->andWhere(
                    '(na2t.locale = :locale AND na2t.status = :status_translated)'
                )
                ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getNewsVideos($locale, $festival, $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NOT NULL AND n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftJoin('na1.translations', 'na2t')
                ->andWhere(
                    '(na2t.locale = :locale AND na2t.status = :status_translated)'
                )
                ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        // add query for video encoder
        $qb
            ->leftJoin('na1.video', 'na1v')
            ->leftJoin('na1v.translations', 'na1vt')
        ;
        $this->addTranslationQueries($qb, 'na1vt', 'fr', null, 'MediaVideo');


        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
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
     * @param int $before
     * @return News[]
     */
    public function getNewsRetrospective($locale, $festival, $since = null, $maxResults = null, $before = null)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->innerJoin('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status) OR
                    (na2t.locale = :locale_fr AND na2t.status = :status) OR
                    (na3t.locale = :locale_fr AND na3t.status = :status) OR
                    (na4t.locale = :locale_fr AND na4t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter(':status', TranslateChildInterface::STATUS_PUBLISHED)
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
                ->setParameter(':locale', $locale)
                ->setParameter(':status_translated', TranslateChildInterface::STATUS_TRANSLATED)
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
            ->addOrderBy('n.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getNewsAudios($locale, $festival, $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NOT NULL AND n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
        ;

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale_fr AND na1t.status = :status)'
            )
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftJoin('na1.translations', 'na2t')
                ->andWhere(
                    '(na2t.locale = :locale AND na2t.status = :status_translated)'
                )
                ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        // add query for audio encoder
        $qb
            ->leftJoin('na1.audio', 'na1a')
            ->leftJoin('na1a.translations', 'na1at')
        ;
        $this->addTranslationQueries($qb, 'na1at', 'fr', null, 'MediaAudio');

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    /**
     * @param $festival
     * @param $locale
     * @param \DateTime $start
     * @param \DateTime $end
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getApiNews($festival, $locale, $start, $end)
    {
        $qb = $this->createQueryBuilder('n')
                   ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na', 'WITH', 'na.id = n.id')
                   ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'naa', 'WITH', 'naa.id = n.id')
                   ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'nai', 'WITH', 'nai.id = n.id')
                   ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'nav', 'WITH', 'nav.id = n.id')
                   ->leftJoin('naa.translations', 'naat')
                   ->leftJoin('na.translations', 'nat')
                   ->leftJoin('nai.translations', 'nait')
                   ->leftJoin('nav.translations', 'navt')
                   ->where('n.festival = :festival')
                   ->andWhere('n.displayedMobile = :displayed_mobile')
        ;

        $now = new \DateTime();
        if ($now >= $start && $now <= $end) {
            $qb
                ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
                ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
                ->setParameter('datetime', $now)
            ;
        } elseif ($now < $start) {
            $qb
                ->andWhere('(n.publishedAt < :datetime)')
                ->setParameter('datetime', $start)
            ;
        } elseif ($now > $end) {
            $qb
                ->andWhere('(n.publishedAt > :datetime)')
                ->setParameter('datetime', $end)
            ;
        }

        $qb = $qb
            ->andWhere('
                (nat.locale = :locale_fr AND nat.status = :status) OR
                (naat.locale = :locale_fr AND naat.status = :status) OR
                (nait.locale = :locale_fr AND nait.status = :status) OR
                (navt.locale = :locale_fr AND navt.status = :status)')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
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
                ->setParameter('locale', $locale)
                ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
            ;
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('displayed_mobile', true)
            ->orderBy('n.publishedAt', 'desc')
            ->getQuery()
        ;

        return $qb;
    }

    /**
     *  Get the $locale version of News of current $festival by $id and verify publish date is between $dateTime
     * @param $id
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getApiNewsById($id, $festival, $dateTime, $locale)
    {
        $qb = $this->createQueryBuilder('n')
                   ->leftJoin('Base\CoreBundle\Entity\NewsArticle', 'na', 'WITH', 'na.id = n.id')
                   ->leftJoin('Base\CoreBundle\Entity\NewsAudio', 'naa', 'WITH', 'naa.id = n.id')
                   ->leftJoin('Base\CoreBundle\Entity\NewsImage', 'nai', 'WITH', 'nai.id = n.id')
                   ->leftJoin('Base\CoreBundle\Entity\NewsVideo', 'nav', 'WITH', 'nav.id = n.id')
                   ->leftJoin('naa.translations', 'naat')
                   ->leftJoin('na.translations', 'nat')
                   ->leftJoin('nai.translations', 'nait')
                   ->leftJoin('nav.translations', 'navt')
                   ->where('n.festival = :festival')
                   ->andWhere('n.id = :id')
                   ->andWhere('n.displayedMobile = :displayed_mobile')
        ;

        $qb
            ->andWhere('
                (nat.locale = :locale_fr AND nat.status = :status) OR
                (naat.locale = :locale_fr AND naat.status = :status) OR
                (nait.locale = :locale_fr AND nait.status = :status) OR
                (navt.locale = :locale_fr AND navt.status = :status)')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb
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
                ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }
        $news = $qb
            ->setParameter('id', $id)
            ->setParameter('festival', $festival)
            ->setParameter('displayed_mobile', true)
            ->getQuery()
            ->getOneOrNullResult()
        ;
        return $news;

    }
}