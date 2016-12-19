<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\NewsTranslation;

/**
 * Class NewsTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class NewsTranslationRepository extends EntityRepository
{

    /**
     * @param $locale
     *
     * @return NewsTranslation
     */
    public function getHomepageNewsByLocale($locale)
    {
        $qb = $this->createQueryBuilder('nt')
            ->select('nt, n')
            ->join('nt.translatable', 'n')
            ->where('nt.locale = :locale')
            ->andWhere('n.publishedAt <= :today')
            ->setParameter('locale', $locale)
            ->setParameter('today', new \DateTime())
            ->setMaxResults(3)
            ->orderBy('n.publishedAt', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }
}
