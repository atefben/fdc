<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\ServiceTranslation;

/**
 * Class ServiceTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class ServiceTranslationRepository extends EntityRepository
{
    public function getServiceByLocaleAndSlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.status = :statusPublished or s.status = :statusTranslated')
            ->andWhere('s.url = :slug')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':slug', $slug)
            ->setParameter(':statusPublished', ServiceTranslation::STATUS_PUBLISHED)
            ->setParameter(':statusTranslated', ServiceTranslation::STATUS_TRANSLATED)
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
                ->join('s.widgetCollections', 'swc')
                ->join('swc.widget', 'sw')
                ->join('sw.productCollections', 'swpc')
                ->join('swpc.product', 'swp')
                ->join('swp.gallery', 'swpg')
                ->join('swpg.medias', 'swpgm')
                ->andWhere('swpgm.media = :image')
                ->setParameter('image', $filters['id'])
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
