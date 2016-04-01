<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsTranslation;

/**
 * Class FDCPageJuryTranslationRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageLaSelectionCannesClassicsRepository extends EntityRepository
{
    public function getBySlug($locale, $slug)
    {
        $qb = $this
            ->createQueryBuilder('cc')
            ->join('cc.translations', 't')
            ->where('t.slug = :slug')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.status = :status_published')
            ->setParameter('status_published', FDCPageLaSelectionCannesClassicsTranslation::STATUS_PUBLISHED)
            ->setParameter('slug', $slug)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return $qb;
    }

    public function getAll()
    {
        $qb = $this
            ->createQueryBuilder('cc')
            ->join('cc.translations', 't')
            ->where('t.status = :status_published')
            ->setParameter('status_published', FDCPageLaSelectionCannesClassicsTranslation::STATUS_PUBLISHED)
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

}
