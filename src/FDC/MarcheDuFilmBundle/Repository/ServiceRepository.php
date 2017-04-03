<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\MarcheDuFilmBundle\Entity\Service;

/**
 * Class ServiceRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class ServiceRepository extends EntityRepository
{

    /**
     * @param $locale
     * @param $slug
     * @return Service
     */
    public function getOnePublished($locale, $slug)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->innerJoin('s.translations', 't')
            ->andWhere('t.slug = :slug')
            ->setParameter(':slug', $slug)
        ;

        $this->addMasterQueries($qb, 's', true);
        $this->addTranslationQueries($qb, 't', $locale);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
