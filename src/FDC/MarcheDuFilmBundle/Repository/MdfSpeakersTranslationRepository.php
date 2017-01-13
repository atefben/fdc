<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\Service;

/**
 * Class ServiceRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfSpeakersTranslationRepository extends EntityRepository
{
    
    public function getSpeakersPageByLocaleAndTheme($locale, $theme)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->innerJoin('s.translatable', 't')
            ->andWhere('t.theme = :theme')
            ->setParameter(':locale', $locale)
            ->setParameter(':theme', $theme)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
