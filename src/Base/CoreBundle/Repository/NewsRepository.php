<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\NewsArticleTranslation;

use Doctrine\ORM\EntityRepository;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * NewsRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class NewsRepository extends EntityRepository
{
    public function getNewsBySlug($slug, $festival, $locale, $dateTime, $isAdmin, $repository)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin($repository, 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        if ($isAdmin === true) {
            $qb = $qb->andWhere('(na1t.locale = :locale AND na1t.slug = :news_slug)');
        } else {
            if($locale != 'fr') {
                $qb = $qb
                    ->andWhere('(na1t.locale = :locale AND na1t.status = :status AND na1t.slug = :news_slug)')
                    ->setParameter('status', NewsArticleTranslation::STATUS_TRANSLATED);
            } else {
                $qb = $qb
                    ->andWhere('(na1t.locale = fr AND na1t.status = :status AND na1t.slug = :news_slug)')
                    ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED);
            }
        }

        $qb = $qb
            ->setParameter('news_slug', $slug)
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getOneOrNullResult();

        return $qb;
    }

    public function getSameDayNews($festival, $locale, $dateTime, $count, $id)
    {
        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n,
                RAND() as HIDDEN rand')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->leftjoin('na2.translations', 'na2t')
            ->leftjoin('na3.translations', 'na3t')
            ->leftjoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('n.id != :id')
            ->andWhere('(n.publishedAt >= :datetime) AND (n.publishedAt < :datetime2)');


        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status) OR
                    (na2t.locale = :locale AND na2t.status = :status) OR
                    (na3t.locale = :locale AND na3t.status = :status) OR
                    (na4t.locale = :locale AND na4t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status) OR
                    (na2t.locale = :locale AND na2t.status = :status) OR
                    (na3t.locale = :locale AND na3t.status = :status) OR
                    (na4t.locale = :locale AND na4t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED);
        }


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

    public function getNewsByDate($locale,$festival,$dateTime,$count)
    {
        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->leftjoin('na2.translations', 'na2t')
            ->leftjoin('na3.translations', 'na3t')
            ->leftjoin('na4.translations', 'na4t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt > :datetime) AND (n.publishedAt < :datetime2)');

        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status) OR
                    (na2t.locale = :locale AND na2t.status = :status) OR
                    (na3t.locale = :locale AND na3t.status = :status) OR
                    (na4t.locale = :locale AND na4t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status) OR
                    (na2t.locale = :locale AND na2t.status = :status) OR
                    (na3t.locale = :locale AND na3t.status = :status) OR
                    (na4t.locale = :locale AND na4t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED);
        }

        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setMaxResults($count)
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime1)
            ->setParameter('datetime2', $dateTime2)
            ->setParameter('site_slug', 'site-evenementiel');

        $qb = $qb
            ->getQuery()
            ->getResult();

        return $qb;
    }



    public function getNewsArticles($locale,$festival,$dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED);
        }


        $qb = $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->setParameter('locale', $locale)
            ->setParameter('festival', $festival)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getResult();

        return $qb;
    }

    public function getNewsPhotos($locale,$festival,$dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\NewsImage', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED);
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getResult();

        return $qb;
    }

    public function getNewsVideos($locale,$festival,$dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\NewsVideo', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED);
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getResult();

        return $qb;
    }

    public function getNewsAudios($locale,$festival,$dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\NewsAudio', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status)'
                )
                ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED);
        }

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
     * get an array of only the $locale version News of current $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getApiNews($festival, $dateTime, $locale)
    {
        return $this->createQueryBuilder('n')
            ->leftjoin('Base\CoreBundle\Entity\NewsArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsImage', 'nai', 'WITH', 'nai.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsVideo', 'nav', 'WITH', 'nav.id = n.id')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('na.translations', 'nat')
            ->leftjoin('nai.translations', 'nait')
            ->leftjoin('nav.translations', 'navt')
            ->where('n.festival = :festival')
            ->andWhere('n.displayedMobile = :displayed_mobile')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
            ->andWhere(
                '(nat.locale = :locale AND nat.status = :status) OR
                (nat.locale = :locale AND nat.status = :status_translated) OR
                (naat.locale = :locale AND naat.status = :status) OR
                (naat.locale = :locale AND naat.status = :status_translated) OR
                (nait.locale = :locale AND nait.status = :status) OR
                (nait.locale = :locale AND nait.status = :status_translated) OR
                (navt.locale = :locale AND navt.status = :status) OR
                (navt.locale = :locale AND navt.status = :status_translated)'
            )
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
            ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('displayed_mobile', true)
            ->getQuery();
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
    public function getApiNewsById($id, $festival, $dateTime, $locale)
    {
        return $this->createQueryBuilder('n')
            ->leftjoin('Base\CoreBundle\Entity\NewsArticle', 'na', 'WITH', 'na.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsAudio', 'naa', 'WITH', 'naa.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsImage', 'nai', 'WITH', 'nai.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsVideo', 'nav', 'WITH', 'nav.id = n.id')
            ->leftjoin('naa.translations', 'naat')
            ->leftjoin('na.translations', 'nat')
            ->leftjoin('nai.translations', 'nait')
            ->leftjoin('nav.translations', 'navt')
            ->where('n.festival = :festival')
            ->andWhere('n.id = :id')
            ->andWhere('n.displayedMobile = :displayed_mobile')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
            ->andWhere(
                '(nat.locale = :locale AND nat.status = :status) OR
                (nat.locale = :locale AND nat.status = :status_translated) OR
                (naat.locale = :locale AND naat.status = :status) OR
                (naat.locale = :locale AND naat.status = :status_translated) OR
                (nait.locale = :locale AND nait.status = :status) OR
                (nait.locale = :locale AND nait.status = :status_translated) OR
                (navt.locale = :locale AND navt.status = :status) OR
                (navt.locale = :locale AND navt.status = :status_translated)'
            )
            ->setParameter('id', $id)
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('status', NewsArticleTranslation::STATUS_PUBLISHED)
            ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
            ->setParameter('datetime', $dateTime)
            ->setParameter('displayed_mobile', true)
            ->getQuery();
    }
}