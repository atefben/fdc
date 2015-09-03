<?php

namespace FDC\SoifBundle\Manager;

use FDC\CoreBundle\Entity\FilmAward;

/**
 * AwardManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class AwardManager extends CoreManager
{
    /**
     * festivalManager
     * 
     * @var mixed
     * @access private
     */
    private $festivalManager;
    
    /**
     * prizeManager
     * 
     * @var mixed
     * @access private
     */
    private $prizeManager;
    
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager, $prizeManager)
    {
        $this->festivalManager = $festivalManager;
        $this->prizeManager = $prizeManager;
        $this->repository = 'FDCCoreBundle:FilmAward';
        $this->wsMethod = 'GetAward';
        $this->wsResultKey = 'GetAwardResult';
        $this->wsResultObjectKey = 'RecompenseDto';
        $this->wsParameterKey = 'idAward';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setComment' => 'Commentaire',
            'setExAequo' => 'ExAequo',
            'setFilmMutual' => 'CommunFilm',
            'setPersonMutual' => 'CommunPersonne',
            'setPosition' => 'OrdreAffichage',
            'setUnanimity' => 'Unanimite'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            ),
            array(
                'repository' => 'FDCCoreBundle:FilmPrize',
                'soapKey' => 'IdPrix',
                'setter' => 'setPrize',
                'manager' => $this->prizeManager
            )
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmAward();
        $persist = ($entity->getId() === null) ? true : false;
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);

        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
    
    public function getModified($from, $to)
    {
        $this->wsMethod = 'GetModifiedAwards';
        $this->wsResultKey = 'GetModifiedAwardsResult';
         
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