<?php

namespace FDC\CourtMetrageBundle\Manager;


use Doctrine\ORM\EntityManager;

/**
 * Class NewsManager
 * @package FDC\CourtMetrageBundle\Manager
 */
class NewsManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * NewsManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    public function getAvailableFilters($locale = 'fr')
    {
        
    }
}