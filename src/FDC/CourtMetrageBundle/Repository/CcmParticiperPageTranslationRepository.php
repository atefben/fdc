<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Entity\CcmParticiperPageTranslation;
use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmParticiperPageTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmParticiperPageTranslationRepository extends EntityRepository
{
    public function getAllPagesByLocale($locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale_fr')
            ->andWhere('s.status = :publish')
            ->setParameter('publish',CcmParticiperPageTranslation::STATUS_PUBLISHED)
            ->join('s.translatable', 't')
            ->setParameter(':locale_fr', 'fr')
        ;
        if ($locale != 'fr') {
            $qb
                ->join('t.translations', 'tt')
                ->andWhere('tt.locale = :locale and tt.status = :translated')
                ->setParameter(':locale', $locale)
                ->setParameter('translated',CcmParticiperPageTranslation::STATUS_TRANSLATED)
            ;
        }

        return $qb->getQuery()->getResult();
    }

    public function getPageBySlugAndLocale($slug, $locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale_fr')
            ->andWhere('s.status = :publish')
            ->join('s.translatable', 't')
            ->setParameter('publish',CcmParticiperPageTranslation::STATUS_PUBLISHED)
            ->setParameter(':locale_fr', 'fr')
            ->setParameter(':slug', $slug)
        ;
        if ($locale != 'fr') {
            $qb
                ->join('t.translations', 'tt')
                ->andWhere('tt.locale = :locale and tt.status = :translated and tt.slug = :slug')
                ->setParameter(':locale', $locale)
                ->setParameter('translated',CcmParticiperPageTranslation::STATUS_TRANSLATED)
            ;
        } else {
            $qb
                ->andWhere('s.slug = :slug')
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
