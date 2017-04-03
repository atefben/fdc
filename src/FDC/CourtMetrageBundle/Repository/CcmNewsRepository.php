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
            ->select('t.id', 'n.publishedAt')
            ->leftJoin('n.theme', 't')
            ->leftJoin('FDC\CourtMetrageBundle\Entity\CcmThemeTranslation', 'tt', 'WITH', 'tt.translatable = t.id AND tt.locale = :locale')
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
            ->setParameter('status_published', CcmNewsArticleTranslation::STATUS_PUBLISHED)
            ->orderBy('n.publishedAt', 'DESC')
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
                ->leftJoin('na1.translations', 'na5t')
                ->leftJoin('na2.translations', 'na6t')
                ->leftJoin('na3.translations', 'na7t')
                ->leftJoin('na4.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale_fr AND na5t.status = :status_published) OR
                    (na6t.locale = :locale_fr AND na6t.status = :status_published) OR
                    (na7t.locale = :locale_fr AND na7t.status = :status_published) OR
                    (na8t.locale = :locale_fr AND na8t.status = :status_published)'
                )
                ->setParameter('locale_fr', 'fr')
            ;
        } else {
            $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_published) OR
                    (na2t.locale = :locale AND na2t.status = :status_published) OR
                    (na3t.locale = :locale AND na3t.status = :status_published) OR
                    (na4t.locale = :locale AND na4t.status = :status_published)'
                )
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
    public function getNewsArticlesByYearAndTheme($locale = 'fr', $year = null, $themeId = null, $offset = 0, $limit = null, $displayedOnHomepage = false)
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
            ->setParameter('locale', $locale)
            ->setParameter('status_published', CcmNewsArticleTranslation::STATUS_PUBLISHED)
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
                ->leftJoin('na1.translations', 'na5t')
                ->leftJoin('na2.translations', 'na6t')
                ->leftJoin('na3.translations', 'na7t')
                ->leftJoin('na4.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale_fr AND na5t.status = :status_published) OR
                    (na6t.locale = :locale_fr AND na6t.status = :status_published) OR
                    (na7t.locale = :locale_fr AND na7t.status = :status_published) OR
                    (na8t.locale = :locale_fr AND na8t.status = :status_published)'
                )
                ->setParameter('locale_fr', 'fr')
            ;
        } else {
            $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_published) OR
                    (na2t.locale = :locale AND na2t.status = :status_published) OR
                    (na3t.locale = :locale AND na3t.status = :status_published) OR
                    (na4t.locale = :locale AND na4t.status = :status_published)'
                )
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
            ->setFirstResult($offset)
        ;

        if($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $slug
     * @param string $locale
     * @param bool $isAdmin
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getNewsArticleBySlugAndLocale($slug, $locale = 'fr', $isAdmin = false)
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
            ->setParameter('locale', $locale)
            ->setMaxResults(1)
        ;
        if ($isAdmin !== true) {
            $qb
                ->andWhere('n.publishedAt <= :now AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :now)')
                ->setParameter('now', $now)
            ;
            if ($locale != 'fr') {
                $qb
                    ->andWhere(
                        '(na1t.slug = :slug AND na1t.locale = :locale AND na1t.status = :status_translated) OR
                        (na2t.slug = :slug AND na2t.locale = :locale AND na2t.status = :status_translated) OR
                        (na3t.slug = :slug AND na3t.locale = :locale AND na3t.status = :status_translated) OR
                        (na4t.slug = :slug AND na4t.locale = :locale AND na4t.status = :status_translated)'
                    )
                    ->setParameter('status_translated', CcmNewsArticleTranslation::STATUS_TRANSLATED)
                    ->leftJoin('na1.translations', 'na5t')
                    ->leftJoin('na2.translations', 'na6t')
                    ->leftJoin('na3.translations', 'na7t')
                    ->leftJoin('na4.translations', 'na8t')
                    ->andWhere(
                        '(na5t.locale = :locale_fr AND na5t.status = :status_published) OR
                        (na6t.locale = :locale_fr AND na6t.status = :status_published) OR
                        (na7t.locale = :locale_fr AND na7t.status = :status_published) OR
                        (na8t.locale = :locale_fr AND na8t.status = :status_published)'
                    )
                    ->setParameter('status_published', CcmNewsArticleTranslation::STATUS_PUBLISHED)
                    ->setParameter('locale_fr', 'fr')
                ;
            } else {
                $qb
                    ->andWhere(
                        '(na1t.slug = :slug AND na1t.locale = :locale AND na1t.status = :status_published) OR
                        (na2t.slug = :slug AND na2t.locale = :locale AND na2t.status = :status_published) OR
                        (na3t.slug = :slug AND na3t.locale = :locale AND na3t.status = :status_published) OR
                        (na4t.slug = :slug AND na4t.locale = :locale AND na4t.status = :status_published)'
                    )
                    ->setParameter('status_published', CcmNewsArticleTranslation::STATUS_PUBLISHED)
                ;
            }
        } else {
            $qb
                ->andWhere(
                    '(na1t.slug = :slug AND na1t.locale = :locale) OR
                    (na2t.slug = :slug AND na2t.locale = :locale) OR
                    (na3t.slug = :slug AND na3t.locale = :locale) OR
                    (na4t.slug = :slug AND na4t.locale = :locale)'
                )
                ->setParameter('locale', $locale)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
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
            ->setParameter('locale', $locale)
            ->setParameter('status_published', CcmNewsArticleTranslation::STATUS_PUBLISHED)
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
                ->leftJoin('na1.translations', 'na5t')
                ->leftJoin('na2.translations', 'na6t')
                ->leftJoin('na3.translations', 'na7t')
                ->leftJoin('na4.translations', 'na8t')
                ->andWhere(
                    '(na5t.locale = :locale_fr AND na5t.status = :status_published) OR
                    (na6t.locale = :locale_fr AND na6t.status = :status_published) OR
                    (na7t.locale = :locale_fr AND na7t.status = :status_published) OR
                    (na8t.locale = :locale_fr AND na8t.status = :status_published)'
                )
                ->setParameter('locale_fr', 'fr')
            ;
        } else {
            $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status_published) OR
                    (na2t.locale = :locale AND na2t.status = :status_published) OR
                    (na3t.locale = :locale AND na3t.status = :status_published) OR
                    (na4t.locale = :locale AND na4t.status = :status_published)'
                )
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