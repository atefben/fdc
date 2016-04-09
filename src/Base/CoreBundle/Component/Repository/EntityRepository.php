<?php

namespace Base\CoreBundle\Component\Repository;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use \DateTime;

use Doctrine\ORM\EntityRepository as BaseRepository;
use Doctrine\ORM\QueryBuilder;

class EntityRepository extends BaseRepository
{

    public function addDashboardTranslatorQueries($qb, $aliases, $params)
    {
        $query = '';
        $query2 = '';
        foreach ($aliases as $alias) {
            $query .= "({$alias}.locale IN (:locales) AND {$alias}.status = :status";
            $query .= ") OR";
        }
        $query = substr($query, 0, -3);
        $qb = $qb->where($query);

        if (isset($params['title']) && !empty($params['title'])) {
            foreach ($aliases as $key => $alias) {
                $aliasMain = substr($alias, 0, -1);
                $aliasTrans = $aliasMain. 't'. $key;
                $qb->leftJoin("{$aliasMain}.translations", $aliasTrans);
                $query2 .= "({$aliasTrans}.locale = 'fr' AND {$aliasTrans}.title LIKE :title";
                $query2 .= ") OR";
            }
            $qb->setParameter('title', '%'. $params['title']. '%');
            $query2 = substr($query2, 0, -3);
            $qb = $qb->andWhere($query2);
        }

        return $qb;

    }

    public function countByStatusAndLocales($status, $locales)
    {
        $qb = $this
            ->createQueryBuilder('e')
            ->select('count(t.id)')
            ->leftJoin('e.translations', 't')
            ->where('t.status = :status')
            ->andWhere('t.locale IN (:locales)')
            ->setParameter('status', $status)
            ->setParameter('locales', $locales)
            ->getQuery()
            ->getSingleScalarResult();
        ;

        return $qb;
    }

    /**
     * @param $qb
     * @param $alias
     * @return QueryBuilder
     */
    public function addFDCEventQueries($qb, $alias)
    {
        $qb = $qb
            ->andWhere("{$alias}.slug = 'site-evenementiel'");

        return $qb;
    }

    /**
     * @param $qb
     * @param $alias
     * @return QueryBuilder
     */
    public function addFDCPressQueries($qb, $alias)
    {
        $qb = $qb
            ->andWhere("{$alias}.slug = 'site-press'");

        return $qb;
    }

    /**
     * @param $qb
     * @param $alias
     * @return QueryBuilder
     */
    public function addMobileQueries($qb, $alias)
    {
        $qb = $qb
            ->andWhere("{$alias}.displayedMobile = :displayed_mobile")
            ->setParameter('displayed_mobile', true)
        ;

        return $qb;
    }

    /**
     * @param $qb
     * @param $alias
     * @param $festival
     * @param boolean $published
     * @return QueryBuilder
     */
    public function addMasterQueries($qb, $alias, $festival, $published = true)
    {
        $qb = $qb
            ->andWhere("{$alias}.festival = :festival")
            ->setParameter('festival', $festival)
        ;

        if ($published) {
            $qb = $qb
                ->andWhere("({$alias}.publishedAt IS NULL OR {$alias}.publishedAt <= :datetime)")
                ->andWhere("({$alias}.publishEndedAt IS NULL OR {$alias}.publishEndedAt >= :datetime)")
                ->setParameter('datetime', new DateTime())
            ;
        }

        return $qb;
    }

    /**
     * @param $qb
     * @param $alias
     * @param $locale
     * @param null $slug
     * @return QueryBuilder
     */
    public function addTranslationQueries($qb, $alias, $locale, $slug = null, $media = false)
    {
        if ($slug !== null) {
            $qb
                ->andWhere("({$alias}.locale = 'fr' AND {$alias}.status = :status_published AND {$alias}.slug = :slug)")
                ->setParameter('status_published', NewsArticleTranslation::STATUS_PUBLISHED)
                ->setParameter('slug', $slug)
            ;

            if ($locale != 'fr') {
                $aliasTrans = substr($alias, 0, -1);
                $qb
                    ->leftJoin("{$aliasTrans}.translations", "{$aliasTrans}z1")
                    ->andWhere("({$aliasTrans}z1.locale = :locale AND {$aliasTrans}z1.status = :status_translated AND {$aliasTrans}z1.slug = :slug)")
                    ->setParameter('locale', $locale)
                    ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ;
            }
        } else {
            $qb
                ->andWhere("({$alias}.locale = 'fr' AND {$alias}.status = :status_published)")
                ->setParameter('status_published', NewsArticleTranslation::STATUS_PUBLISHED)
            ;

            if ($media == 'MediaAudio') {
            //    $this->addAWSAudioEncodersQueries($qb, $alias);
            } else if ($media == 'MediaVideo') {
            //    $this->addAWSVideoEncodersQueries($qb, $alias);
            }

            if ($locale != 'fr') {
                $aliasTrans = substr($alias, 0, -1);
                $qb
                    ->leftJoin("{$aliasTrans}.translations", "{$aliasTrans}z2")
                    ->andWhere("({$aliasTrans}z2.locale = :locale AND {$aliasTrans}z2.status = :status_translated)")
                    ->setParameter('locale', $locale)
                    ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                ;
            }
        }


        return $qb;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $alias
     * @return QueryBuilder
     */
    public function addAWSVideoEncodersQueries(QueryBuilder $qb, $alias)
    {
        $qb->andWhere("$alias.jobWebmState = :job_state")
            ->andWhere("$alias.jobMp4State = :job_state")
            ->setParameter('job_state', MediaVideoTranslation::ENCODING_STATE_READY)
            ->andWhere("$alias.webmUrl IS NOT NULL")
            ->andWhere("$alias.mp4Url IS NOT NULL")
        ;
        return $qb;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $alias
     * @return QueryBuilder
     */
    public function addAWSAudioEncodersQueries(QueryBuilder $qb, $alias)
    {
        $qb->andWhere("$alias.jobMp3State = :job_state")
            ->setParameter('job_state', MediaAudioTranslation::ENCODING_STATE_READY)
            ->andWhere("$alias.mp3Url IS NOT NULL")
        ;
        return $qb;
    }

    /**
     * @param QueryBuilder $qb
     * @param $aliasMain
     * @param $aliasTranslation
     * @return QueryBuilder
     */
    public function addImageQueries(QueryBuilder $qb, $aliasMain, $aliasTranslation)
    {
        $qb
            ->andWhere("($aliasMain.image IS NOT NULL OR $aliasTranslation.imageAmazonUrl IS NOT NULL)")
        ;
        return $qb;
    }


}