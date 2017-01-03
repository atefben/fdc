<?php


namespace Base\CoreBundle\Transformer;

use Base\CoreBundle\Entity\Theme;
use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;

use FOS\ElasticaBundle\Transformer\ModelToElasticaAutoTransformer;

/**
 * Class EventToElasticaTransformer
 * @package Base\CoreBundle\Transformer
 */
class EventToElasticaTransformer extends ModelToElasticaAutoTransformer implements ModelToElasticaTransformerInterface
{
    /**
     * @param object $statement
     * @param array $fields
     * @return Document
     */
    public function transform($statement, array $fields)
    {
        if(is_null($statement->getTheme())) {
            $statement->setTheme(new Theme());
        }
        $document = parent::transform($statement, $fields);
        return $document;
    }
}
