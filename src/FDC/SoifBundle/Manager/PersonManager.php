<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmPerson;
use FDC\CoreBundle\Entity\FilmPersonTranslation;

/**
 * PersonManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class PersonManager extends CoreManager
{
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->entityIdKey = 'Id';
        $this->repository = 'FDCCoreBundle:FilmPerson';
        $this->wsParameterKey = 'idPersonne';
        $this->wsResultObjectKey = 'PersonneDto';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setAsianName' => 'IsAsianName',
            'setNationality' => 'Nationalite',
            'setNationality2' => 'NationaliteSecondaire',
            'setLastname' => 'Nom',
            'setFirstname' => 'Prenom'
        );
        $this->mapperTranslations = array(
            'BiographieTraductions' => array(
                'result' => 'BiographieTraductionDto',
                'setters' => array(
                    'setBiography' => 'Description'
                ),
                'wsLangKey' => 'CodeLangue'
            ),
            'ProfessionTraductions' => array(
                'result' => 'ProfessionTraductionDto',
                'setters' => array(
                    'setProfession' => 'Libelle'
                ),
                'wsLangkey' => 'CodeLangue'
            )
        );
    }
    
    /**
     * getById function.
     * 
     * @access public
     * @param mixed $id
     * @return void
     *
     * @todo save PersonneFilmDto
     */
    public function getById($id)
    {
        $this->wsMethod = 'GetPersonne';
        $this->wsResultKey = 'GetPersonneResult';
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));
        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        
        // set entity
        $entity = $this->set($resultObject, $result);
        
        // update entity
        $this->update($entity);
        
        // end timer
        $this->end(__METHOD__);
        
        return $entity;
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
        $this->wsMethod = 'GetModifiedPersons';
        $this->wsResultKey = 'GetModifiedPersonsResult';

        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to), false);
        // verify if we have results
        if (!isset($result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey})) {
            $this->logger->info("No entities found for timestamp interval {$from} - > {$to} ");
            return;
        }
        $resultObjects = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        $entities = array();
        
        // set entities
        foreach ($resultObjects as $resultObject) {
            $entities[] = $this->set($resultObject, $result);
        }

        // save entities
        $this->updates($entities);
        
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
        $this->wsMethod = 'GetRemovedPersons';
        $this->wsResultKey = 'GetRemovedPersonsResult';
         
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to), false);
        $resultObjects = $result->{$this->wsResultKey}->Resultats;
        
        // loop twice because results are returned in an array (int, long, etc...)
        foreach ($resultObjects as $objs) {
            foreach ($objs as $id) {
                $this->remove($id);
            }
        }
        
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmPerson();
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmPersonTranslation());
        
        return $entity;
    }
}