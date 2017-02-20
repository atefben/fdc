<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class CcmRegisterProcedureTranslationRepository extends EntityRepository
{
    public function findProcedureByLocaleAndId($locale, $id)
    {
        $qb = $this->createQueryBuilder('rpt')
                   ->join('rpt.translatable', 'rp')
                   ->where('rpt.locale = :locale')
                   ->andWhere('rp.id = :id')
                   ->setParameter('locale', $locale)
                   ->setParameter('id', $id)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
