<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfContactBlockTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfContactBlockTranslationRepository extends EntityRepository
{
    public function getBlockByLocaleAndTranslatableId($locale, $translatableId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :translatable')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':translatable', $translatableId)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
