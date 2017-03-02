<?php

namespace FDC\CourtMetrageBundle\Repository;

use Doctrine\ORM\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerTranslation;

/**
 * Class CcmShortFilmCornerRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmShortFilmCornerRepository extends EntityRepository
{
    /**
     * @param $type
     * @param string $locale
     * @param null $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findPageByTypeLocaleAndSlug($type, $locale = 'fr', $slug = null)
    {
        $qb = $this
            ->createQueryBuilder('sfc')
            ->select('sfc')
            ->andWhere('sfc.type = :type')
            ->join('sfc.translations', 't')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.status = :status')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->setMaxResults(1)
        ;
        if ($locale != 'fr') {
            $qb->setParameter('status', CcmShortFilmCornerTranslation::STATUS_TRANSLATED);
        } else {
            $qb->setParameter('status', CcmShortFilmCornerTranslation::STATUS_PUBLISHED);
        }
        if ($slug !== null) {
            $qb
                ->andWhere('t.slug = :slug')
                ->setParameter('slug', $slug)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $type
     * @param string $locale
     * @param bool $limit
     * @return array
     */
    public function getSFCPagesByType($type, $locale = 'fr', $limit = false)
    {
        $qb = $this
            ->createQueryBuilder('sfc')
            ->select('sfc')
            ->andWhere('sfc.type = :type')
            ->join('sfc.translations', 't')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.status = :status')
            ->setParameter('locale', $locale)
            ->setParameter('type', $type)
            ->orderBy('sfc.menuOrder', 'ASC')
        ;
        if ($locale != 'fr') {
            $qb->setParameter('status', CcmShortFilmCornerTranslation::STATUS_TRANSLATED);
        } else {
            $qb->setParameter('status', CcmShortFilmCornerTranslation::STATUS_PUBLISHED);
        }
        if ($limit !== false) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery()->getResult();
    }
}
