<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\CoreBundle\Transformer;

use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;

use FOS\ElasticaBundle\Transformer\ModelToElasticaAutoTransformer;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

use Base\CoreBundle\Entity\EventTranslation;

/**
 * Description of EventToElasticaTransformer
 *
 * @author ovidiu
 */
class MediaToElasticaTransformer extends ModelToElasticaAutoTransformer implements ModelToElasticaTransformerInterface
{
    /**
     * Transforms an article into an elastica object having the required keys
     *
     * @param EventTranslation $event the object to convert
     * @param array  $fields the keys we want to have in the returned array
     *
     * @return Document
     **/
    public function transform($media, array $fields)
    {
        $className = new \ReflectionClass(get_class($media));

        switch ($className->getShortName()) {
          case 'MediaImage':
            // If Media image use legend instead of title.
            $fields['translations']['properties']['legend'] = $fields['translations']['properties']['title'];
            unset($fields['translations']['properties']['title']);
          case 'MediaAudio':
            unset($fields['webTv.translations']);
            break;
          case 'MediaVideo':
            if (!$media->getWebTv()) {
              unset($fields['webTv.translations']);
            }
          default:
            break;
        }
      
        $document = parent::transform($media, $fields);
      
        return $document;
    }
}
