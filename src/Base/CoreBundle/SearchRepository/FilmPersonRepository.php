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

        // Fields (title, introduction) OR Theme
        $finalQuery = new \Elastica\Query\BoolQuery();
        $finalQuery
            ->addShould($this->getFieldsQuery($searchTerm))
            ->addShould($this->getFilmsQuery($_locale, $searchTerm))
            ->addShould($this->getLocalizedFieldsQuery($_locale, $searchTerm))
        ;
        
        $statusQuery = new \Elastica\Query\BoolQuery();
        $statusQuery
            ->addMust($this->getStatusFilterQuery($_locale))
            ->addMust($finalQuery)
        ;
        
        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($statusQuery)
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
    
    private function getFilmsQuery($_locale, $searchTerm)
    {
        $path = 'films.film.translations';
        $fields = array('films.film.translations.title');
        $keywordMatchQuery = $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
        
        return $keywordMatchQuery;
    }
    
}
