<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

class MdfProgramSpeakersTranslationRepository extends EntityRepository
{
    public function getSpeakerByLocaleAndSpeakerId($locale, $speakerId)
    {
        $qb = $this->createQueryBuilder('pst');
        $qb
            ->where('pst.locale = :locale')
            ->innerJoin('pst.translatable', 'ps')
            ->andWhere('ps.id = :speakerId')
            ->setParameter(':locale', $locale)
            ->setParameter(':speakerId', $speakerId)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
