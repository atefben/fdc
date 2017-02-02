<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferenceInfoAndContactWidgetTranslationRepository extends EntityRepository
{
    public function getConferenceInfoAndContactWidgetsByLocaleAndId($locale, $id)
    {
        $qb = $this->createQueryBuilder('icwt');
        $qb
            ->where('icwt.locale = :locale')
            ->innerJoin('icwt.translatable', 'icw')
            ->andWhere('icw.conferenceInfoAndContact = :id')
            ->setParameter(':locale', $locale)
            ->setParameter(':id', $id)
            ->orderBy('icw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
