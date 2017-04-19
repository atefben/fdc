<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoAudio;
use Base\CoreBundle\Entity\InfoImage;
use Base\CoreBundle\Entity\InfoVideo;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsAudio;
use Base\CoreBundle\Entity\NewsImage;
use Base\CoreBundle\Entity\NewsVideo;
use Base\CoreBundle\Entity\Node;
use Base\CoreBundle\Entity\StatementArticle;
use Base\CoreBundle\Entity\StatementAudio;
use Base\CoreBundle\Entity\StatementImage;
use Base\CoreBundle\Entity\StatementVideo;
use DateTime;

/**
 * Class NodeRepository
 * @package Base\CoreBundle\Repository
 */
class NodeRepository extends EntityRepository
{

    /**
     * @param $locale
     * @param null $maxResults
     * @param string $site
     * @param null $firstResult
     * @param array $filters
     * @return Node[]
     */
    public function getHomeStatementsAndInfos($locale, $maxResults = null, $site = 'site-press', $firstResult = null, $filters = [])
    {
        $entities = [
            InfoArticle::class,
            InfoAudio::class,
            InfoImage::class,
            InfoVideo::class,
            StatementArticle::class,
            StatementAudio::class,
            StatementImage::class,
            StatementVideo::class,
        ];

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;

        foreach ($filters as $field => $value) {
            $qb
                ->andWhere("n.{$field} = :{$field}")
                ->setParameter(":{$field}", $value)
            ;
        }

        $this->addTranslationQueries($qb, 'nt', $locale);

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        if ($firstResult !== null) {
            $qb->setFirstResult($firstResult);
        }

        return $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     * @param string $site
     * @param null $type
     * @param null $exclude
     * @param null $before
     * @param array $filters
     * @param null $maxResults
     * @return Node[]
     */
    public function getStatementsAndInfos($locale, $site = 'site-press', $type = null, $exclude = null, $before = null, $filters = [], $maxResults = null)
    {
        $infoEntities = [
            InfoArticle::class,
            InfoAudio::class,
            InfoImage::class,
            InfoVideo::class,
        ];

        $statementEntities = [
            StatementArticle::class,
            StatementAudio::class,
            StatementImage::class,
            StatementVideo::class,
        ];

        if ('info' == $type) {
            $entities = $infoEntities;
        } elseif ('statement' == $type || 'communique' == $type) {
            $entities = $statementEntities;
        } else {
            $entities = array_merge($infoEntities, $statementEntities);
        }

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;

        foreach ($filters as $field => $value) {
            $qb
                ->andWhere("n.{$field} = :{$field}")
                ->setParameter(":{$field}", $value)
            ;
        }

        if ($exclude) {
            $qb
                ->andWhere('n.id != :exclude')
                ->setParameter(':exclude', $exclude)
            ;
        }

        if ($before) {
            $qb
                ->andWhere('n.publishedAt <= :before')
                ->setParameter(':before', $before)
            ;
        }

        $this->addTranslationQueries($qb, 'nt', $locale);

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     * @param string $site
     * @return array
     */
    public function getFormatsStatementsAndInfos($locale, $site = 'site-press')
    {
        $entities = [
            InfoArticle::class,
            InfoAudio::class,
            InfoImage::class,
            InfoVideo::class,
            StatementArticle::class,
            StatementAudio::class,
            StatementImage::class,
            StatementVideo::class,
        ];


        $qb = $this
            ->createQueryBuilder('n')
            ->select('n.typeClone')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;


        $this->addTranslationQueries($qb, 'nt', $locale);

        return $qb
            ->addGroupBy('n.typeClone')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     * @param string $site
     * @return array
     */
    public function getYearsStatementsAndInfos($locale, $site = 'site-press')
    {
        $entities = [
            InfoArticle::class,
            InfoAudio::class,
            InfoImage::class,
            InfoVideo::class,
            StatementArticle::class,
            StatementAudio::class,
            StatementImage::class,
            StatementVideo::class,
        ];


        $qb = $this
            ->createQueryBuilder('n')
            ->select('f.year')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->innerJoin('n.festival', 'f')
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;


        $this->addTranslationQueries($qb, 'nt', $locale);

        return $qb
            ->addGroupBy('f.year')
            ->addOrderBy('f.year', 'desc')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     * @param string $site
     * @return array
     */
    public function getThemesStatementsAndInfos($locale, $site = 'site-press')
    {
        $entities = [
            InfoArticle::class,
            InfoAudio::class,
            InfoImage::class,
            InfoVideo::class,
            StatementArticle::class,
            StatementAudio::class,
            StatementImage::class,
            StatementVideo::class,
        ];


        $qb = $this
            ->createQueryBuilder('n')
            ->select('t.id')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->innerJoin('n.theme', 't')
            ->innerJoin('t.translations', 'tt')
            ->andWhere('tt.locale = :themeLocale')
            ->setParameter(':themeLocale', $locale)
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;


        $this->addTranslationQueries($qb, 'nt', $locale);

        return $qb
            ->addGroupBy('t.id')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     * @param string $site
     * @param null $exclude
     * @param null $before
     * @param array $filters
     * @param null $maxResults
     * @return Node[]
     */
    public function getNewsRetrospective($locale, FilmFestival $festival = null, $site = 'site-press', $exclude = null, $before = null, $filters = [], $maxResults = null)
    {
        $entities = [
            NewsArticle::class,
            NewsAudio::class,
            NewsImage::class,
            NewsVideo::class,
        ];


        $qb = $this
            ->createQueryBuilder('n')
            ->select('n')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        if ($festival) {
            $qb
                ->andWhere('n.festival = :festivalId')
                ->setParameter(':festivalId', $festival->getId())
            ;
        }

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;

        foreach ($filters as $field => $value) {
            $qb
                ->andWhere("n.{$field} = :{$field}")
                ->setParameter(":{$field}", $value)
            ;
        }

        if ($exclude) {
            $qb
                ->andWhere('n.id != :exclude')
                ->setParameter(':exclude', $exclude)
            ;
        }

        if ($before) {
            $qb
                ->andWhere('n.publishedAt <= :before')
                ->setParameter(':before', $before)
            ;
        }

        $this->addTranslationQueries($qb, 'nt', $locale);

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     * @param string $site
     * @param FilmFestival $festival
     * @return array
     */
    public function getThemesNewsRetrospective($locale, $site = 'site-press', FilmFestival $festival = null)
    {
        $entities = [
            NewsArticle::class,
            NewsAudio::class,
            NewsImage::class,
            NewsVideo::class,
        ];

        $qb = $this
            ->createQueryBuilder('n')
            ->select('t.id')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->innerJoin('n.theme', 't')
            ->innerJoin('t.translations', 'tt')
            ->andWhere('tt.locale = :themeLocale')
            ->setParameter(':themeLocale', $locale)
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        if ($festival) {
            $qb
                ->andWhere('n.festival = :festivalId')
                ->setParameter(':festivalId', $festival->getId())
            ;
        }

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;


        $this->addTranslationQueries($qb, 'nt', $locale);

        return $qb
            ->addGroupBy('t.id')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     * @param string $site
     * @param FilmFestival $festival
     * @return array
     */
    public function getDatesNewsRetrospective($locale, $site = 'site-press', FilmFestival $festival = null)
    {
        $entities = [
            NewsArticle::class,
            NewsAudio::class,
            NewsImage::class,
            NewsVideo::class,
        ];

        $qb = $this
            ->createQueryBuilder('n')
            ->select('DATE_FORMAT(n.publishedAt, \'%m-%d-%Y\') as days')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->innerJoin('n.festival', 'f')
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        if ($festival) {
            $qb
                ->andWhere('n.festival = :festivalId')
                ->setParameter(':festivalId', $festival->getId())
            ;
        }

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;


        $this->addTranslationQueries($qb, 'nt', $locale);

        return $qb
            ->addGroupBy('days')
            ->addOrderBy('f.year', 'desc')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     * @param string $site
     * @param FilmFestival $festival
     * @return array
     */
    public function getFormatsNewsRetrospective($locale, $site = 'site-press', FilmFestival $festival = null)
    {
        $entities = [
            NewsArticle::class,
            NewsAudio::class,
            NewsImage::class,
            NewsVideo::class,
        ];

        $qb = $this
            ->createQueryBuilder('n')
            ->select('n.typeClone')
            ->andWhere('n.entityClass IN (:entities)')
            ->setParameter(':entities', $entities)
            ->innerJoin('n.translations', 'nt')
            ->innerJoin('n.sites', 'site')
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', new DateTime())
        ;

        if ($festival) {
            $qb
                ->andWhere('n.festival = :festivalId')
                ->setParameter(':festivalId', $festival->getId())
            ;
        }

        $qb
            ->leftJoin('n.mainVideo', 'mv')
            ->leftJoin('mv.sites', 'mvs')
            ->andWhere('n.typeClone != :video OR (n.mainVideo is not null AND mv.publishedAt <= :dateTime AND (mv.publishEndedAt IS NULL OR mv.publishEndedAt >= :dateTime)) AND mvs.slug = :site_slug')
            ->setParameter(':video', 'video')
        ;

        $qb
            ->leftJoin('n.mainAudio', 'ma')
            ->leftJoin('ma.sites', 'mas')
            ->andWhere('n.typeClone != :audio OR (n.mainAudio is not null AND ma.publishedAt <= :dateTime AND (ma.publishEndedAt IS NULL OR ma.publishEndedAt >= :dateTime)) AND mas.slug = :site_slug')
            ->setParameter(':audio', 'audio')
        ;


        $this->addTranslationQueries($qb, 'nt', $locale);

        return $qb
            ->addGroupBy('n.typeClone')
            ->getQuery()
            ->getResult()
            ;
    }
}
