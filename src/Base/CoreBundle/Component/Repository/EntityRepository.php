<?php

namespace Base\CoreBundle\Component\Repository;

use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use \DateTime;

use Doctrine\ORM\EntityRepository as BaseRepository;
use Doctrine\ORM\QueryBuilder;

class EntityRepository extends BaseRepository
{
    /**
     * @param $qb
     * @param $alias
     * @return QueryBuilder
     */
    public function addFDCEventQueries($qb, $alias)
    {
        $qb = $qb
            ->andWhere("{$alias}.slug = 'site-evenementiel'")
        ;

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
            ->andWhere("{$alias}.slug = 'site-press'")
        ;

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
     * @return QueryBuilder
     */
    public function addMasterQueries($qb, $alias, $festival)
    {
        $qb = $qb
            ->andWhere("{$alias}.festival = :festival")
            ->andWhere("({$alias}.publishedAt IS NULL OR {$alias}.publishedAt <= :datetime)")
            ->andWhere("({$alias}.publishEndedAt IS NULL OR {$alias}.publishEndedAt >= :datetime)")

            ->setParameter('festival', $festival)
            ->setParameter('datetime', new DateTime());

        return $qb;
    }

    /**
     * @param $qb
     * @param $alias
     * @param $locale
     * @param null $slug
     * @return QueryBuilder
     */
    public function addTranslationQueries($qb, $alias, $locale, $slug = null)
    {
        if ($slug !== null) {
            $qb = $qb
                ->andWhere("({$alias}.locale = 'fr' AND {$alias}.status = :status_published)")
                ->setParameter('status_published', NewsArticleTranslation::STATUS_PUBLISHED)
                ->setParameter('slug', $slug);

            if ($locale != 'fr') {
                $aliasTrans = substr($alias, 0, -1);
                $qb = $qb
                    ->leftJoin("{$aliasTrans}.translations", 'z2')
                    ->andWhere("(z2.locale = :locale AND z2.status = :status_translated AND z2.slug = :slug)")
                    ->setParameter('locale', $locale)
                    ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED)
                    ->setParameter('slug', $slug);
            }
        } else {
            $qb = $qb
                ->andWhere("({$alias}.locale = 'fr' AND {$alias}.status = :status_published)")
                ->setParameter('status_published', NewsArticleTranslation::STATUS_PUBLISHED);

            if ($locale != 'fr') {
                $aliasTrans = substr($alias, 0, -1);
                $qb = $qb
                    ->leftJoin("{$aliasTrans}.translations", 'z2')
                    ->andWhere("(z2.locale = :locale AND z2.status = :status_translated)")
                    ->setParameter('locale', $locale)
                    ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED);
            }
        }


        return $qb;
    }
}