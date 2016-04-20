<?php

namespace Base\CoreBundle\SearchRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Base\CoreBundle\Component\Repository\SearchRepository;
use Base\CoreBundle\Interfaces\SearchRepositoryInterface;

class FDCPageParticipateRepository extends SearchRepository implements SearchRepositoryInterface
{
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page)
    {
        
        $finalQuery = $this->getFieldsQuery($_locale, $searchTerm);
        
        $paginatedResults = $this->getPaginatedResults($finalQuery, $range, $page);
        
        return array(
          'items' => $paginatedResults->getCurrentPageResults(),
          'count' => $paginatedResults->getNbResults()
        );
    }
    
    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
          'title',
          'content',
        );
 
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
     
    }
    
}
