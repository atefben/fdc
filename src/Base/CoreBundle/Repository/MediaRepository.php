<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\Media;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Doctrine\ORM\EntityRepository;


/**
 * MediaRepository class.
 *
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class MediaRepository extends EntityRepository
{

    /**
     * Find all displayed images
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function getImageMedia($locale,$festival,$dateTime)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\MediaImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')

            ->where('m.festival = :festival')
            ->andWhere('s.slug = :site_slug')
            ->andWhere('(m.publishedAt IS NULL OR m.publishedAt <= :datetime) AND (m.publishEndedAt IS NULL OR m.publishEndedAt >= :datetime)')
            ->andWhere('(mit.locale = :locale AND mit.status = :status)');

        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(mit.locale = :locale AND mit.status = :status)'
                )
                ->setParameter('status', MediaImageTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(mit.locale = :locale AND mit.status = :status)'
                )
                ->setParameter('status', MediaImageTranslation::STATUS_PUBLISHED);
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')

            ->getQuery()
            ->getResult();

        return $qb;
    }

    /**
     * Find all displayed video
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function getVideoMedia($locale,$festival,$dateTime)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\MediaVideo', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')

            ->where('m.festival = :festival')
            ->andWhere('s.slug = :site_slug')
            ->andWhere('(m.publishedAt IS NULL OR m.publishedAt <= :datetime) AND (m.publishEndedAt IS NULL OR m.publishEndedAt >= :datetime)')
            ->andWhere('(mit.locale = :locale AND mit.status = :status)');

        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(mit.locale = :locale AND mit.status = :status)'
                )
                ->setParameter('status', MediaVideoTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(mit.locale = :locale AND mit.status = :status)'
                )
                ->setParameter('status', MediaVideoTranslation::STATUS_PUBLISHED);
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')

            ->getQuery()
            ->getResult();

        return $qb;
    }

    /**
     * Find all displayed audio
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function getAudioMedia($locale,$festival,$dateTime)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\MediaAudio', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')

            ->where('m.festival = :festival')
            ->andWhere('s.slug = :site_slug')
            ->andWhere('(m.publishedAt IS NULL OR m.publishedAt <= :datetime) AND (m.publishEndedAt IS NULL OR m.publishEndedAt >= :datetime)')
            ->andWhere('(mit.locale = :locale AND mit.status = :status)');

        if($locale != 'fr') {
            $qb = $qb
                ->andWhere(
                    '(mit.locale = :locale AND mit.status = :status)'
                )
                ->setParameter('status', MediaAudioTranslation::STATUS_TRANSLATED);
        } else {
            $qb = $qb
                ->andWhere(
                    '(mit.locale = :locale AND mit.status = :status)'
                )
                ->setParameter('status', MediaAudioTranslation::STATUS_PUBLISHED);
        }

        $qb = $qb
            ->setParameter('festival', $festival)
            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
            ->setParameter('site_slug', 'site-evenementiel')

            ->getQuery()
            ->getResult();

        return $qb;
    }
}