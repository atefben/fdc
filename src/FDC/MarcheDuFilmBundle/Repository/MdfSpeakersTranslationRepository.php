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
    
    public function getSpeakersPageByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->innerJoin('s.translatable', 't')
            ->andWhere('t.type = :slug')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
