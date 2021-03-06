<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class GalleryMdfRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();

        if($searchTerm) {
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
            ;

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
            ->addSort(array('createdAt' => array('order' => 'desc')))
        ;

        return $this->find($sortedQuery);
    }

    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
            'name',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }
}
