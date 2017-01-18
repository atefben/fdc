<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferencePartnerTabTranslationRepository extends EntityRepository
{
    public function getPartnerTabByLocaleAndTabId($locale, $tabId)
    {
        $qb = $this->createQueryBuilder('cptt');
        $qb
            ->where('cptt.locale = :locale')
            ->andWhere('cptt.translatable = :tabId')
            ->innerJoin('cptt.translatable', 'cpt')
            ->setParameter(':locale', $locale)
            ->setParameter(':tabId', $tabId)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
