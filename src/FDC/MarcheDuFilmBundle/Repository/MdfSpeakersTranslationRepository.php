<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersTranslation;
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
            ->andWhere('s.status = :statusPublished or s.status = :statusTranslated')
            ->innerJoin('s.translatable', 't')
            ->andWhere('t.type = :slug')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
            ->setParameter(':statusPublished', MdfSpeakersTranslation::STATUS_PUBLISHED)
            ->setParameter(':statusTranslated', MdfSpeakersTranslation::STATUS_TRANSLATED)
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
