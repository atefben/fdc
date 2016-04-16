<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;

use Base\CoreBundle\Entity\MediaImageTranslation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * MediaImageTranslationRepository class.
 *
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class MediaImageTranslationRepository extends EntityRepository
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
            ->leftjoin('Base\CoreBundle\Entity\MediaImage', 'mi', 'WITH', 'mit.translatable = mi.id')
            ->leftjoin('Base\CoreBundle\Entity\GalleryMedia', 'gm', 'WITH', 'mi.id = gm.media ')
            ->leftjoin('Base\CoreBundle\Entity\Gallery', 'g', 'WITH', 'gm.gallery = g.id')

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