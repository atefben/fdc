<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

/**
 * Class GraphicalCharterRepository
 * @package Base\CoreBundle\Repository
 */
class GraphicalCharterRepository extends TranslationRepository
{

    public function getPage($locale)
    {
        $qb = $this
            ->createQueryBuilder('gc')
            ->innerJoin('gc.translations', 'gct')
            ->andWhere('gc.id = :id')
            ->setParameter(':id', 1)
        ;

        $this->addTranslationQueries($qb, 'gct', $locale);

        return $qb
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
