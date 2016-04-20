<?php

namespace Base\CoreBundle\SearchRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Base\CoreBundle\Component\Repository\SearchRepository;
use Base\CoreBundle\Interfaces\SearchRepositoryInterface;

class FilmFilmRepository extends SearchRepository implements SearchRepositoryInterface
{
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page)
    {
      
        $finalQuery = new \Elastica\Query\BoolQuery();
        $finalQuery
            ->addShould($this->getFieldsQuery($searchTerm))
            ->addShould($this->getLocalizedFieldsQuery($_locale, $searchTerm))
            ->addShould($this->getPersonsQuery($searchTerm))
            ->addShould($this->getCountryQuery($_locale, $searchTerm))
        ;
        
        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($finalQuery)
            ->addSort('_score')
            ->addSort(array('title' => array('order' => 'asc')))
        ;
        
        $paginatedResults = $this->getPaginatedResults($sortedQuery, $range, $page);
        
        return array(
          'items' => $paginatedResults->getCurrentPageResults(),
          'count' => $paginatedResults->getNbResults()
        );
    }
    
    
    private function getCountryQuery($_locale, $searchTerm)
    {
        $path = 'countries.country.translations';
        $fields = array('name');
        
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
    
    private function getFieldsQuery($searchTerm)
    {
        $fields = array('selectionSection');
 
        return $this->getFieldsKeywordQuery($fields, $searchTerm);
    }
    
    private function getLocalizedFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array('title');
 
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
    
    private function getPersonsQuery($searchTerm)
    {
        $fields = array('persons.name');
        $keywordMatchQuery = $this->getFieldsKeywordQuery($fields, $searchTerm);
        
        return $keywordMatchQuery;
    }
    
}
