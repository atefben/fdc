<?php

namespace FDC\SoifBundle\Manager;

use FDC\CoreBundle\Entity\FilmFestival;

/**
 * FestivalManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class FestivalManager extends CoreManager
{
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->repository = 'FDCCoreBundle:FilmFestival';
        $this->wsParameterKey = 'idFestival';
        $this->wsMethod = 'GetFestival';
        $this->wsResultKey = 'GetFestivalResult';
        $this->wsResultObjectKey = 'FestivalDto';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setYear' => 'Annee'
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmFestival();
        $persist = ($entity->getId() === null) ? true : false;

        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
        
        return $entity;
    }

    public function getModified($from, $to)
    {
        $this->wsMethod = 'GetModifiedFestivals';
        $this->wsResultKey = 'GetModifiedFestivalsResult';
         
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to));
        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        $entities = array();
        $persists = array();
        
        foreach ($resultObject as $object) {
            // create / get entity
            $entity = ($this->findOneById(array('id' => $object->{$this->entityIdKey}))) ?: new FilmFestival();
            $persists[] = ($entity->getId() === null) ? true : false;
            
            // set soif last update time
            $this->setSoifUpdatedAt($result, $entity);
            
            // set entity properties
            $this->setEntityProperties($object, $entity);
            
            $entities[] = $entity;
        }
        
        // update entity
        $this->updates($entities, $persists);
        
        // end timer
        $this->end(__METHOD__);
    }
}