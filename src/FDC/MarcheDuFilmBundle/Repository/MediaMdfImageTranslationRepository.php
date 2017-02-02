<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Entity\GalleryMdf;
use FDC\MarcheDuFilmBundle\Entity\GalleryMdfMedia;

use FDC\MarcheDuFilmBundle\Entity\MediaMdfImageTranslation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * MediaMdfImageTranslationRepository class.
 *
 * \@extends EntityRepository
 */
class MediaMdfImageTranslationRepository extends EntityRepository
{

    /**
     * Find Gallery Images
     *
     * @param $locale
     * @param $id
     * @return \Doctrine\ORM\Query
     */
    public function getGalleryImage($id, $locale)
    {
        $qb = $this->createQueryBuilder('mit')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\MediaMdfImage', 'mi', 'WITH', 'mit.translatable = mi.id')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\GalleryMdfMedia', 'gm', 'WITH', 'mi.id = gm.media ')
            ->leftjoin('FDC\MarcheDuFilmBundle\Entity\GalleryMdf', 'g', 'WITH', 'gm.gallery = g.id')

            ->where('(mit.locale = :locale)')
            ->andWhere('(g.id = :id)');


        $qb = $qb
            ->setParameter('id', $id)
            ->setParameter('locale', $locale)

            ->getQuery()
            ->getResult();

        return $qb;
    }

}