<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmJuryType;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class FilmJuryTypeRepository
 * @package Base\CoreBundle\Repository
 */
class FilmJuryTypeRepository extends EntityRepository
{


    /**
     * @param $festival
     * @return FilmJuryType[]
     */
    public function getJuryTypeByFestival($festival)
    {
        $qb = $this->createQueryBuilder('jt');

        $qb
            ->innerJoin('jt.juries', 'j')
            ->andWhere('j.festival = :festival')
            ->setParameter(':festival', $festival)
        ;

        return $qb->getQuery()->getResult();
    }
}