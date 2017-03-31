<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfRubriquesCollectionRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfRubriquesCollectionRepository extends EntityRepository
{
    public function getWidgetsDependingOnPostion($infoPageId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.informationPage = :informationPage')
            ->orderBy('s.position', 'ASC')
            ->setParameter(':informationPage', $infoPageId)
        ;

        return $qb->getQuery()->getResult();
    }
}
