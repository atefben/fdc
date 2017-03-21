<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\CoreBundle\Transformer;

use Base\CoreBundle\Entity\Theme;
use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;

use FOS\ElasticaBundle\Transformer\ModelToElasticaAutoTransformer;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

use Base\CoreBundle\Entity\EventTranslation;

/**
 * Description of InfoToElasticaTransformer
 *
 * @author ohwee
 */
class InfoToElasticaTransformer extends ModelToElasticaAutoTransformer implements ModelToElasticaTransformerInterface
{
    /**
     * Transforms a statement into an elastica object having the required keys
     *
     * @param EventTranslation $event the object to convert
     * @param array  $fields the keys we want to have in the returned array
     *
     * @return Document
     **/
    public function transform($statement, array $fields)
    {
        $document = parent::transform($statement, $fields);
        return $document;
    }
}
