<?php

namespace Base\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * Class FDCEventRoutesRepository
 * @package Base\CoreBundle\Repository
 */
class FDCEventRoutesRepository extends NestedTreeRepository
{

    /**
     * Find if page is displayed by parent id
     *
     * @param $parent_id
     * @return \Doctrine\ORM\Query
     */
    public function getEnabledRouteByParent($parent_id)
    {
        $query = $this->createQueryBuilder('er')
            ->where('er.parent = :parent_id')
            ->andWhere('er.enabled = 1')
            ->orderBy('er.position', 'desc')
            ->setParameter('parent_id', $parent_id)
            ->getQuery()
            ->getArrayResult();

        return $query;
    }

}
