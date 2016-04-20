<?php

namespace Base\CoreBundle\SearchRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Base\CoreBundle\Component\Repository\SearchRepository;
use Base\CoreBundle\Interfaces\SearchRepositoryInterface;

class FilmPersonRepository extends SearchRepository implements SearchRepositoryInterface
{
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page)
    {
        if ($_locale == 'zh') {
          $_locale = 'cn';
        }
        
        // Fields (title, introduction) OR Theme
        $finalQuery = new \Elastica\Query\BoolQuery();
        $finalQuery
            ->addShould($this->getFieldsQuery($searchTerm))
            ->addShould($this->getLocalizedFieldsQuery($_locale, $searchTerm))
        ;
        
        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($finalQuery)
            ->addSort('_score')
            ->addSort(array('firstname' => array('order' => 'asc')))
        ;
        
        $paginatedResults = $this->getPaginatedResults($sortedQuery, $range, $page);

        return array(
          'items' => $paginatedResults->getCurrentPageResults(),
          'count' => $paginatedResults->getNbResults()
        );
    }
    
    private function getLocalizedFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
          'profession',
        );
 
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
     
    }
    
    private function getFieldsQuery($searchTerm)
    {
        $fields = array(
          'firstname',
          'lastname',
          'nationality',
        );
 
        return $this->getFieldsKeywordQuery($fields, $searchTerm, false);
     
    }
    
}
