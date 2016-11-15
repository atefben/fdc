<?php

namespace Base\CoreBundle\SearchRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Base\CoreBundle\Component\Repository\SearchRepository;
use Base\CoreBundle\Interfaces\SearchRepositoryInterface;

class NewsRepository extends SearchRepository implements SearchRepositoryInterface
{
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page)
    {
        // Fields (title, introduction) OR Theme
        $finalQuery = new \Elastica\Query\BoolQuery();
        if(!empty($searchTerm['search'])) {
            $finalQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm['search']))
                ->addShould($this->getThemeQuery($_locale, $searchTerm['search']))
                ->addShould($this->getTagsQuery($_locale, $searchTerm['search']))
                //->addShould($this->getDateQuery($searchTerm['year-start'], $searchTerm['year-end']))
            ;
        }

        $statusQuery = new \Elastica\Query\BoolQuery();
        $statusQuery
            ->addMust($this->getStatusFilterQuery($_locale))
            ->addMust($finalQuery)
        ;

        $sortedQuery = new \Elastica\Query();
        $sortedQuery
            ->setQuery($statusQuery)
            ->addSort('_score')
            ->addSort(array('publishedAt' => array('order' => 'desc')))
        ;

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


    private function getThemeQuery($_locale, $searchTerm)
    {
        $path = 'theme.translations';
        $fields = array('name');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
            'title',
            'introduction',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }

}