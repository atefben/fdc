<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfConferencePartnerTranslationRepository extends EntityRepository
{
    public function getConferencePartnerPageByLocaleAndSlug($locale, $slug)
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
            ->createQueryBuilder('cptt')
            ->join('cptt.translatable', 'cp')
            ->where('cptt.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'image') {
            $qb
                ->join('cp.partnerTabCollection', 'cptc')
                ->join('cptc.conferencePartnerTab', 'cpt')
                ->join('cpt.partnerLogoCollection', 'cplc')
                ->join('cplc.conferencePartnerLogo', 'cpl')
                ->andWhere('cpl.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
