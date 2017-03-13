<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * Class FDCPageJuryTranslationRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageLaSelectionCannesClassicsRepository extends TranslationRepository
{

    /**
     * @param $festival
     * @return array
     */
    public function getApiList($festival, $locale)
    {
        $qb = $this
            ->createQueryBuilder('cc')
            ->join('cc.translations', 'cct')
        ;
        $this->addTranslationQueries($qb, 'cct', $locale);
        return $qb->getQuery()->getResult();

    }

    public function getBySlug($locale, $slug, $festival)
    {
        $qb = $this
            ->createQueryBuilder('cc')
            ->join('cc.translations', 't')
            ->join('cc.translations', 't3')
            ->andWhere('t3.slug = :slug')
            ->setParameter('slug', $slug)
            ->andWhere('t.status = :status_published')
            ->setParameter('status_published', TranslateChildInterface::STATUS_PUBLISHED)
            ->andWhere('t.locale = :locale_fr')
            ->setParameter('locale_fr', 'fr')
            ->andWhere('cc.festival = :festival')
            ->setParameter(':festival', $festival)
        ;

        if ($locale != 'fr') {
            $qb
                ->join('cc.translations', 't2')
                ->andWhere('t2.status = :status_translated AND t2.locale = :locale')
                ->setParameter('status_translated', TranslateChildInterface::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        return $qb
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getAll($locale, $festival, $position = false)
    {
        $qb = $this
            ->createQueryBuilder('cc')
            ->join('cc.translations', 't')
            ->andWhere('t.status = :status_published')
            ->andWhere('t.locale = :locale_fr')
            ->setParameter('status_published', TranslateChildInterface::STATUS_PUBLISHED)
            ->setParameter('locale_fr', 'fr')
            ->andWhere('cc.festival = :festival')
            ->setParameter(':festival', $festival)
        ;
        if ($locale != 'fr') {
            $qb
                ->join('cc.translations', 't2')
                ->andWhere('t2.status = :status_translated AND t2.locale = :locale')
                ->setParameter('status_translated', TranslateChildInterface::STATUS_TRANSLATED)
                ->setParameter('locale', $locale)
            ;
        }

        if ($position) {
            $qb->orderBy('cc.weight', 'asc');
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

}
