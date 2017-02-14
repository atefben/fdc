<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContactTranslation;

class MdfConferenceInfoAndContactTranslationRepository extends EntityRepository
{
    public function getConferenceInfoAndContactPageByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('ict');
        $qb
            ->where('ict.locale = :locale')
            ->andWhere('ict.status = :publish or ict.status = :translate')
            ->innerJoin('ict.translatable', 'ic')
            ->andWhere('ic.type = :slug')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
            ->setParameter('publish',MdfConferenceInfoAndContactTranslation::STATUS_PUBLISHED)
            ->setParameter('translate',MdfConferenceInfoAndContactTranslation::STATUS_TRANSLATED)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('cict')
            ->join('cict.translatable', 'cic')
            ->where('cict.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'image') {
            $qb
                ->join('cic.conferenceInfoAndContactWidgets', 'cicw')
                ->andWhere('cicw.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
