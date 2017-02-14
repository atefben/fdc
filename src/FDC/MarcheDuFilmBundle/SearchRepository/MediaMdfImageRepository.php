<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class MediaMdfImageRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();
        
        if($searchTerm) {
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
                ->addShould($this->getThemeQuery($_locale, $searchTerm))
                ->addShould($this->getTagsQuery($_locale, $searchTerm));
            ;

            $finalQuery->addMust($stringQuery);
        }

        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($finalQuery)
            ->addSort(array('publishedAt' => array('order' => 'desc')))
        ;

        return $this->find($sortedQuery);
    }

    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
            'alt',
            'legend',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }

    private function getThemeQuery($_locale, $searchTerm)
    {
        $path = 'theme.translations';
        $fields = array('title');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    public function getTagsQuery($_locale, $searchTerm)
    {
        $path = 'tags.tag.translations';
        $fields = array('name');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
