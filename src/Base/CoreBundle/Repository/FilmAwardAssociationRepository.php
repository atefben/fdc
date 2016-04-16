<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;

class FilmAwardAssociationRepository extends EntityRepository
{
    public function getByCategoryWithAward($festival, $category, $selectionSection = null)
    {
        $qb = $this
            ->createQueryBuilder('aa')
            ->join('aa.film', 'f')
            ->join('f.selectionSection', 'ss')
            ->join('f.medias', 'm')
            ->join('aa.award', 'a')
            ->join('a.prize', 'p')
            ->join('p.translations', 'pt')
            ->andWhere('pt.category = :category')
            ->setParameter('category', $category)
            ->addOrderBy('ss.position', 'asc')
            ->addOrderBy('p.position', 'asc')
        ;

        if ($selectionSection) {
            $qb
                ->andWhere('f.selectionSection = :selectionSection')
                ->setParameter('selectionSection', $selectionSection)
            ;
        }

        $this->addMasterQueries($qb, 'a', $festival, false);

        return $qb->getQuery()->getResult();
    }
    public function getCameraDorWithAward($festival)
    {
        $qb = $this
            ->createQueryBuilder('aa')
            ->join('aa.award', 'a')
            ->join('a.prize', 'p')
            ->join('p.translations', 'pt')
            ->andWhere('pt.category LIKE :category')
            ->setParameter('category', "%Caméra d'Or%")
            ->addOrderBy('p.position', 'asc')
        ;

        $this->addMasterQueries($qb, 'a', $festival, false);

        return $qb->getQuery()->getResult();
    }

    public function getCameraDOr($festival, array $selectionSectionIds)
    {
        $qb = $this
            ->createQueryBuilder('aa')
            ->join('aa.film', 'f')
            ->distinct()
            ->join('f.selectionSection', 'ss')
            ->andWhere('f.directorFirst = :true')
            ->setParameter('true', true)
            ->andWhere('f.selectionSection IN (:selectionSectionIds)')
            ->setParameter('selectionSectionIds', $selectionSectionIds)
            ->addOrderBy('ss.position', 'asc')
        ;


        $this->addMasterQueries($qb, 'f', $festival, false);

        return $qb->getQuery()->getResult();
    }
}