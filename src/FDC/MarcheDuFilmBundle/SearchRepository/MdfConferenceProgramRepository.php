<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class MdfConferenceProgramRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();

        if($searchTerm) {
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getFieldsQuery($_locale, $searchTerm))
                ->addShould($this->getWidgetsFieldQuery($_locale, $searchTerm))
                ->addShould($this->getWidgetsSpeakerFieldsQuery($_locale, $searchTerm))
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
            'header',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);

    }

    private function getWidgetsFieldQuery($_locale, $searchTerm)
    {
        $path = 'dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.translations';
        $fields = array(
            'title',
            'subtitle',
            'description',
            'eventPlace',
            'eventAccessType',
            'speakersTitle'
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getWidgetsSpeakerFieldsQuery($_locale, $searchTerm)
    {
        $path = 'dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.speakerCollections.programSpeakers.translations';
        $fields = array(
            'name',
            'description',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
