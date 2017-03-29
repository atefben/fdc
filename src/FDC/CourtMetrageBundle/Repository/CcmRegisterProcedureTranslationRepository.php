<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Entity\CcmRegisterProcedureTranslation;
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

        if ($locale != 'fr') {
            $qb
                ->join('rp.translations', 'tr')
                ->andWhere('rpt.status = :statusTranslated')
                ->andWhere('tr.status = :publish')
                ->setParameter('publish',CcmRegisterProcedureTranslation::STATUS_PUBLISHED)
                ->setParameter('statusTranslated', CcmRegisterProcedureTranslation::STATUS_TRANSLATED)
            ;

        } else {
            $qb
                ->andWhere('rpt.status = :publish')
                ->setParameter('publish',CcmRegisterProcedureTranslation::STATUS_PUBLISHED)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
