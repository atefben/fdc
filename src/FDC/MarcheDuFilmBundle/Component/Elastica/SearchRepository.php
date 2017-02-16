<?php

namespace FDC\MarcheDuFilmBundle\Component\Elastica;

use FOS\ElasticaBundle\Repository;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateTranslation;

class SearchRepository extends Repository
{
    public function getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale, $status = false)
    {
        $keywordMatchQuery = $this->getFieldsKeywordQuery($fields, $searchTerm);

        $locale = new \Elastica\Filter\Term(array($path . '.locale' => $_locale));
        $filteredQuery = new \Elastica\Query\Filtered($keywordMatchQuery, $locale);

        if ($status) {
            $status = new \Elastica\Filter\Term(array( $path . '.status' => array(1, 5)));
            $filteredQuery = new \Elastica\Query\Filtered($filteredQuery, $status);
        }

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

    public function getStatusFilterQuery($_locale)
    {
        $localeFilter = new \Elastica\Filter\Term(array('translations.locale' => $_locale));
        $statusQuery = new \Elastica\Query\Terms(
            'translations.status',
            array(1, 5)
        );

        $filtered = new \Elastica\Query\Filtered($statusQuery, $localeFilter);

        $nested = new \Elastica\Query\Nested();
        $nested
            ->setQuery($filtered)
            ->setPath('translations')
        ;

        return $nested;
    }
}
