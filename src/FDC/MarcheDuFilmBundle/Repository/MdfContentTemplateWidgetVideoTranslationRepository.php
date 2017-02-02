<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfContentTemplateWidgetVideoTranslationRepository extends EntityRepository
{
    public function getConferenceProgramYoutubeWidgetsByLocaleAndPageId($locale, $pageId)
    {
        $qb = $this->createQueryBuilder('ctvwt')
                   ->select('ctvwt, ctvw')
                   ->join('ctvwt.translatable', 'ctvw')
                   ->join('ctvw.conferenceProgram', 'cp')
                   ->where('ctvwt.locale = :locale')
                   ->andWhere('cp.id = :pageId')
                   ->setParameter('locale', $locale)
                   ->setParameter('pageId', $pageId)
                   ->orderBy('ctvw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getYoutubeWidgetsByLocaleAndPageId($locale, $pageId)
    {
        $qb = $this->createQueryBuilder('ctvwt')
            ->select('ctvwt, ctvw')
            ->join('ctvwt.translatable', 'ctvw')
            ->join('ctvw.contentTemplate', 'ct')
            ->where('ctvwt.locale = :locale')
            ->andWhere('ct.id = :pageId')
            ->setParameter('locale', $locale)
            ->setParameter('pageId', $pageId)
            ->orderBy('ctvw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
