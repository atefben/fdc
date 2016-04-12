<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use JMS\DiExtraBundle\Annotation as DI;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Entity\StatementArticleTranslation;

/**
 * StatementRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class StatementRepository extends EntityRepository
{

    public function dashboardSearch($params, $locales)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->leftJoin('Base\CoreBundle\Entity\StatementArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\StatementAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\StatementImage', 'nai', 'WITH', 'nai.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\StatementVideo', 'nav', 'WITH', 'nav.id = n.id')
            ->leftJoin('naa.translations', 'naat')
            ->leftJoin('na.translations', 'nat')
            ->leftJoin('nai.translations', 'nait')
            ->leftJoin('nav.translations', 'navt')
            ->setParameter('status', $params['status'])
            ->setParameter('locales', $locales)
        ;

        $this->addDashboardTranslatorQueries($qb, array('naat', 'nat', 'nait', 'navt'), $params);

        if (isset($params['id']) && !empty($params['id'])) {
            $qb
                ->andWhere('n.id = :id')
                ->setParameter('id', $params['id'])
            ;
        }

        if (isset($params['priorityStatus']) && !empty($params['priorityStatus']) &&
            $params['priorityStatus'] != 'all') {
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

        return $qb->getQuery()->getResult();
    }

    /**
     *  Get the $locale version of Statement of current $festival by $id and verify publish date is between $dateTime
     *
     * @param $id
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getApiStatementById($id, $festival, $dateTime, $locale)
    {
        $qb = $this->createQueryBuilder('n')
            ->leftJoin('Base\CoreBundle\Entity\StatementArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\StatementAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\StatementImage', 'nai', 'WITH', 'nai.id = n.id')
            ->leftJoin('Base\CoreBundle\Entity\StatementVideo', 'nav', 'WITH', 'nav.id = n.id')
            ->leftJoin('naa.translations', 'naat')
            ->leftJoin('na.translations', 'nat')
            ->leftJoin('nai.translations', 'nait')
            ->leftJoin('nav.translations', 'navt')
            ->where('n.festival = :festival')
            ->andWhere('n.id = :id')
            ->andWhere('n.displayedMobile = :displayed_mobile')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
        ;

        $qb = $qb
            ->andWhere('
                (nat.locale = :locale_fr AND nat.status = :status) OR
                (naat.locale = :locale_fr AND naat.status = :status) OR
                (nait.locale = :locale_fr AND nait.status = :status) OR
                (navt.locale = :locale_fr AND navt.status = :status)')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED)
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
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }
        return $qb
            ->setParameter('id', $id)
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('displayed_mobile', true)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getNewsApiSameDayStatements($locale, FilmFestival $festival, \DateTime $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n,
                RAND() as HIDDEN rand')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->leftjoin('na2.translations', 'na2t')
            ->leftjoin('na3.translations', 'na3t')
            ->leftjoin('na4.translations', 'na4t')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.displayedMobile = :displayed_mobile')
            ->setParameter('displayed_mobile', true)
        ;

        if ($festival->getFestivalStartsAt() > $dateTime || $festival->getFestivalEndsAt() < $dateTime) {
            $this->addMasterQueries($qb, 'n', $festival, true);
        } else {
            $morning = clone $dateTime;
            $morning->setTime(0, 0, 0);
            $midnight = clone $dateTime;
            $midnight->setTime(23, 59, 59);

            $qb
                ->andWhere('n.festival = :festival')
                ->andWhere('n.publishedAt BETWEEN :morning AND :midnight')
                ->andWhere('n.publishedAt <= :datetime')
                ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
                ->setParameter('datetime', $dateTime)
                ->setParameter('morning', $morning)
                ->setParameter('midnight', $midnight)
            ;
        }


        $qb = $qb
            ->andWhere(
                "(na1t.locale = 'fr' AND na1t.status = :status) OR
                (na2t.locale = 'fr' AND na2t.status = :status) OR
                (na3t.locale = 'fr' AND na3t.status = :status) OR
                (na4t.locale = 'fr' AND na4t.status = :status)"
            )
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED)
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
                ->setParameter('locale', $locale)
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
            ;
        }


        $qb = $qb
            ->addOrderBy('n.publishedAt', 'desc')
            ->setParameter('festival', $festival)
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getStatementBySlug($slug, $festival, $locale, $isAdmin, $repository)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin($repository, 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
        ;

        // add query for audio / video encoder
        if (strpos($repository, 'StatementAudio') !== false) {
            $qb
                ->leftjoin('na1.audio', 'na1a')
                ->leftjoin('na1a.translations', 'na1at')
            ;
            $this->addTranslationQueries($qb, 'na1at', 'fr', null, 'MediaAudio');
        } else if (strpos($repository, 'StatementVideo') !== false) {
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

    public function getSameDayStatement($festival, $locale, $dateTime, $count, $id, $mobile = null)
    {
        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';
        $now = new \DateTime();

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n,
                RAND() as HIDDEN rand')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->leftjoin('na2.translations', 'na2t')
            ->leftjoin('na3.translations', 'na3t')
            ->leftjoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.id != :id')
            ->andWhere('n.publishedAt BETWEEN :datetime1 AND :datetime2')
            ->andWhere('n.publishedAt <= :now')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
        ;


        $qb = $qb
            ->andWhere(
                "(na1t.locale = 'fr' AND na1t.status = :status) OR
                (na2t.locale = 'fr' AND na2t.status = :status) OR
                (na3t.locale = 'fr' AND na3t.status = :status) OR
                (na4t.locale = 'fr' AND na4t.status = :status)"
            )
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED)
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
                ->setParameter('locale', $locale)
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
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

    public function getStatementByDate($locale, $festival, $dateTime, $count)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'na4', 'WITH', 'na4.id = n.id')
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
            ->setParameter('site_slug', 'site-press')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getStatementArticles($locale, $festival, $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
        ;

        $qb = $qb
            ->andWhere("(na1t.locale = 'fr' AND na1t.status = :status)")
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftJoin('na1.translations', 'na2t')
                ->andWhere('(na2t.locale = :locale AND na2t.status = :status)')
                ->setParameter('status', StatementArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-press')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    /**
     * get an array of only the $locale version Statement of current $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getStatements($festival, $dateTime, $locale)
    {
        $qb = $this->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftjoin('na.translations', 'nat')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('nv.translations', 'nvt')
            ->leftjoin('ni.translations', 'nit')
            ->where('n.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
            ->andWhere(
                "(nat.locale = 'fr' AND nat.status = :status)
                OR (nit.locale = 'fr' AND nit.status = :status)
                OR (naat.locale = 'fr' AND naat.status = :status)
                OR (nvt.locale = 'fr' AND nvt.status = :status)"
            )
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
                ->setParameter('locale', $locale)
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
            ;
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('status', TranslateChildInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'site-press')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    /**
     *  Get the $locale version of Statement of current $festival by $id and verify publish date is between $dateTime
     *
     * @param $id
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getStatementById($id, $festival, $dateTime, $locale)
    {
        $qb = $this->createQueryBuilder('wt')
            ->join('wt.mediaVideos', 'mv')
            ->join('mv.sites', 's')
            ->join('wt.translations', 'wtt')
            ->join('mv.translations', 'mvt')
            ->where('mv.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('mv.inWebTv = :inWebTv')
            ->andWhere('(mvt.locale = :locale AND mvt.status = :status)')
            ->andWhere("(wtt.locale = 'fr' AND wtt.status = :status)")
        ;

        if ($locale != 'fr') {
            $qb = $qb
                ->leftJoin('wt.translations', 'na2t')
                ->andWhere('(na2t.locale = :locale AND na2t.status = :status_translated)')
                ->setParameter('locale', $locale)
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
            ;
        }

        $qb = $qb->andWhere('(mv.publishedAt IS NULL OR mv.publishedAt <= :datetime)')
            ->andWhere('(mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :datetime)')
            ->andWhere('mv.id = :id')
            ->setParameter('festival', $festival)
            ->setParameter('id', $id)
            ->setParameter('inWebTv', true)
            ->setParameter('status', WebTvTranslationInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'flux-mobiles')
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return $qb;
    }

    /**
     * get an array of only the $count last Statement of $locale version of current
     * $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @param $count
     * @param $locale
     * @return mixed
     */
    public function getLastStatements($festival, $dateTime, $locale, $count)
    {
        $qb = $this->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'nv', 'WITH', 'nv.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'ni', 'WITH', 'ni.id = n.id')
            ->leftjoin('na.translations', 'nat')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('nv.translations', 'nvt')
            ->leftjoin('ni.translations', 'nit')
            ->andWhere('n.displayedMobile = :displayedMobile')
            ->andWhere('n.festival = :festival')
            ->andWhere('s.slug = :site')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
            ->andWhere(
                "(nat.locale = 'fr' AND nat.status = :status)
                OR (nit.locale = 'fr' AND nit.status = :status)
                OR (naat.locale = 'fr' AND naat.status = :status)
                OR (nvt.locale = 'fr' AND nvt.status = :status)"
            )
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
                ->setParameter('locale', $locale)
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
            ;
        }

        $qb = $qb->addOrderBy('n.publishedAt', 'DESC')
            ->setMaxResults($count)
            ->setParameter('festival', $festival)
            ->setParameter('displayedMobile', true)
            ->setParameter('status', TranslateChildInterface::STATUS_PUBLISHED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site', 'site-press')
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function getOlderStatement($locale, $festival, $date)
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'na4', 'WITH', 'na4.id = n.id')
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
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED)
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
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
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

    public function getNextStatement($locale, $festival, $date)
    {

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'na4', 'WITH', 'na4.id = n.id')
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
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED)
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
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
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

    public function getAllStatement($locale, $festival)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'na4', 'WITH', 'na4.id = n.id')
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
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED)
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
                ->setParameter('status_translated', StatementArticleTranslation::STATUS_TRANSLATED)
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