<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class ServiceRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();

        if($searchTerm) {
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
                ->addShould($this->getWidgetsFieldQuery($_locale, $searchTerm))
                ->addShould($this->getWidgetsProductFieldsQuery($_locale, $searchTerm))
            ;

            $finalQuery->addMust($stringQuery);
        }

        return $this->find($finalQuery);
    }

    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
            'subTitle',
            'title',
            'header',
            'contentBlockTitle',
            'contentBlockBody'
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }

    private function getWidgetsFieldQuery($_locale, $searchTerm)
    {
        $path = 'widgetCollections.widget.translations';
        $fields = array('title', 'subtitle');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getWidgetsProductFieldsQuery($_locale, $searchTerm)
    {
        $path = 'widgetCollections.widget.productCollections.product.translations';
        $fields = array(
            'title',
            'grayText',
            'colorText',
            'body',
            'toggledBody'
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
