<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class MdfWhoAreWeTeamRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();

        if($searchTerm) {
            $stringQuery = new \Elastica\Query\BoolQuery();
            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
                ->addShould($this->getTeamWidgetsQuery($_locale, $searchTerm))
                ->addShould($this->getContactWidgetsQuery($_locale, $searchTerm))
            ;


            $finalQuery->addMust($stringQuery);
        }

        return $this->find($finalQuery);
    }

    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
            'title',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }
    private function getTeamWidgetsQuery($_locale, $searchTerm)
    {
        $path = 'whoAreWeTeamContactWidgets.translations';
        $fields = array(
            'address',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getContactWidgetsQuery($_locale, $searchTerm)
    {
        $path = 'whoAreWeTeamWidgets.translations';
        $fields = array(
            'name',
            'post',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
