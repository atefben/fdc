<?php

namespace Base\SoifBundle\Manager;

use Base\CoreBundle\Entity\Country;
use Base\CoreBundle\Entity\CountryTranslation;

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
        $this->repository = 'BaseCoreBundle:Country';
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
     * getById function.
     * 
     * @access public
     * @param mixed $id
     * @return void
     */
    public function getById($id)
    {
        $this->wsMethod = 'GetCountry';
        $this->wsResultKey = 'GetCountryResult';

        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));

        if (!isset($result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey})) {
            $this->logger->warn($this->wsMethod . " {$id} not found");
            return null;
        }

        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        
        // set entity
        $entity = $this->set($resultObject, $result);
        
        // save entity
        $this->update($entity);
        
        // end timer
        $this->end(__METHOD__);
    }
    
    /**
     * getModified function.
     * 
     * @access public
     * @param mixed $from
     * @param mixed $to
     * @return void
     */
    public function getModified($from, $to)
    {
        $this->wsMethod = 'GetModifiedCountry';
        $this->wsResultKey = 'GetModifiedCountryResult';
         
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to), false);
        // verify if we have results
        if (!isset($result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey})) {
            $this->logger->info("No entities found for timestamp interval {$from} - > {$to} ");
            return;
        }
        $resultObjects = $this->mixedToArray($result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey});

        foreach ($resultObjects as $resultObject) {
            $entity = $this->set($resultObject, $result);
            $this->update($entity);
        }
        
        // end timer
        $this->end(__METHOD__);
    }

    /**
     * getRemoved function.
     * 
     * @access public
     * @param mixed $from
     * @param mixed $to
     * @return void
     */
    public function getRemoved($from, $to)
    {
        $this->wsMethod = 'GetRemovedCountry';
        $this->wsResultKey = 'GetRemovedCountryResult';
         
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to), false);
        $resultObjects = $this->mixedToArray($result->{$this->wsResultKey}->Resultats);
        
        // delete objects
        $this->deleteMultiple($resultObjects);
        
        // save entities
        $this->em->flush();
        
        // end timer
        $this->end(__METHOD__);
    }
    
    /**
     * set function.
     * 
     * @access private
     * @param mixed $resultObject
     * @param mixed $result
     * @return void
     */
    private function set($resultObject, $result)
    {
        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new Country();
        
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
        
        return $entity;
    }
}