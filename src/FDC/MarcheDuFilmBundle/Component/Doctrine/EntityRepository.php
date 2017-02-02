<?php

namespace FDC\MarcheDuFilmBundle\Component\Doctrine;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use DateTime;
use Doctrine\ORM\EntityRepository as BaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

class EntityRepository extends BaseEntityRepository
{


    /**
     * @param $qb
     * @param $alias
     * @param boolean $published
     * @return QueryBuilder
     */
    public function addMasterQueries(QueryBuilder $qb, $alias, $published = true)
    {
        if ($published) {
            $qb = $qb
                ->andWhere("({$alias}.publishedAt IS NULL OR {$alias}.publishedAt <= :datetime)")
                ->andWhere("({$alias}.publishEndedAt IS NULL OR {$alias}.publishEndedAt >= :datetime)")
                ->setParameter(':datetime', new DateTime())
            ;
        }

        return $qb;
    }

    /**
     * @param $qb
     * @param $alias
     * @param $locale
     * @return QueryBuilder
     */
    public function addTranslationQueries(QueryBuilder $qb, $alias, $locale)
    {
        $qb
            ->andWhere("({$alias}.locale = 'fr' AND {$alias}.status = :status_published)")
            ->setParameter('status_published', TranslateChildInterface::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $aliasTrans = substr($alias, 0, -1);
            $qb
                ->leftJoin("{$aliasTrans}.translations", "{$aliasTrans}z2")
                ->andWhere("({$aliasTrans}z2.locale = :locale AND {$aliasTrans}z2.status = :status_translated)")
                ->setParameter('locale', $locale)
                ->setParameter('status_translated', TranslateChildInterface::STATUS_TRANSLATED)
            ;
        }


        return $qb;
    }
}