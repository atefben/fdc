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
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findPageByTypeAndLocale($type, $locale = 'fr')
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

        return $qb->getQuery()->getOneOrNullResult();
    }
}
