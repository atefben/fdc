<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfContactSubjectsCollectionRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfContactSubjectsCollectionRepository extends EntityRepository
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
