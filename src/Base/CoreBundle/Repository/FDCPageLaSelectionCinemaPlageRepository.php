<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelectionCinemaPlageTranslation;

/**
 * Class FDCPageLaSelectionCinmePlageRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageLaSelectionCinemaPlageRepository extends EntityRepository
{
    public function getBySlug($locale, $slug)
    {
        $qb = $this
            ->createQueryBuilder('cp')
            ->join('cp.translations', 't')
            ->where('cp.slug = :slug')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.status = :status_published')
            ->setParameter('status_published', FDCPageLaSelectionCinemaPlageTranslation::STATUS_PUBLISHED)
            ->setParameter('slug', $slug)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return $qb;
    }

}
