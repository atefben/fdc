<?php

namespace FDC\SoifBundle\Manager;

use Doctrine\Common\Collections\ArrayCollection;

use FDC\CoreBundle\Entity\FilmAward;
use FDC\CoreBundle\Entity\FilmAwardAssociation;

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
     * filmManager
     * 
     * @var mixed
     * @access private
     */
    private $filmManager;

    /**
     * personManager
     * 
     * @var mixed
     * @access private
     */
    private $personManager;
    
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager, $prizeManager, $filmManager, $personManager)
    {
        $this->festivalManager = $festivalManager;
        $this->prizeManager = $prizeManager;
        $this->filmManager = $filmManager;
        $this->personManager = $personManager;
        $this->repository = 'FDCCoreBundle:FilmAward';
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
     * getById function.
     * 
     * @access public
     * @param mixed $id
     * @return void
     */
    public function getById($id)
    {
        $this->wsMethod = 'GetAward';
        $this->wsResultKey = 'GetAwardResult';

        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));
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
        $this->wsMethod = 'GetModifiedAwards';
        $this->wsResultKey = 'GetModifiedAwardsResult';
         
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
        $entities = array();
        
        // set entities
        foreach ($resultObjects as $resultObject) {
            $entities[] = $this->set($resultObject, $result);
        }
        
        // save entities
        $this->updateMultiple($entities);
        
        
        
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
        $this->wsMethod = 'GetRemovedAwards';
        $this->wsResultKey = 'GetRemovedAwardsResult';
         
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
     * @param mixed $object
     * @param mixed $result
     * @return void
     */
    private function set($resultObject, $result)
    {
        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmAward();
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);

        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // set associations
        if (property_exists($resultObject, 'ListeFilmPersonne') && property_exists($resultObject->ListeFilmPersonne, 'RecompenseFilmPersonneDto')) {
            $collectionNew = new ArrayCollection();
            $resultObject->ListeFilmPersonne->RecompenseFilmPersonneDto = $this->mixedToArray($resultObject->ListeFilmPersonne->RecompenseFilmPersonneDto);
            foreach ($resultObject->ListeFilmPersonne->RecompenseFilmPersonneDto as $obj) {
                $entityRelated = $this->em->getRepository('FDCCoreBundle:FilmAwardAssociation')->findOneBy(array(
                    'film' => $obj->Film,
                    'person' => $obj->Persons,
                    'position' => $obj->Ordre
                ));
                $entityRelated = ($entityRelated !== null) ? $entityRelated : new FilmAwardAssociation();
                $entityRelated->setPosition($obj->Ordre);
                if ($obj->Film !== null) {
                    $film = $this->em->getRepository('FDCCoreBundle:FilmFilm')->findOneById(array('id' => $obj->Film));
                    $film = ($film !== null) ? $film : $this->filmManager->getById($obj->Film);
                    
                    if ($film !== null) {
                        $entityRelated->setFilm($film);
                    }
                }
                $person = $this->em->getRepository('FDCCoreBundle:FilmPerson')->findOneById(array('id' => $obj->Persons));
                if ($person === null) {
                    $person = $this->personManager->getById($obj->Persons);
                }
                $entityRelated->setPerson($person);
                $entity->addAssociation($entityRelated);
                // save in array all the entities
                $collectionNew->add($entityRelated);
            }
            
            // remove old relations
            $this->removeOldRelations($entity->getAssociations(), $collectionNew, $entity, 'removeAssociation');
        }

        return $entity;
    }
}