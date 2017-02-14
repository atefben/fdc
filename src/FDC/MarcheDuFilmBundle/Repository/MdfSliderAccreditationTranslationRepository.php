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

    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('sat')
            ->join('sat.translatable', 'sa')
            ->where('sat.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'image') {
            $qb
                ->andWhere('sa.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }

}
