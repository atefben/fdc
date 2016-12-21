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
                   ->andWhere('ct.type <= :type')
                   ->setParameter('locale', $locale)
                   ->setParameter('type', $type)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
