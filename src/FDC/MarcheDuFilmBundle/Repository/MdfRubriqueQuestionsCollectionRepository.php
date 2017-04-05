<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfRubriqueQuestionsCollectionRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfRubriqueQuestionsCollectionRepository extends EntityRepository
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
