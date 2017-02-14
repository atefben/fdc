<?php

namespace FDC\CourtMetrageBundle\Repository;


use Doctrine\ORM\EntityRepository;

/**
 * Class CcmNewsRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmNewsRepository extends EntityRepository
{
    public function getThemesAndYearsOfPublishedNews($locale = 'fr')
    {
        
    }
}