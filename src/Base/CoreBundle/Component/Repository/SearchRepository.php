<?php

namespace Base\CoreBundle\Component\Repository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use FOS\ElasticaBundle\Repository;

class SearchRepository extends Repository
{
    public function getPaginatedResults($query, $range, $page)
    {
        return $this->findPaginated($query)
            ->setMaxPerPage($range)
            ->setCurrentPage($page)
        ;
    }

    public function getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale)
    {
        $keywordMatchQuery = $this->getFieldsKeywordQuery($fields, $searchTerm);
        
        $locale = new \Elastica\Filter\Term(array($path . '.locale' => $_locale));
        $filteredQuery = new \Elastica\Query\Filtered($keywordMatchQuery, $locale);
        
        $keywordNestedQuery = new \Elastica\Query\Nested();
        $keywordNestedQuery
            ->setQuery($filteredQuery)
            ->setPath($path)
        ;
        
        return $keywordNestedQuery;
    }
    
    public function getFieldsKeywordQuery($fields, $searchTerm, $useDisMax = true)
    {
        // Matching Query.
        $keywordMatchQuery = new \Elastica\Query\MultiMatch();
        $keywordMatchQuery
            ->setQuery($searchTerm)
            ->setFields($fields)
            ->setUseDisMax($useDisMax)
            //->setPrefixLength(3)
        ;
        
        return $keywordMatchQuery;
    }
    
    public function getTagsQuery($_locale, $searchTerm)
    {
        $path = 'tags.tag.translations';
        $fields = array('name');
        
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
