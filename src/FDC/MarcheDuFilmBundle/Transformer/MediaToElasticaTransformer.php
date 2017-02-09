<?php

namespace FDC\MarcheDuFilmBundle\Transformer;

use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;
use FOS\ElasticaBundle\Transformer\ModelToElasticaAutoTransformer;
use FDC\MarcheDuFilmBundle\Entity\MdfTheme;

class MediaToElasticaTransformer extends ModelToElasticaAutoTransformer implements ModelToElasticaTransformerInterface
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
        $className = new \ReflectionClass(get_class($object));

        // customize indexes taking care of MdfContentTemplateWidget type
        switch ($className->getShortName()) {
            case 'MediaMdfImage':
                if (is_null($object->getTheme())) {
                    $object->setTheme(new MdfTheme());
                    unset($fields['theme.translations']);
                }

                if (empty($object->getTags())) {
                    unset($fields['tags']);
                }
                break;
            case 'MdfContentTemplateWidgetVideo':
                // if theme isn't set, should remove indexation
                if (is_null($object->getTheme())) {
                    $object->setTheme(new MdfTheme());
                    unset($fields['theme.translations']);
                } 
                break;
            default:
                break;
        }

        //continue with parent::transform() logic 
        $document = parent::transform($object, $fields);

        return $document;
    }
}
