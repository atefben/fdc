<?php

namespace Base\CoreBundle\SearchRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Base\CoreBundle\Component\Repository\SearchRepository;
use Base\CoreBundle\Interfaces\SearchRepositoryInterface;

class CountryRepository extends SearchRepository implements SearchRepositoryInterface
{
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page, $fdcYear = false)
    {
        // Fields (title, introduction) OR Theme
        $finalQuery = new \Elastica\Query\BoolQuery();

        if(!is_array($searchTerm)) {
            $searchTerm = array('search' => $searchTerm);
        }

        if(!empty($searchTerm['search'])) {
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addMust($this->getFieldsQuery($searchTerm['search']))
                //->addShould($this->getFilmsQuery($_locale, $searchTerm, $fdcYear))
            ;

            $finalQuery->addMust($stringQuery);
        }

        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($finalQuery)
        ;

        $paginatedResults = $this->getPaginatedResults($sortedQuery, $range, $page);

        return array(
            'items' => $paginatedResults->getCurrentPageResults(),
            'count' => $paginatedResults->getNbResults()
        );
    }

    public function getLocalizedFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
            'name',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }

    private function getFieldsQuery($searchTerm)
    {
        $fields = array(
            'name',
        );

        return $this->getFieldsKeywordQuery($fields, $searchTerm, false);

    }

    private function getFieldsQueryDoublon($searchTerm)
    {
        $fields = array(
            'name',
        );

        return $this->getFieldsKeywordQuery($fields, $searchTerm, false);

    }

}
