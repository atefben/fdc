<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageAward;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class FDCPageAwardRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageAwardRepository extends TranslationRepository
{

    /**
     * @param $locale
     * @param $slug
     * @return FDCPageAward|null
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

    /**
     * @param $locale
     * @param $id
     * @return FDCPageAward|null
     * @throws NonUniqueResultException
     */
    public function getPageById($locale, $id)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.translations', 't')
            ->andWhere('t.locale = :locale')
            ->andWhere('p.id = :id')
            ->andWhere('p.image IS NOT NULL')
            ->setParameter('locale', $locale)
            ->setParameter('id', $id)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getPages($locale)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.translations', 't')
            ->andWhere('t.locale = :locale AND t.slug IS NOT NULL AND t.slug <> \'\'')
            ->setParameter('locale', $locale)
            ->orderBy('p.id', 'asc')
        ;

        return $qb->getQuery()->getResult();
    }
}
