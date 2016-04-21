<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\Event;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

/**
 * Class EventRepository
 * @package Base\CoreBundle\Repository
 */
class EventRepository extends TranslationRepository
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
            ->join('e.translations', 'et')
        ;

        $this->addMasterQueries($qb, 'e', $festival, true);
        $this->addTranslationQueries($qb, 'et', $locale);

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
            ->join('e.translations', 'et')
            ->andWhere('e.id = :id')
            ->setParameter('id', $id)
        ;

        $this->addMasterQueries($qb, 'e', $festival, true);
        $this->addTranslationQueries($qb, 'et', $locale);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $festival
     * @param $locale
     * @return arrays
     */
    public function getEvents($festival, $locale)
    {
        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.translations', 'et')
        ;

        $this->addMasterQueries($qb, 'e', $festival, true);
        $this->addTranslationQueries($qb, 'et', $locale);

        $qb
            ->addOrderBy('e.publishedAt', 'desc');


        return $qb->getQuery()->getResult();
    }


    /**
     * @param int $festival
     * @param string $locale
     * @param string $slug
     * @return Event|null
     * @throws NonUniqueResultException
     */
    public function getEventBySlug($festival, $locale, $slug)
    {
        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.translations', 'et')
        ;

        $this->addMasterQueries($qb, 'e', $festival, true);
        $this->addTranslationQueries($qb, 'et', $locale, $slug);

        return $qb->getQuery()->getOneOrNullResult();
    }
}