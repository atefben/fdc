<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\AccreditationWidgetTranslation;

/**
 * Class AccreditationTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class AccreditationWidgetTranslationRepository extends EntityRepository
{

    /**
     * @param $locale
     *
     * @return AccreditationWidgetTranslation
     */
    public function getAccreditationWidgetsByLocale($locale)
    {
        $qb = $this->createQueryBuilder('awt')
            ->join('awt.translatable', 'aw')
            ->where('awt.locale = :locale')
            ->setParameter('locale', $locale)
            ->orderBy('aw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
