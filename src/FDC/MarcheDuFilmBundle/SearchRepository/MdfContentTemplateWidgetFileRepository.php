<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class MdfContentTemplateWidgetFileRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();
        
        if($searchTerm) {
            $searchTerm = '%' . $searchTerm . '%';
            
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
            ;

            $finalQuery->addMust($stringQuery);
        }

//        $sortedQuery = new \Elastica\Query();
//        $sortedQuery
//            ->setQuery($finalQuery)
//            ->addSort(array('publishedAt' => array('order' => 'desc')))
//        ;

        return $this->find($finalQuery);
    }

    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'file.translations';
        $fields = array(
            'name',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
