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
            ->where('s.locale = :locale')
            ->setParameter('published',CcmParticiperPageTranslation::STATUS_PUBLISHED)
            ->join('s.translatable', 't')
            ->setParameter(':locale', $locale)
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere('s.status = :translated')
                ->setParameter('translated',CcmParticiperPageTranslation::STATUS_TRANSLATED)
                ->join('t.translations', 'tt')
                ->andWhere('tt.locale = :locale_fr and tt.status = :published')
                ->setParameter(':locale_fr', 'fr')
            ;
        } else {
            $qb
                ->andWhere('s.status = :published')
            ;
        }

        return $qb->getQuery()->getResult();
    }

    public function getPageBySlugAndLocale($slug, $locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.slug = :slug')
            ->join('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter('published',CcmParticiperPageTranslation::STATUS_PUBLISHED)
            ->setParameter(':slug', $slug)
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere('s.status = :translated')
                ->setParameter('translated',CcmParticiperPageTranslation::STATUS_TRANSLATED)
                ->join('t.translations', 'tt')
                ->andWhere('tt.locale = :locale_fr and tt.status = :published')
                ->setParameter(':locale_fr', 'fr')

            ;
        } else {
            $qb
                ->andWhere('s.status = :published')
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
