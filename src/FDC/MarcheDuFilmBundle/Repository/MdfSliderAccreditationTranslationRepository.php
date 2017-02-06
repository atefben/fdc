<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfSliderAccreditationTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Entity
 */
class MdfSliderAccreditationTranslationRepository extends EntityRepository
{
    public function getLocaleSortedSlidersOnPage($locale, $pageId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->innerJoin('s.translatable', 't')
            ->andWhere('t.sliderAccreditationPage = :page')
            ->orderBy('t.position', 'ASC')
            ->setParameter(':locale', $locale)
            ->setParameter(':page', $pageId)
        ;

        return $qb->getQuery()->getResult();
    }
}
