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
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page, $fdcYear)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();
        $finalQuery
            ->addShould($this->getFieldsQuery($_locale, $searchTerm))
            ->addShould($this->getSectionsQuery($_locale, $searchTerm))
        ;
        
        $statusQuery = new \Elastica\Query\BoolQuery();
        $statusQuery
            ->addMust($this->getStatusFilterQuery($_locale))
            ->addMust($finalQuery)
        ;
        
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
    
    private function getSectionsQuery($_locale, $searchTerm)
    {
        $path = 'downloadSection.section.translations';
        $fields = array('title', 'description');
        
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
     
    }
    
}
