<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageWaiting;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * Class FDCEventRoutesRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageWaitingRepository extends EntityRepository
{

    /**
     * @param $route
     * @return FDCPageWaiting|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getSingleWaitingPageByRoute($route)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.page', 'pp')
            ->andWhere('p.enabled = :enabled')
            ->andWhere('pp.route = :route')
            ->setParameter('enabled', true)
            ->setParameter('route', $route)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

}
