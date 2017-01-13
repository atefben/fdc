<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfSpeakersChoicesTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfSpeakersDetailsTranslationRepository extends EntityRepository
{

    public function getSpeakerByLocaleAndSpeakerId($locale, $speakerId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :speakerId')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':speakerId', $speakerId)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
