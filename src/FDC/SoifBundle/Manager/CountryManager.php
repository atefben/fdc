<?php

namespace FDC\SoifBundle\Manager;

use FDC\CoreBundle\Entity\Country;
use FDC\CoreBundle\Entity\CountryTranslation;

/**
 * CountryManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class CountryManager extends CoreManager
{
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        // soif parameters
        $this->repository = 'FDCCoreBundle:Country';
        $this->wsMethod = 'GetCountry';
        $this->wsResultKey = 'GetCountryResult';
        $this->wsResultObjectKey = 'CountryDto';
        $this->wsParameterKey = 'idCountry';
        $this->entityIdKey = 'Id';
        
        // mappers entity setters to soif properties
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setIso' => 'CodeIso'
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new Country();
        $persist = ($entity->getId() === null) ? true : false;
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);

        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set translations for name and lang
        $localesMapper = $this->getLocalesMapper();
        $langs = array('fr', 'en');
        
        foreach ($langs as $lang) {
            $entityTranslation = $entity->findTranslationByLocale($lang);
            $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new CountryTranslation();
            $entityTranslation->setName($resultObject->{'Libelle'. ucfirst($lang)});
            $entityTranslation->setLang($resultObject->{'Langue'. ucfirst($lang)});
            $entityTranslation->setLocale($lang);
            
            if ($entityTranslation->getId() === null) {
                $entity->addTranslation($entityTranslation);
            }
        }

        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
    
    public function getModified($from, $to)
    {
        $this->wsMethod = 'GetModifiedCountry';
        $this->wsResultKey = 'GetModifiedCountryResult';
         
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to));
        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        $entities = array();
        $persists = array();
        
        foreach ($resultObject as $object) {
            // create / get entity
            $entity = ($this->findOneById(array('id' => $object->{$this->entityIdKey}))) ?: new FilmAward();
            $persists[] = ($entity->getId() === null) ? true : false;
            
            // set soif last update time
            $this->setSoifUpdatedAt($result, $entity);
    
            // set entity properties
            $this->setEntityProperties($object, $entity);
            
            // set related entity
            $this->setEntityRelated($object, $entity);
            
            $entities[] = $entity;
        }
        
        // update entity
        $this->updates($entities, $persists);
        
        // end timer
        $this->end(__METHOD__);
    }
}