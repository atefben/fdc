<?php

namespace Base\CoreBundle\SearchRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Base\CoreBundle\Component\Repository\SearchRepository;
use Base\CoreBundle\Interfaces\SearchRepositoryInterface;

class EventRepository extends SearchRepository implements SearchRepositoryInterface
{
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page, $fdcYear = false)
    {
        if(!is_array($searchTerm)) {
            $searchTerm = array('search' => $searchTerm);
        }

        // Fields (title, introduction) OR Theme
        $finalQuery = new \Elastica\Query\BoolQuery();

        if(!empty($searchTerm['search'])) {
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm['search']))
                ->addShould($this->getThemeQuery($_locale, $searchTerm['search']))
                ->addShould($this->getTagsQuery($_locale, $searchTerm['search']));

            $finalQuery->addMust($stringQuery);
        }
        
        $statusQuery = new \Elastica\Query\BoolQuery();
        $statusQuery
            ->addMust($this->getStatusFilterQuery($_locale))
            ->addMust($finalQuery)
        ;
        
        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($statusQuery)
            ->addSort('_score')
            ->addSort(array('publishedAt' => array('order' => 'desc')))
        ;
        
        $paginatedResults = $this->getPaginatedResults($sortedQuery, $range, $page);
        
        return array(
          'items' => $paginatedResults->getCurrentPageResults(),
          'count' => $paginatedResults->getNbResults()
        );
    }
    
    
    private function getThemeQuery($_locale, $searchTerm)
    {
        $path = 'theme.translations';
        $fields = array('name');
        
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
    
    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
          'title',
          'introduction',
        );
 
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
     
    }
    
}
