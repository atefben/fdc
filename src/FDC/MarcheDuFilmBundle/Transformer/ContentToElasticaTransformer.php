<?php

namespace FDC\MarcheDuFilmBundle\Transformer;

use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;
use FOS\ElasticaBundle\Transformer\ModelToElasticaAutoTransformer;
use FDC\MarcheDuFilmBundle\Entity\MdfTheme;

class ContentToElasticaTransformer extends ModelToElasticaAutoTransformer implements ModelToElasticaTransformerInterface
{
    /**
     * Transforms an object into an elastica object having the required keys.
     *
     * @param object $object the object to convert
     * @param array  $fields the keys we want to have in the returned array
     *
     * @return Document
     **/
    public function transform($object, array $fields)
    {
        // if theme isn't set, should remove indexation
        if (is_null($object->getTheme())) {
            $object->setTheme(new MdfTheme());
            unset($fields['theme.translations']);
        }

        // create index only for ContentTemplateWidgets of type Text
        $haveTextWidget = false;

        foreach ($object->getContentTemplateWidgets() as $widget) {

            if ($widget->isWidgetText()) {
                $haveTextWidget = true;

                continue;
            }

            if (!$widget->isWidgetText()) {
                $object->removeContentTemplateWidget($widget);
            }
        }

        if (!$haveTextWidget) {
            unset($fields['contentTemplateWidgets.translations']);
        }

        //continue with parent::transform() logic 
        $document = parent::transform($object, $fields);

        return $document;
    }
}
