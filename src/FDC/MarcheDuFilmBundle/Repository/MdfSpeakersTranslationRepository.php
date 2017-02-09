<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\Service;

/**
 * Class ServiceRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfSpeakersTranslationRepository extends EntityRepository
{
    
    public function getSpeakersPageByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->innerJoin('s.translatable', 't')
            ->andWhere('t.type = :slug')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getByMedia($locale, $filters)
    {
        $qb = $this
            ->createQueryBuilder('st')
            ->join('st.translatable', 's')
            ->where('st.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if ($filters['type'] == 'image') {
            $qb
                ->join('s.speakersChoicesCollections', 'scc')
                ->join('scc.speakersChoice', 'sc')
                ->join('sc.speakersDetailsCollections', 'sdc')
                ->join('sdc.speakersDetails', 'sd')
                ->andWhere('sd.image = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
