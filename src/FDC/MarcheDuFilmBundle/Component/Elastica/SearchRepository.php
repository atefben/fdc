<?php

namespace FDC\MarcheDuFilmBundle\Component\Elastica;

use FOS\ElasticaBundle\Repository;

class SearchRepository extends Repository
{
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
        ;

        return $keywordMatchQuery;
    }
}
