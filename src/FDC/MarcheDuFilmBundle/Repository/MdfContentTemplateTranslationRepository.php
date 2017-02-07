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
            ->andWhere('ct.publishEndedAt >= :today OR ct.publishEndedAt IS NULL')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setParameter('today', new \DateTime())
            ->setMaxResults(3)
            ->orderBy('ct.publishedAt', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getNewsByLocaleAndType($locale, $type, $filters)
    {
        $qb = $this->createQueryBuilder('ctt')
            ->select('ctt, ct')
            ->join('ctt.translatable', 'ct')
            ->join('ct.theme', 't')
            ->join('t.translations', 'tt')
            ->where('ctt.locale = :locale')
            ->andWhere('tt.locale = :locale')
            ->andWhere('ct.type = :type')
            ->andWhere('tt.slug IN (:filters)')
            ->andWhere('ct.publishedAt <= :today')
            ->andWhere('ct.publishEndedAt >= :today  OR ct.publishEndedAt IS NULL')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setParameter('filters', $filters)
            ->setParameter('today', new \DateTime())
            ->orderBy('ct.publishedAt', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getConferenceNewsByLocaleAndType($locale, $type, $conference, $offset)
    {
        $qb = $this->createQueryBuilder('ctt')
            ->select('ctt, ct')
            ->join('ctt.translatable', 'ct')
            ->join('ct.theme', 't')
            ->join('t.translations', 'tt')
            ->where('ctt.locale = :locale')
            ->andWhere('tt.locale = :locale')
            ->andWhere('ct.type = :type')
            ->andWhere('tt.slug IN (:conference)')
            ->andWhere('ct.publishedAt <= :today')
            ->andWhere('ct.publishEndedAt >= :today  OR ct.publishEndedAt IS NULL')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setParameter('conference', $conference)
            ->setParameter('today', new \DateTime())
            ->orderBy('ct.publishedAt', 'DESC')
            ->setMaxResults(9)
        ;

        if ($offset) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }

    public function getAllNewsByLocaleAndType($locale, $type)
    {
        $qb = $this->createQueryBuilder('ctt')
            ->select('ctt, ct')
            ->join('ctt.translatable', 'ct')
            ->where('ctt.locale = :locale')
            ->andWhere('ct.type = :type')
            ->andWhere('ct.publishedAt <= :today')
            ->andWhere('ct.publishEndedAt >= :today  OR ct.publishEndedAt IS NULL')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setParameter('today', new \DateTime())
            ->orderBy('ct.publishedAt', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function countAllNewsByLocaleAndType($locale, $type)
    {
        $qb = $this->createQueryBuilder('ctt')
            ->select('COUNT(ctt)')
            ->join('ctt.translatable', 'ct')
            ->where('ctt.locale = :locale')
            ->andWhere('ct.type = :type')
            ->andWhere('ct.publishedAt <= :today')
            ->andWhere('ct.publishEndedAt >= :today  OR ct.publishEndedAt IS NULL')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setParameter('today', new \DateTime())
            ->orderBy('ct.publishedAt', 'DESC')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function countNewsByLocaleAndType($locale, $type, $filters)
    {
        $qb = $this->createQueryBuilder('ctt')
            ->select('COUNT(ctt)')
            ->join('ctt.translatable', 'ct')
            ->join('ct.theme', 't')
            ->join('t.translations', 'tt')
            ->where('ctt.locale = :locale')
            ->andWhere('tt.locale = :locale')
            ->andWhere('ct.type = :type')
            ->andWhere('tt.slug IN (:filters)')
            ->andWhere('ct.publishedAt <= :today')
            ->andWhere('ct.publishEndedAt >= :today OR ct.publishEndedAt IS NULL')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setParameter('filters', $filters)
            ->setParameter('today', new \DateTime())
            ->orderBy('ct.publishedAt', 'DESC')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
    
    /**
     * Get by MdfContentTemplateWidget
     * 
     * @param string $locale
     * @param array $filters
     * 
     * @return array
     */
    public function getByWidget($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('ctt')
            ->join('ctt.translatable', 'ct')
            ->join('ct.contentTemplateWidgets', 'cttw')
            ->where('ctt.locale = :locale')
            ->andWhere('cttw.id = :id')
//            ->andWhere('cttw.type = :type')
            ->setParameter('id', $filters['id'])
//            ->setParameter('type', $filters['type'])
            ->setParameter('locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
