<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageJury;
use Doctrine\ORM\NonUniqueResultException;


/**
 *
 */
class FDCPageJuryRepository extends EntityRepository
{
    /**
     * @param $locale
     * @param $slug
     * @return FDCPageJury|null
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

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getPages($locale)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.translations', 't')
            ->andWhere('t.locale = :locale AND t.slug IS NOT NULL AND t.slug <> \'\'')
            ->andWhere('p.image IS NOT NULL')
            ->setParameter('locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
