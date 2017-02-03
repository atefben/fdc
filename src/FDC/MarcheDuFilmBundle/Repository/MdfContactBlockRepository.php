<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfContactBlockRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfContactBlockRepository extends EntityRepository
{
    public function getWidgetsDependingOnPostion($contactPageId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.contactPage = :contactPage')
            ->orderBy('s.position', 'ASC')
            ->setParameter(':contactPage', $contactPageId)
        ;

        return $qb->getQuery()->getResult();
    }
}
