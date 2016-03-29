<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

class MediaImageRepository extends EntityRepository
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
    public function getNewsApiImages($festival, $locale, \DateTime $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('mi')
            ->join('mi.translations', 't')
        ;

        $morning = clone $dateTime;
        $morning->setTime(0, 0, 0);


        $midnight = clone $dateTime;
        $midnight->setTime(23, 59, 59);

        $qb
            ->andWhere('mi.publishedAt BETWEEN :morning AND :midnight')
            ->andWhere('mi.publishedAt <= :datetime')
            ->andWhere('(mi.publishEndedAt IS NULL OR mi.publishEndedAt >= :datetime)')
            ->setParameter('datetime', $dateTime)
            ->setParameter('morning', $morning)
            ->setParameter('midnight', $midnight)
        ;

        $this->addMasterQueries($qb, 'mi', $festival);
        $this->addTranslationQueries($qb, 't', $locale, null, true);
        return $qb->getQuery()->getResult();
    }
}