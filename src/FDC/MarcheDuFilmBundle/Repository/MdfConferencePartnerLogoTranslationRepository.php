<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferencePartnerLogoTranslationRepository extends EntityRepository
{
    public function getLogoByLocaleAndLogoId($locale, $logoId)
    {
        $qb = $this->createQueryBuilder('cplt');
        $qb
            ->where('cplt.locale = :locale')
            ->andWhere('cplt.translatable = :logoId')
            ->innerJoin('cplt.translatable', 'cpl')
            ->setParameter(':locale', $locale)
            ->setParameter(':logoId', $logoId)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
