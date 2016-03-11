<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelection;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class FDCPageLaSelectionRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageLaSelectionRepository extends EntityRepository
{
    /**
     * @param $locale
     * @param $slug
     * @return FDCPageLaSelection
     * @throws NonUniqueResultException
     */
    public function getPageBySlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.translations', 't')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.slug = :slug')
            ->andWhere('p.image IS NOT NULL')
            ->setParameter('locale', $locale)
            ->setParameter('slug', $slug)
        ;

        $output = $qb->getQuery()->getOneOrNullResult();

        if (!$output) {
            $qb = $this->createQueryBuilder('p');

            $qb
                ->join('p.selectionSection', 's')
                ->join('s.translations', 't')
                ->andWhere('t.locale = :locale')
                ->andWhere('t.slug = :slug')
                ->setParameter('locale', $locale)
                ->setParameter('slug', $slug)
            ;

            return $qb->getQuery()->getOneOrNullResult();
        }

        return $output;
    }

    public function getPagesOrdoredBySelectionSectionOrder($locale)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.translations', 't')
            ->join('p.selectionSection', 's')
            ->join('s.translations', 'st')
            ->andWhere('((t.locale = :locale AND t.slug IS NOT NULL AND t.slug <> \'\') OR (st.locale = :locale AND st.slug IS NOT NULL AND st.slug <> \'\'))')
            ->andWhere('p.image IS NOT NULL')
            ->setParameter('locale', $locale)
            ->orderBy('s.position', 'asc')
        ;

        return $qb->getQuery()->getResult();
    }
}
