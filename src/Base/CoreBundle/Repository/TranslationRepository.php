<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

class TranslationRepository extends EntityRepository
{

    public function dashboardSearch($params, $locales)
    {
        $qb = $this
            ->createQueryBuilder('n')
            ->leftJoin('n.translations', 'nt')
            ->setParameter('status', $params['status'])
            ->setParameter('locales', $locales)
        ;

        $this->addDashboardTranslatorQueries($qb, array('nt'), $params);

        if (isset($params['id']) && !empty($params['id'])) {
            $qb
                ->andWhere('n.id = :id')
                ->setParameter('id', $params['id'])
            ;
        }

        if (isset($params['priorityStatus']) && !empty($params['priorityStatus']) &&
            $params['priorityStatus'] != 'all') {
            $qb
                ->andWhere('
                    (n.priorityStatus = :priorityStatus)
                ')
                ->setParameter('priorityStatus', $params['priorityStatus'])
            ;
        }

        if (!empty($params['sortField']) && !in_array($params['sortField'], array('typeClone', 'publishedAt')) &&
            !empty($params['sortValue'])) {
            $qb->orderBy('n.'. $params['sortField'], $params['sortValue']);
        }

        return $qb->getQuery()->getResult();
    }
}