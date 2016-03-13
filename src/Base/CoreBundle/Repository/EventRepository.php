<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\Event;
use Doctrine\ORM\QueryBuilder;

/**
 * Class EventRepository
 * @package Base\CoreBundle\Repository
 */
class EventRepository extends EntityRepository
{
    /**
     * @param $festival
     * @param $locale
     * @return QueryBuilder
     */
    public function getApiEvents($festival, $locale)
    {
        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.translations', 't')
        ;

        $this->addMasterQueries($qb, 'e', $festival, true);
        $this->addTranslationQueries($qb, 't', $locale);

        return $qb;
    }

    /**
     * @param $festival
     * @param $locale
     * @param $id
     * @return Event|null
     */
    public function getApiEvent($festival, $locale, $id)
    {
        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.translations', 't')
            ->andWhere('e.id = :id')
            ->setParameter('id', $id)
        ;

        $this->addMasterQueries($qb, 'e', $festival, true);
        $this->addTranslationQueries($qb, 't', $locale);

        return $qb->getQuery()->getOneOrNullResult();
    }
}