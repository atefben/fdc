<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class MdfContentTemplateRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();

        if($searchTerm) {
            $searchTerm = '%' . $searchTerm . '%';
            
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
                ->addShould($this->getThemeQuery($_locale, $searchTerm))
                ->addShould($this->getWidgetsQuery($_locale, $searchTerm))
            ;

            $finalQuery->addMust($stringQuery);
        }

//        $sortedQuery = new \Elastica\Query();
//        $sortedQuery
//            ->setQuery($statusQuery)
////            ->addSort('_score')
//            ->addSort(array('publishedAt' => array('order' => 'desc')))
//        ;

        return $this->find($finalQuery);
    }

    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
            'title',
            'header',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getThemeQuery($_locale, $searchTerm)
    {
        $path = 'theme.translations';
        $fields = array('title');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getWidgetsQuery($_locale, $searchTerm)
    {
        $path = 'contentTemplateWidgets.translations';
        $fields = array('title', 'contentText');



        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
