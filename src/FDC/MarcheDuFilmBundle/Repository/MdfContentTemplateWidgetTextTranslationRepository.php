<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfContentTemplateWidgetTextTranslationRepository extends EntityRepository
{
    public function getTextWidgetsByLocaleAndPageType($locale, $type)
    {
        $qb = $this->createQueryBuilder('cttwt')
                   ->select('cttwt, cttw')
                   ->join('cttwt.translatable', 'cttw')
                   ->join('cttw.contentTemplate', 'ct')
                   ->where('cttwt.locale = :locale')
                   ->andWhere('ct.type = :type')
                   ->setParameter('locale', $locale)
                   ->setParameter('type', $type)
                   ->orderBy('cttw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getConferenceProgramTextWidgetsByLocaleAndPageId($locale, $pageId)
    {
        $qb = $this->createQueryBuilder('cttwt')
                   ->select('cttwt, cttw')
                   ->join('cttwt.translatable', 'cttw')
                   ->join('cttw.conferenceProgram', 'cp')
                   ->where('cttwt.locale = :locale')
                   ->andWhere('cp.id = :pageId')
                   ->setParameter('locale', $locale)
                   ->setParameter('pageId', $pageId)
                   ->orderBy('cttw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getTextWidgetsByLocaleAndPageId($locale, $pageId)
    {
        $qb = $this->createQueryBuilder('cttwt')
            ->select('cttwt, cttw')
            ->join('cttwt.translatable', 'cttw')
            ->join('cttw.contentTemplate', 'ct')
            ->where('cttwt.locale = :locale')
            ->andWhere('ct.id = :pageId')
            ->setParameter('locale', $locale)
            ->setParameter('pageId', $pageId)
            ->orderBy('cttw.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}
