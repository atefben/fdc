<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\GraphicalCharterSection;

/**
 * Class GraphicalCharterSectionRepository
 * @package Base\CoreBundle\Repository
 */
class GraphicalCharterSectionRepository extends TranslationRepository
{
    /**
     * @param $locale
     * @return GraphicalCharterSection[]
     */
    public function getAvailables($locale)
    {
        $qb = $this
            ->createQueryBuilder('gcs')
            ->innerJoin('gcs.graphicalCharters', 'gcp')
            ->innerJoin('gcp.graphicalCharter', 'gc')
            ->innerJoin('gcs.translations', 'gcst')
            ->andWhere('gc.id = :id')
            ->setParameter(':id', 1)
        ;

        $this->addTranslationQueries($qb, 'gcst', $locale);

        return $qb
            ->addOrderBy('gcp.position', 'asc')
            ->getQuery()
            ->getResult()
            ;
    }
}