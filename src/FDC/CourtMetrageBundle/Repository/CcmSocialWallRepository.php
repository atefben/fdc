<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class CcmSocialWallRepository extends EntityRepository
{
    public function getIdsByNetwork($network, $count)
    {
        $results = $this->createQueryBuilder('f')
                        ->select('f.id')
                        ->where('f.network = :network')
                        ->setParameter('network', $network)
                        ->orderBy('f.createdAt', 'DESC')
                        ->setMaxResults($count)
                        ->getQuery()
                        ->getScalarResult();
        ;
        $results = array_map('current', $results);

        return $results;
    }
}
