<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

/**
 * Class AmazonRemoteFileRepository
 * @package Base\CoreBundle\Repository
 */
class AmazonRemoteFileRepository extends EntityRepository
{

    /**
     * @param array $ids
     * @return array
     */
    public function getAllByIds(array $ids)
    {
        return $this
            ->_em
            ->createQueryBuilder()
            ->from($this->getClassName(), 'f', 'f.id')
            ->select('f')
            ->andWhere('f.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult()
            ;
    }
}
