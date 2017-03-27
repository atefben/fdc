<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmProsDetailTranslation;

/**
 * Class CcmProsDetailTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmProsDetailTranslationRepository extends EntityRepository
{
    public function getByLocaleAndStatus($locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->orderBy('s.name', 'ASC')
            ->setParameter(':locale', $locale)
        ;

        if ($locale != 'fr') {
            $qb
                ->innerJoin('s.translatable', 't')
                ->join('t.translations', 'tr')
                ->andWhere('s.status = :statusTranslated')
                ->andWhere('tr.status = :publish')
                ->setParameter('publish', CcmProsDetailTranslation::STATUS_PUBLISHED)
                ->setParameter('statusTranslated', CcmProsDetailTranslation::STATUS_TRANSLATED)
            ;

        } else {
            $qb
                ->andWhere('s.status = :publish')
                ->setParameter('publish', CcmProsDetailTranslation::STATUS_PUBLISHED)
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
