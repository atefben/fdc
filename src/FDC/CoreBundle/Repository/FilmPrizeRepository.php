<?php

namespace FDC\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FilmPrizeRepository extends EntityRepository
{
    public function findTranslations($locale)
    {
        return $this->createQueryBuilder('fp');
            ->join('translations', 'fpt')
            ->where('fpt.locale = :locale')
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }
}