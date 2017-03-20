<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmLabelFileTranslationRepository
 *
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmLabelFileTranslationRepository extends EntityRepository
{
    public function getLabelFileByLocaleAndLabelFileId($locale, $labelFileId)
    {
        $qb = $this->createQueryBuilder('lft');
        $qb
            ->where('lft.locale = :locale')
            ->andWhere('lft.translatable = :labelFileId')
            ->innerJoin('lft.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':labelFileId', $labelFileId)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
