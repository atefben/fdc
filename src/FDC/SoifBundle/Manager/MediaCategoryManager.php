<?php

namespace FDC\SoifBundle\Manager;

use FDC\CoreBundle\Entity\FilmMediaCategory;
use FDC\CoreBundle\Entity\FilmMediaCategoryTranslation;

/**
 * MediaCategoryManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class MediaCategoryManager extends CoreManager
{
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->repository = 'FDCCoreBundle:FilmMediaCategory';
        $this->wsParameterKey = 'idType';
        $this->wsMethod = 'GetTypeElementMultimedia';
        $this->wsResultKey = 'GetTypeElementMultimediaResult';
        $this->wsResultObjectKey = 'TypeElementMultimediaDto';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
        );
    }
    
    /**
     * updateEntity function.
     * 
     * @access public
     * @param mixed $id
     * @return void
     */
    public function updateEntity($id)
    {
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));
        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};

        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmMediaCategory();
        $persist = ($entity->getId() === null) ? true : false;

        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        $langs = array('fr', 'en');
        foreach ($langs as $lang) {
            $entityTranslation = $entity->findTranslationByLocale($lang);
            $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new FilmMediaCategoryTranslation();
            $entityTranslation->setName($resultObject->{'Libelle'. ucfirst($lang)});
            $entityTranslation->setLocale($lang);
            
            if ($entityTranslation->getId() === null) {
                $entity->addTranslation($entityTranslation);
            }
        }

        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
        
        return $entity;
    }
}