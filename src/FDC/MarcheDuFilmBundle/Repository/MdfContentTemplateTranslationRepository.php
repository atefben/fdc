<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfContentTemplateTranslationRepository
 *
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfContentTemplateTranslationRepository extends EntityRepository
{
    public function getTitleHeaderByLocaleAndType($locale, $type)
    {
        $qb = $this->createQueryBuilder('ctt')
                   ->join('ctt.translatable', 'ct')
                   ->where('ctt.locale = :locale')
                   ->andWhere('ct.type = :type')
                   ->setParameter('locale', $locale)
                   ->setParameter('type', $type)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getTitleHeaderByLocaleAndTypeAndSlug($locale, $type, $slug)
    {
        $qb = $this->createQueryBuilder('ctt')
            ->join('ctt.translatable', 'ct')
            ->where('ctt.locale = :locale')
            ->andWhere('ctt.slug = :slug')
            ->andWhere('ct.type = :type')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setParameter('slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getHomepageNewsByLocaleAndType($locale, $type)
    {
        $qb = $this->createQueryBuilder('ctt')
            ->select('ctt, ct')
            ->join('ctt.translatable', 'ct')
            ->where('ctt.locale = :locale')
            ->andWhere('ct.type = :type')
            ->andWhere('ct.publishedAt <= :today')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setParameter('today', new \DateTime())
            ->setMaxResults(3)
            ->orderBy('ct.publishedAt', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }
}
