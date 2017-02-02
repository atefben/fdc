<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfSpeakersChoicesTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfSpeakersChoicesTranslationRepository extends EntityRepository
{

    public function getSpeakersChoiceWidgetByLocaleAndWidgetId($locale, $widget)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :widget')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':widget', $widget)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
