<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class MdfSpeakersRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();

        if($searchTerm) {
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
                ->addShould($this->getSpeakerChoicesFieldQuery($_locale, $searchTerm))
                ->addShould($this->getSpeakerChoicesDetailsFieldQuery($_locale, $searchTerm))
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
            'description',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }

    private function getSpeakerChoicesFieldQuery($_locale, $searchTerm)
    {
        $path = 'speakersChoicesCollections.speakersChoice.translations';
        $fields = array(
            'title',
            'subtitle',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getSpeakerChoicesDetailsFieldQuery($_locale, $searchTerm)
    {
        $path = 'speakersChoicesCollections.speakersChoice.speakersDetailsCollections.speakersDetails.translations';
        $fields = array(
            'name',
            'company',
            'country',
            'details'
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
