<?php

namespace FDC\CourtMetrageBundle\Repository;


use Doctrine\ORM\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmNews;
use FDC\CourtMetrageBundle\Entity\CcmNewsArticleTranslation;

/**
 * Class CcmNewsRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmNewsRepository extends EntityRepository
{
    /**
     * @param string $locale
     * @return array
     */
    public function getThemesAndDatesOfPublishedNews($locale = 'fr')
    {
        $now = new \DateTime();

        $qb = $this
            ->createQueryBuilder('n')
            ->select('t.id', 'tt.name', 'n.publishedAt')
            ->join('n.theme', 't')
            ->join('Base\CoreBundle\Entity\ThemeTranslation', 'tt', 'WITH', 'tt.translatable = t.id AND tt.locale = :locale')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere('n.publishedAt <= :now and (n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
            ->setParameter('now', $now)
            ->setParameter('locale', $locale)
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_translated) OR
                    (na2t.locale = :locale AND na2t.status = :status_translated) OR
                    (na3t.locale = :locale AND na3t.status = :status_translated) OR
                    (na4t.locale = :locale AND na4t.status = :status_translated)'
                )
                ->setParameter('status_translated', CcmNewsArticleTranslation::STATUS_TRANSLATED)
            ;
        } else {
            $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status) OR
                    (na2t.locale = :locale AND na2t.status = :status) OR
                    (na3t.locale = :locale AND na3t.status = :status) OR
                    (na4t.locale = :locale AND na4t.status = :status)'
                )
                ->setParameter('status', CcmNewsArticleTranslation::STATUS_PUBLISHED)
            ;
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $locale
     * @param null $year
     * @param null $themeId
     * @param int $offset
     * @return array
     */
    public function getNewsArticlesByYearAndTheme($locale = 'fr', $year = null, $themeId = null, $offset = 0)
    {
        $qb =  $this
            ->createQueryBuilder('n')
            ->select('n')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_translated) OR
                    (na2t.locale = :locale AND na2t.status = :status_translated) OR
                    (na3t.locale = :locale AND na3t.status = :status_translated) OR
                    (na4t.locale = :locale AND na4t.status = :status_translated)'
                )
                ->setParameter('status_translated', CcmNewsArticleTranslation::STATUS_TRANSLATED)
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
                ->setParameter('status', CcmNewsArticleTranslation::STATUS_PUBLISHED)
            ;
        }
        if ($year == null) {
            $now = new \DateTime();
            $qb
                ->andWhere('n.publishedAt <= :now AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
                ->setParameter('now', $now)
            ;
        } else {
            $yearStart = \DateTime::createFromFormat('m-d-Y H:i:s', '01-01-' . $year . ' 00:00:00');
            $yearEnd = clone $yearStart;
            $yearEnd = $yearEnd->modify('+1 year');
            $qb
                ->andWhere('(n.publishedAt BETWEEN :yearStart AND :yearEnd) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
                ->setParameter('yearStart', $yearStart)
                ->setParameter('yearEnd', $yearEnd)
            ;
        }
        if ($themeId != null) {
            $qb
                ->join('n.theme', 't')
                ->andWhere('t.id = :themeId')
                ->setParameter('themeId', $themeId)
            ;
        }
        $qb
            ->orderBy('n.publishedAt', 'DESC')
            //->setMaxResults(16) // we show all of them for now
            ->setFirstResult($offset)
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $slug
     * @param string $locale
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getNewsArticleBySlugAndLocale($slug, $locale = 'fr')
    {
        $now = new \DateTime();

        $qb =  $this
            ->createQueryBuilder('n')
            ->select('n')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->setParameter('slug', $slug)
            ->andWhere('n.publishedAt <= :now AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
            ->setParameter('now', $now)
            ->setMaxResults(1)
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere(
                    '(na1t.slug = :slug AND na1t.locale = :locale AND na1t.status = :status) OR
                    (na2t.slug = :slug AND na2t.locale = :locale AND na2t.status = :status) OR
                    (na3t.slug = :slug AND na3t.locale = :locale AND na3t.status = :status) OR
                    (na4t.slug = :slug AND na4t.locale = :locale AND na4t.status = :status)'
                )
                ->setParameter('status_translated', CcmNewsArticleTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        } else {
            $qb
                ->andWhere(
                    '(na1t.slug = :slug AND na1t.locale = :locale_fr AND na1t.status = :status) OR
                    (na2t.slug = :slug AND na2t.locale = :locale_fr AND na2t.status = :status) OR
                    (na3t.slug = :slug AND na3t.locale = :locale_fr AND na3t.status = :status) OR
                    (na4t.slug = :slug AND na4t.locale = :locale_fr AND na4t.status = :status)'
                )
                ->setParameter('locale_fr', 'fr')
                ->setParameter('status', CcmNewsArticleTranslation::STATUS_PUBLISHED)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param \DateTime $date
     * @param string $locale
     * @param bool $maxResults
     * @param null $excludedIds
     * @return array
     */
    public function getSameDayNews($date, $locale = 'fr', $maxResults = false, $excludedIds = null)
    {
        $dateTime1 = $date->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $date->format('Y-m-d') . ' 23:59:59';
        $now = new \DateTime();

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n, RAND() as HIDDEN rand')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
        ;
        $qb
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
                ->setParameter('status_translated', CcmNewsArticleTranslation::STATUS_TRANSLATED)
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
                ->setParameter('status', CcmNewsArticleTranslation::STATUS_PUBLISHED)
            ;
        }
        $qb
            ->addOrderBy('rand')
            ->setParameter('now', $now)
            ->setParameter('datetime1', $dateTime1)
            ->setParameter('datetime2', $dateTime2)
        ;
        if ($excludedIds !== null && !empty($excludedIds)) {
            $qb
                ->andWhere('n.id not in (:excludedIds)')
                ->setParameter('excludedIds', $excludedIds)
            ;           
        }

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $date
     * @param string $direction
     * @param string $locale
     * @return array
     */
    public function getPrevOrNextNews($date, $direction = 'next', $locale = 'fr')
    {
        $direction = $direction == 'next' ? 'next' : 'prev';
        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmNewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftJoin('na1.translations', 'na1t')
            ->leftJoin('na2.translations', 'na2t')
            ->leftJoin('na3.translations', 'na3t')
            ->leftJoin('na4.translations', 'na4t')
            ->andWhere('n.publishedAt ' . ( $direction == 'next' ? '>' : '<' ) . ' :date')
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_translated) OR
                    (na2t.locale = :locale AND na2t.status = :status_translated) OR
                    (na3t.locale = :locale AND na3t.status = :status_translated) OR
                    (na4t.locale = :locale AND na4t.status = :status_translated)'
                )
                ->setParameter('status_translated', CcmNewsArticleTranslation::STATUS_TRANSLATED)
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
                ->setParameter('status', CcmNewsArticleTranslation::STATUS_PUBLISHED)
            ;
        }
        $qb = $qb
            ->orderBy('n.publishedAt', $direction == 'next' ? 'ASC' : 'DESC' )
            ->setMaxResults(1)
            ->setParameter('date', $date)
        ;

        return $qb->getQuery()->getResult();
    }
}