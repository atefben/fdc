<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use Doctrine\ORM\Query\Expr\Join;
use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferenceProgramTranslationRepository extends EntityRepository
{
    public function getConferenceProgramPageByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('cpt');
        $qb
            ->where('cpt.locale = :locale')
            ->innerJoin('cpt.translatable', 'cp')
            ->andWhere('cp.type = :slug')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('cpt')
            ->join('cpt.translatable', 'cp')
            ->where('cpt.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ( $filters['type'] == 'video') {
            $qb
                ->join('cp.contentTemplateConferenceWidgets', 'ctcw')
                ->andWhere('ctcw.id = :id')
                ->setParameter('id', $filters['id'])
            ;
        }

        if ($filters['type'] == 'image') {
            $qb
                ->join('FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetImage', 'cpwi',Join::WITH, 'cp.id = cpwi.conferenceProgram')
                ->andWhere('cpwi.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        if ($filters['type'] == 'gallery') {
            $qb
                ->join('FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery', 'cpwg',Join::WITH, 'cp.id = cpwg.conferenceProgram')
                ->andWhere('cpwg.gallery = :gallery')
                ->setParameter('gallery', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
