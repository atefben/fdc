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

        if(!empty($searchTerm['search'])) {
            $finalQuery
                ->addShould($this->getFieldsQuery($searchTerm['search']))
                ->addShould($this->getLocalizedFieldsQuery($_locale, $searchTerm['search']))
                ->addShould($this->getPersonsQuery($searchTerm['search']))
                ->addShould($this->getCountryQuery($_locale, $searchTerm['search']))
                ->addShould($this->getDateQuery($searchTerm['year-start'], $searchTerm['year-end']))
            ;
        }
        
        $statusQuery = new \Elastica\Query\BoolQuery();
        $statusQuery
            ->addMust($this->getStatusFilterQuery($_locale))
            ->addMust($finalQuery)
            //->addMust($this->getYearQuery($fdcYear))
        ;

        if(isset($searchTerm['formats'])) {
            foreach($searchTerm['formats'] as $format) {
                $statusQuery->addShould($this->getSelectionQuery($format));
            }
        }

        if(isset($searchTerm['selections'])) {
            foreach($searchTerm['selections'] as $format) {
                $statusQuery->addShould($this->getSelectionQuery($format));
            }
        }


        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($statusQuery)
            ->addSort('_score')
            ->addSort(array('title' => array('order' => 'asc')))
        ;

        //$yo = $sortedQuery->getQuery()->toArray();
        //dump($yo); exit;
        
        $paginatedResults = $this->getPaginatedResults($sortedQuery, $range, $page);
        
        return array(
          'items' => $paginatedResults->getCurrentPageResults(),
          'count' => $paginatedResults->getNbResults()
        );
    }

    private function getDateQuery($yearStart, $yearEnd) {
        $filter = new \Elastica\Filter\Range('publishedAt', array(
            'gte' => strtotime($yearStart),
            'lte' => strtotime($yearEnd),
            'format' => 'dd/MM/yyyy'
        ));

        return new \Elastica\Query\Filtered(null, $filter);
    }
    
    private function getCountryQuery($_locale, $searchTerm)
    {
        $path = 'countries.country.translations';
        $fields = array('name');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getSelectionQuery($searchTerm)
    {
        $fields = array('selectionSection');

        return $this->getFieldsKeywordQuery($fields, $searchTerm);
    }
    
    private function getFieldsQuery($searchTerm)
    {
        $fields = array('selectionSection', 'titleVO');

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
    
    private function getYearQuery($fdcYear)
    {
        $fields = array('festival.year');
 
        return $this->getFieldsKeywordQuery($fields, $fdcYear);
    }
    
}
