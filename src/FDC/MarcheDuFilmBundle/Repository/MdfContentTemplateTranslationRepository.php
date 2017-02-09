<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use Doctrine\ORM\Query\Expr\Join;
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
        ;

        if ($filters['type'] == 'video') {
            $qb
                ->join('ct.contentTemplateWidgets', 'cttw')
                ->andWhere('cttw.id = :id')
                ->setParameter('id', $filters['id'])
                ;
        }

        if ($filters['type'] == 'image') {
            $qb
                ->join('FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetImage', 'cttwi',Join::WITH, 'ct.id = cttwi.contentTemplate')
                ->join('cttwi.image', 'cttwii')
                ->andWhere('cttwii.id = :id')
                ->setParameter('id', $filters['id'])
            ;
        }

        if ($filters['type'] == 'gallery') {
            $qb
                ->join('FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery', 'cttwg',Join::WITH, 'ct.id = cttwg.contentTemplate')
                ->andWhere('cttwg.gallery = :gallery')
                ->setParameter('gallery', $filters['id'])
            ;
        }

        $qb
            ->andwhere('ctt.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        return $qb->getQuery()->getResult();
    }
}
