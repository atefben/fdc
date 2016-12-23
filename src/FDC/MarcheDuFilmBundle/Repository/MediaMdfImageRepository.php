<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Repository\TranslationRepository;

class MediaMdfImageRepository extends TranslationRepository
{
    /**
     * @param $festival
     * @param $locale
     * @return array
     */
    public function getApiTodayImages($festival, $locale)
    {
        $qb = $this
            ->createQueryBuilder('mi')
            ->join('mi.translations', 't')
        ;

        $this->addMasterQueries($qb, 'mi', $festival, true);
        $this->addTranslationQueries($qb, 't', $locale, null, true);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $festival
     * @param $locale
     * @param \DateTime $dateTime
     * @return array
     */
    public function getNewsApiImages($locale, FilmFestival $festival, \DateTime $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('mi')
            ->join('mi.translations', 'mit')
            ->andWhere('mi.festival = :festival')
            ->setParameter('festival', $festival)
        ;

        $festivalEndsAt = new \DateTime('2016-05-23 00:00:00');

        if ($festival->getFestivalStartsAt() >= $dateTime) {
            $this->addMasterQueries($qb, 'mi', $festival, true);
            $qb
                ->andWhere(':festivalStartAt  >= mi.publishedAt')
                ->setParameter('festivalStartAt', $festival->getFestivalStartsAt())
            ;
        } else if ($festivalEndsAt < $dateTime) {
            $this->addMasterQueries($qb, 'mi', $festival, true);
            $qb
                ->andWhere(':festivalEndAt < mi.publishedAt')
                //->setParameter('festivalEndAt', $festival->getFestivalEndsAt())
                ->setParameter('festivalEndAt', $festivalEndsAt->format('Y-m-d H:i:s'));
            ;
        } else {
            $morning = clone $dateTime;
            $morning->setTime(0, 0, 0);
            $midnight = clone $dateTime;
            $midnight->setTime(23, 59, 59);

            $qb
                ->andWhere('mi.publishedAt BETWEEN :morning AND :midnight')
                ->setParameter('morning', $morning)
                ->setParameter('midnight', $midnight)
            ;
            $this->addMasterQueries($qb, 'mi', $festival, true);
        }

        $qb
            ->andWhere('mi.displayedMobile = :displayedMobile')
            ->andWhere('mi.displayedHome = :displayedHome')
            ->setParameter('displayedMobile', true)
            ->setParameter('displayedHome', true)
            ;

        $this->addTranslationQueries($qb, 'mit', $locale, null, true);
        return $qb->getQuery()->getResult();
    }
}