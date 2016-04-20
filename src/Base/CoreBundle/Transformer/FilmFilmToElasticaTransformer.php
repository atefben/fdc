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

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmPerson;

/**
 * Description of EventToElasticaTransformer
 *
 * @author ovidiu
 */
class FilmFilmToElasticaTransformer extends ModelToElasticaAutoTransformer implements ModelToElasticaTransformerInterface
{
    /**
     * Transforms an article into an elastica object having the required keys
     *
     * @param FilmFilm $film the object to convert
     * @param array  $fields the keys we want to have in the returned array
     *
     * @return Document
     **/
    public function transform($film, array $fields)
    {
      $value = NULL;
      if (!$film->getPersons()->count()) {
        $value = NULL;
      }
      else {
        foreach ($film->getPersons() as $person) {
          if ($person->getPerson()) {
            $value[] = array('name' => (string) $person->getPerson());
          }
        }
      }
      
      $document = parent::transform($film, $fields);
      $document->set('persons', $this->normalizeValue($value));
      
      return $document;
    }
}
