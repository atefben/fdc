<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoAudio;
use Base\CoreBundle\Entity\InfoImage;
use Base\CoreBundle\Entity\InfoVideo;
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
     * @param $dateTime
     * @param null $maxResults
     * @param string $site
     * @param array $filters
     * @return Node[]
     */
    public function getHomeStatementsAndInfos($locale, DateTime $dateTime, $maxResults = null, $site = 'site-press', $filters = [])
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
            ->innerJoin('n.translations', 'translations')
            ->innerJoin('n.sites', 'site')
            ->andWhere('site.slug = :site_slug')
            ->setParameter('site_slug', $site)
            ->andWhere('(n.publishedAt <= :dateTime)')
            ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :dateTime)')
            ->setParameter('dateTime', $dateTime)
        ;

        foreach ($filters as $field => $value) {
            $qb
                ->andWhere("n.{$field} = :{$field}")
                ->setParameter(":{$field}", $value)
            ;
        }

        $this->addTranslationQueries($qb, 'translations', $locale);

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb
            ->orderBy('n.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
}
