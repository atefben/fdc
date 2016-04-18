<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

class FDCPageWebTvTrailersTranslationRepository extends EntityRepository
{
    public function getByParentSelectionSectionSlug($locale, $slug) {
        $qb = $this->createQueryBuilder('t');

        $qb
            ->join('t.translatable', 'p')
            ->join('p.selectionSection', 's')
            ->join('s.translations', 'st')
            ->andWhere('t.locale = :locale')
            ->andWhere('st.locale = :locale')
            ->andWhere('st.slug = :slug')
            ->setParameter('locale', $locale)
            ->setParameter('slug', $slug)
        ;
        return $qb->getQuery()->getOneOrNullResult();
    }
}