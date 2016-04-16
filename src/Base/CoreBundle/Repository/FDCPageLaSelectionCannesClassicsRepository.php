<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsTranslation;

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
            ->join('cc.translations', 't')
        ;
        $this->addTranslationQueries($qb, 't', $locale);
        return $qb->getQuery()->getResult();

    }

    public function getBySlug($locale, $slug)
    {
        $qb = $this
            ->createQueryBuilder('cc')
            ->join('cc.translations', 't')
            ->where('t.slug = :slug')
            ->andWhere('t.status = :status_published AND t.locale = :locale_fr')
            ->setParameter('locale_fr', 'fr')
            ->setParameter('slug', $slug)
            ->setParameter('status_published', FDCPageLaSelectionCannesClassicsTranslation::STATUS_PUBLISHED);

        if ($locale != 'fr') {
            $qb
                ->join('cc.translations', 't2')
                ->andWhere('t2.status = :status_translated AND t2.locale = :locale')
                ->setParameter('status_translated', FDCPageLaSelectionCannesClassicsTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale);
        }

        return $qb
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getAll($locale)
    {
        $qb = $this
            ->createQueryBuilder('cc')
            ->join('cc.translations', 't')
            ->where('t.status = :status_published AND t.locale = :locale_fr')
            ->setParameter('status_published', FDCPageLaSelectionCannesClassicsTranslation::STATUS_PUBLISHED)
            ->setParameter('locale_fr', 'fr');
        if ($locale != 'fr') {
            $qb
                ->join('cc.translations', 't2')
                ->andWhere('t2.status = :status_translated AND t2.locale = :locale')
                ->setParameter('status_translated', FDCPageLaSelectionCannesClassicsTranslation::STATUS_TRANSLATED)
                ->setParameter('locale', $locale);
        }

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

}
