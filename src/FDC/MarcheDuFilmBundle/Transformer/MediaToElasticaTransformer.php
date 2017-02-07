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
            case 'MdfContentTemplateWidgetVideo':
                unset($fields['gallery.translations']);
                unset($fields['image']);
                
                // if theme isn't set, should remove indexation
                if (is_null($object->getTheme())) {
                    $object->setTheme(new MdfTheme());
                    unset($fields['theme.translations']);
                } 
                break;
            case 'MdfContentTemplateWidgetImage':
                unset($fields['gallery.translations']);
                unset($fields['translations']);
                unset($fields['theme.translations']);
                
                // if theme isn't set, should remove indexation
                if (is_null($object->getImage()->getTheme())) {
                    $object->getImage()->setTheme(new MdfTheme());
                    unset($fields['image.theme.translations']);
                }                    
                break;
            case 'MdfContentTemplateWidgetGallery':
                unset($fields['image']);
                unset($fields['translations']);
                unset($fields['theme.translations']);
                
                // if gallery isn't set, should remove indexation
                if (is_null($object->getGallery())) {
                    unset($fields['gallery.translations']);
                } 
                break;
            case 'MdfContentTemplateWidgetFile':
            case 'MdfContentTemplateWidgetText':
            unset($fields['gallery.translations']);
            unset($fields['image']);
            unset($fields['translations']);
            unset($fields['theme.translations']);
            break;
            default:
                break;
        }

        //continue with parent::transform() logic 
        $document = parent::transform($object, $fields);

        return $document;
    }
}
