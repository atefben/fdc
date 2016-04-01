<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;

use Base\CoreBundle\Component\Repository\EntityRepository;

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
    public function getImageMedia($locale, $festival)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\MediaImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $qb = $this->addMasterQueries($qb, 'mi', $festival);
        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addFDCEventQueries($qb, 's');
        $qb = $qb
            ->orderBy('mi.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $qb;
    }

    /**
     * Find all displayed images of the day
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function getImageMediaByDay($locale, $festival, $dateTime)
    {

        $dateTime1 = $dateTime->format('Y-m-d') . ' 00:00:00';
        $dateTime2 = $dateTime->format('Y-m-d') . ' 23:59:59';

        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\MediaImage', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('(m.publishedAt >= :datetime) AND (m.publishedAt < :datetime2)')
            ->andWhere('m.displayedHome = 1');

        $qb = $this->addMasterQueries($qb, 'mi', $festival, false);
        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addFDCEventQueries($qb, 's');
        $qb = $qb
            ->setParameter('datetime', $dateTime1)
            ->setParameter('datetime2', $dateTime2);

        $qb = $qb
            ->orderBy('mi.publishedAt', 'DESC')
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
    public function getVideoMedia($locale, $festival)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\MediaVideo', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $this->addMasterQueries($qb, 'mi', $festival);
        $this->addTranslationQueries($qb, 'mit', $locale);
        $this->addFDCEventQueries($qb, 's');
        $this->addAWSVideoEncodersQueries($qb, 'mit');
        $qb
            ->orderBy('mi.publishedAt', 'DESC')
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
    public function getAudioMedia($locale, $festival)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.sites', 's')
            ->leftjoin('Base\CoreBundle\Entity\MediaAudio', 'mi', 'WITH', 'mi.id = m.id')
            ->leftjoin('mi.translations', 'mit')
            ->where('m.festival = :festival')
            ->andWhere('m.displayedAll = 1');

        $qb = $this->addMasterQueries($qb, 'mi', $festival);
        $qb = $this->addTranslationQueries($qb, 'mit', $locale);
        $qb = $this->addFDCEventQueries($qb, 's');
        $qb = $qb
            ->orderBy('mi.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $qb;
    }

}