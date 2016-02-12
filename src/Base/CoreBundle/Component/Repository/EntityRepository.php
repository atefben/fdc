<?php

namespace Base\CoreBundle\Component\Repository;

use \DateTime;

use Doctrine\ORM\EntityRepository as BaseRepository;

class EntityRepository extends BaseRepository
{
    public function addFDCEventQueries($qb, $alias)
    {
        $qb = $qb
            ->andWhere("{$alias}.slug = 'site-evenementiel'")
        ;

        return $qb;
    }

    public function addMobileQueries($qb, $alias)
    {
        $qb = $qb
            ->andWhere("{$alias}.displayed_mobile = '1'")
        ;

        return $qb;
    }

    public function addMasterQueries($qb, $alias, $festival)
    {
        $qb = $qb
            ->andWhere("{$alias}.festival = :festival")
            ->andWhere("{$alias}.publishedAt IS NULL OR {$alias}.publishedAt <= :datetime)")
            ->andWhere("({$alias}.publishEndedAt IS NULL OR {$alias}.publishEndedAt >= :datetime)')")

            ->setParameter('festival', $festival)
            ->setParameter('datetime', new DateTime());

        return $qb;
    }

    public function addTranslationQueries($qb, $alias, $locale)
    {
        $qb = $qb
            ->andWhere("{$alias}.locale = 'fr' AND {$alias}.status = :status_published")
            ->setParameter('status_translated', NewsArticleTranslation::STATUS_PUBLISHED);

        if ($locale != 'fr') {
           $qb = $qb
               ->andWhere("{$alias}.locale = :locale AND {$alias}.status = :status_translated")
               ->setParameter('status_translated', NewsArticleTranslation::STATUS_TRANSLATED);
        }

        return $qb;
    }
}