<?php

namespace FDC\MarcheDuFilmBundle\SearchRepository;

use FDC\MarcheDuFilmBundle\Component\Elastica\SearchRepository;

class MdfContentTemplateWidgetRepository extends SearchRepository
{
    public function findWithCustomQuery($_locale, $searchTerm)
    {
        $finalQuery = new \Elastica\Query\BoolQuery();
        
        if($searchTerm) {
            $searchTerm = '%' . $searchTerm . '%';
            
            $stringQuery = new \Elastica\Query\BoolQuery();

            $stringQuery
                ->addShould($this->getImageFieldsQuery($_locale, $searchTerm))
                ->addShould($this->getImageThemeQuery($_locale, $searchTerm))
                ->addShould($this->getImageTagsQuery($_locale, $searchTerm))
                ->addShould($this->getGalleryFieldsQuery($_locale, $searchTerm))
                ;

            $finalQuery->addMust($stringQuery);
        }

        return $this->find($finalQuery);
    }

    private function getImageFieldsQuery($_locale, $searchTerm)
    {
        $path = 'image.translations';
        $fields = array(
            'alt',
            'legend',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getImageThemeQuery($_locale, $searchTerm)
    {
        $path = 'image.theme.translations';
        $fields = array('title');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    public function getImageTagsQuery($_locale, $searchTerm)
    {
        $path = 'image.tags.tag.translations';
        $fields = array('name');

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }

    private function getGalleryFieldsQuery($_locale, $searchTerm)
    {
        $path = 'gallery.translations';
        $fields = array(
            'name',
        );

        return $this->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
    }
}
