<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class PressCoverageWidgetTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Entity
 */
class PressCoverageWidgetTranslationRepository extends EntityRepository
{
    public function getSortedPressCoverageWidgets($locale, $offset)
    {
        $qb = $this->createQueryBuilder('pc');
        $qb
            ->where('pc.locale = :locale')
            ->innerJoin('pc.translatable', 'pct')
            ->orderBy('pct.publishedAt', 'DESC')
            ->setParameter(':locale', $locale)
            ->setMaxResults(9)
        ;
        
        if ($offset) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }
}
