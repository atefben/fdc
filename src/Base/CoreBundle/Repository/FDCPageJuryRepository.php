<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\FDCPageJury;
use Doctrine\ORM\NonUniqueResultException;


/**
 * Class FDCPageJuryRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageJuryRepository extends TranslationRepository
{

    /**
     * @param string $locale
     * @param string $slug
     * @return FDCPageJury|null
     * @throws NonUniqueResultException
     */
    public function getPageBySlug($locale, $slug)
    {
        return $this
            ->createQueryBuilder('p')
            ->join('p.translations', 't')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.slug = :slug')
            ->andWhere('p.image IS NOT NULL')
            ->setParameter('locale', $locale)
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param string $locale
     * @return FDCPageJury[]
     */
    public function getPages($locale)
    {
        return $this
            ->createQueryBuilder('p')
            ->join('p.translations', 't')
            ->andWhere('t.locale = :locale AND t.slug IS NOT NULL AND t.slug <> \'\'')
            ->andWhere('p.image IS NOT NULL')
            ->setParameter('locale', $locale)
            ->orderBy('p.id', 'asc')
            ->getQuery()
            ->getResult()
        ;
    }
}
