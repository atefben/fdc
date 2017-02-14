<?php

namespace FDC\CourtMetrageBundle\Repository;


use Doctrine\ORM\EntityRepository;
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

        return $this
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
            ->andWhere(
                '(na1t.locale = :locale AND na1t.status = :status) OR
                (na2t.locale = :locale AND na2t.status = :status) OR
                (na3t.locale = :locale AND na3t.status = :status) OR
                (na4t.locale = :locale AND na4t.status = :status)'
            )
            ->setParameter('locale', $locale)
            ->setParameter('status', CcmNewsArticleTranslation::STATUS_PUBLISHED)
            ->getQuery()
            ->getResult()
        ;
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
            ->andWhere(
                '(na1t.locale = :locale AND na1t.status = :status) OR
                (na2t.locale = :locale AND na2t.status = :status) OR
                (na3t.locale = :locale AND na3t.status = :status) OR
                (na4t.locale = :locale AND na4t.status = :status)'
            )
            ->setParameter('locale', $locale)
            ->setParameter('status', CcmNewsArticleTranslation::STATUS_PUBLISHED)
        ;
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
            ->setMaxResults(16)
            ->setFirstResult($offset)
        ;

        return $qb->getQuery()->getResult();
    }
}