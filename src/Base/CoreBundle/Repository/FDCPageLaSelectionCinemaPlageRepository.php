<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelectionCinemaPlageTranslation;

/**
 * Class FDCPageLaSelectionCinmePlageRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageLaSelectionCinemaPlageRepository extends TranslationRepository
{
    public function getBySlug($locale, $slug)
    {
        $qb = $this
            ->createQueryBuilder('cp')
            ->join('cp.translations', 't')
            ->where('cp.slug = :slug')
            ->andWhere('t.status = :status_published AND t.locale = :locale_fr')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('slug', $slug)
            ->setParameter('status_published', FDCPageLaSelectionCinemaPlageTranslation::STATUS_PUBLISHED)
        ;

        if ($locale != 'fr') {
            $qb
                ->join('cp.translations', 't2')
                ->andWhere('t2.status = :status_translated AND t2.locale = :locale')
                ->setParameter('status_translated', FDCPageLaSelectionCinemaPlageTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }
        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }

}
