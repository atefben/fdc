<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelection;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class CorpoWhoAreWeRepository
 * @package Base\CoreBundle\Repository
 */
class CorpoWhoAreWeRepository extends TranslationRepository
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
}
