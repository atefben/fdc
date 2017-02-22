<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmFooterContentTranslation;

/**
 * Class CcmFooterContentTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmFooterContentTranslationRepository extends EntityRepository
{
    public function getPageByTypeAndLocale($type, $locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->join('s.translatable', 't', 'WITH', 't.type = :type')
            ->andWhere('s.status = :statusPublished or s.status = :statusTranslated')
            ->setParameter('statusPublished',CcmFooterContentTranslation::STATUS_PUBLISHED)
            ->setParameter('statusTranslated',CcmFooterContentTranslation::STATUS_TRANSLATED)
            ->setParameter(':locale', $locale)
            ->setParameter(':type', $type)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
