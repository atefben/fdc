<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmLabelContentFilesWidgetTranslationRepository
 *
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmLabelContentFilesWidgetTranslationRepository extends EntityRepository
{
    public function getFilesWidgetsByLocaleAndWidgetId($locale, $widget)
    {
        $qb = $this->createQueryBuilder('fw');
        $qb
            ->where('fw.locale = :locale')
            ->andWhere('fw.translatable = :widget')
            ->innerJoin('fw.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':widget', $widget)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
