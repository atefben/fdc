<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmRubriqueQuestionsCollectionRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmRubriqueQuestionsCollectionRepository extends EntityRepository
{
    public function getDependingOnPositionAndRubrique($rubriqueId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.rubrique = :rubrique')
            ->orderBy('s.position', 'ASC')
            ->setParameter(':rubrique', $rubriqueId)
        ;

        return $qb->getQuery()->getResult();
    }
}
