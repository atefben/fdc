<?php

namespace Base\CoreBundle\SearchRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Base\CoreBundle\Component\Repository\SearchRepository;
use Base\CoreBundle\Interfaces\SearchRepositoryInterface;
use Elastica\Filter\Range;
use Elastica\Query\Filtered;

class FilmFilmRepository extends SearchRepository implements SearchRepositoryInterface
{
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page)
    {
        if(!is_array($searchTerm)) {
            $searchTerm = array('search' => $searchTerm);
        }
        $finalQuery = new \Elastica\Query\BoolQuery();

        //string query
        if(!empty($searchTerm['search'])) {
            $stringQuery = new \Elastica\Query\BoolQuery();
            
            $stringQuery
                ->addShould($this->getFieldsQuery($searchTerm['search']))
                ->addShould($this->getLocalizedFieldsQuery($_locale, $searchTerm['search']))
                ->addShould($this->getPersonsQuery($searchTerm['search']))
                ->addShould($this->getCountryQuery($_locale, $searchTerm['search']))
            ;

            $finalQuery->addMust($stringQuery);
        }

        //date query
        if(!empty($searchTerm['yearStart']) && !empty($searchTerm['yearEnd'])) {
            $dateQuery = new \Elastica\Query\BoolQuery();

            $rangeLower = new Filtered(
                $dateQuery,
                new Range('festival.year', array(
                    'gte' => $searchTerm['yearStart'],
                ))
            );

            $rangeUpper = new Filtered(
                $rangeLower,
                new Range('festival.year', array(
                    'lte' => $searchTerm['yearEnd'],
                ))
            );

            $finalQuery->addMust($rangeUpper);
        }

        //status query
        $statusQuery = new \Elastica\Query\BoolQuery();
        $statusQuery->addMust($this->getStatusFilterQuery($_locale));
        $finalQuery->addMust($statusQuery);

        //formats query
        if(!empty($searchTerm['formats'])) {
            $formatsQuery = new \Elastica\Query\BoolQuery();
            foreach($searchTerm['formats'] as $format) {
                $formatsQuery->addShould($this->getSelectionQuery($format));
            }
            $finalQuery->addMust($formatsQuery);
        }

        //selections query
        if(!empty($searchTerm['selections'])) {
            $selectionsQuery = new \Elastica\Query\BoolQuery();
            foreach($searchTerm['selections'] as $format) {
                $selectionsQuery->addShould($this->getSelectionQuery($format));
            }
            $finalQuery->addMust($selectionsQuery);
        }

        //prizes query
        if(!empty($searchTerm['prizes'])) {
            $prizesQuery = new \Elastica\Query\BoolQuery();
            foreach($searchTerm['prizes'] as $prize) {
                $prizesQuery->addShould($this->getPrizesQuery($_locale, $prize));
            }
            $finalQuery->addMust($prizesQuery);
        }


        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($finalQuery)
            ->addSort('_score')
            ->addSort(array('title' => array('order' => 'asc')))
        ;

        //$yo = $sortedQuery->getQuery()->toArray();
        //dump($yo); exit;
        
        $paginatedResults = $this->getPaginatedResults($sortedQuery, $range, $page);

        return array(
          'items' => $paginatedResults->getCurrentPageResults(),
          'count' => $paginatedResults->getNbResults()
        );
    }

    private function getDateQuery($yearStart, $yearEnd) {
        $filter = new \Elastica\Filter\Range('publishedAt', array(
            'gte' => strtotime($yearStart),
            'lte' => strtotime($yearEnd),
            'format' => 'dd/MM/yyyy'
        ));

        return new \Elastica\Query\Filtered(null, $filter);
    }
    
    private function getCountryQuery($_locale, $searchTerm)
    {
        $path = 'countries.country.translations';
        $fields = array('name');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getSelectionQuery($searchTerm)
    {
        $fields = array('selectionSection');

        return $this->getFieldsKeywordQuery($fields, $searchTerm);
    }
    
    private function getFieldsQuery($searchTerm)
    {
        $fields = array('selectionSection', 'titleVO');

        return $this->getFieldsKeywordQuery($fields, $searchTerm);
    }
    
    private function getLocalizedFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array('title');
 
        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
    
    private function getPersonsQuery($searchTerm)
    {
        $fields = array('persons.name');
        $keywordMatchQuery = $this->getFieldsKeywordQuery($fields, $searchTerm);
        
        return $keywordMatchQuery;
    }
    
    private function getYearQuery($fdcYear)
    {
        $fields = array('festival.year');
 
        return $this->getFieldsKeywordQuery($fields, $fdcYear);
    }

    private function getPrizesQuery($_locale, $searchTerm) {
        $path = 'awards.award.prize.translations';
        $fields = array('title');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
    
}
