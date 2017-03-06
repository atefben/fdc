<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Entity\HomepageSejourTranslation;
use FDC\CourtMetrageBundle\Entity\HomepageSejour;
use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;

class HomepageSejourTranslationRepository extends EntityRepository
{
    public function findSejourForHomepage($locale)
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->join('t.translatable', 's')
            ->where('t.locale = :locale')
            ->andWhere('s.homepage is not null')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findSejourForShortFilm($locale)
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->join('t.translatable', 's')
            ->where('t.locale = :locale')
            ->andWhere('s.shortFilm is not null')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findSejourForProsPage($locale)
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->join('t.translatable', 's')
            ->where('t.locale = :locale')
            ->andWhere('s.prosPage is not null')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findSejourForProgramPage($locale)
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->join('t.translatable', 's')
            ->where('t.locale = :locale')
            ->andWhere('s.programPage is not null')
            ->setParameter(':locale', $locale)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
