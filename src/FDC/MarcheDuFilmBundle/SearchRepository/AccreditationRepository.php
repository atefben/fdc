<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class AccreditationRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();

        if($searchTerm) {
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
                ->addShould($this->getWidgetsQuery($_locale, $searchTerm))
            ;

            $finalQuery->addMust($stringQuery);
        }

        return $this->find($finalQuery);
    }

    private function getFieldsQuery($_locale, $searchTerm)
    {
        $path = 'translations';
        $fields = array(
            'subtitle',
            'title',
            'description',
            'promotionsTitle',
            'promotionTitle1',
            'promotionInformation1',
            'promotionTitle2',
            'promotionInformation2',
            'promotionTitle3',
            'promotionInformation3',
            'promotionDetailsTitle1',
            'promotionDetailsPricePrefix1',
            'promotionDetailsPrice1',
            'promotionDetailsPriceSuffix1',
            'promotionDetailsInformation1',
            'promotionDetailsTitle2',
            'promotionDetailsPricePrefix2',
            'promotionDetailsPrice2',
            'promotionDetailsPriceSuffix2',
            'promotionDetailsInformation2',
            'promotionDetailsTitle3',
            'promotionDetailsPricePrefix3',
            'promotionDetailsPrice3',
            'promotionDetailsPriceSuffix3',
            'promotionDetailsInformation3'
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }

    private function getWidgetsQuery($_locale, $searchTerm)
    {
        $path = 'accreditationWidgets.translations';
        $fields = array('title', 'description');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
