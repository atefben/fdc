<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use JMS\DiExtraBundle\Annotation as DI;

use Base\CoreBundle\Entity\StatementArticleTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * StatementRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class StatementRepository extends EntityRepository
{
    public function getStatementBySlug($slug, $festival, $locale, $dateTime, $isAdmin)
    {
        $qb = $this
            ->createQueryBuilder('n')
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
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        if ($isAdmin === true) {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.slug = :statement_slug) OR
                    (na2t.locale = :locale AND na2t.slug = :statement_slug) OR
                    (na3t.locale = :locale AND na3t.slug = :statement_slug) OR
                    (na4t.locale = :locale AND na4t.slug = :statement_slug)'
                );
        } else {
            $qb = $qb
                ->andWhere(
                    '(na1t.locale = :locale AND na1t.status = :status AND na1t.slug = :statement_slug) OR
                    (na2t.locale = :locale AND na2t.status = :status AND na2t.slug = :statement_slug) OR
                    (na3t.locale = :locale AND na3t.status = :status AND na3t.slug = :statement_slug) OR
                    (na4t.locale = :locale AND na4t.status = :status AND na4t.slug = :statement_slug)'
                )
                ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED);
        }

        $qb = $qb
            ->setParameter('statement_slug', $slug)
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')
            ->getQuery()
            ->getOneOrNullResult();

        return $qb;
    }

    public function getSameDayStatement($festival, $locale, $dateTime, $count, $id)
    {
        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';

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
            ->andWhere('(n.publishedAt >= :datetime) AND (n.publishedAt < :datetime2)');


        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale AND na1t.status = :status) OR
                (na2t.locale = :locale AND na2t.status = :status) OR
                (na3t.locale = :locale AND na3t.status = :status) OR
                (na4t.locale = :locale AND na4t.status = :status)'
            )
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED);


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

    public function getStatementArticles($locale, $festival, $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->join('n.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->where('s.slug = :site_slug')
            ->andWhere('n.festival = :festival')
            ->andWhere('(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)');

        $qb = $qb
            ->andWhere(
                '(na1t.locale = :locale AND na1t.status = :status)'
            )
            ->setParameter('status', StatementArticleTranslation::STATUS_PUBLISHED);

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
     * get an array of only the $locale version Statement of current $festival and verify publish date is between $dateTime
     *
     * @param $festival
     * @param $dateTime
     * @param $locale
     * @return mixed
     */
    public function getStatements($festival, $dateTime, $locale)
    {
        return $this->createQueryBuilder('n')
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