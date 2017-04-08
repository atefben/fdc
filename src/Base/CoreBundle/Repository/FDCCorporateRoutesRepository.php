<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * Class FDCCorporateRoutesRepository
 * @package Base\CoreBundle\Repository
 */
class FDCCorporateRoutesRepository extends NestedTreeRepository
{

    /**
     * @param $parent_id
     * @return array
     */
    public function getEnabledRouteByParent($parent_id)
    {
        return $this->createQueryBuilder('er')
            ->where('er.parent = :parent_id')
            ->andWhere('er.enabled = 1')
            ->orderBy('er.position', 'desc')
            ->setParameter('parent_id', $parent_id)
            ->getQuery()
            ->getArrayResult();
    }

}
