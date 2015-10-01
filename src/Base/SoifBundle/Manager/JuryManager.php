<?php

namespace Base\SoifBundle\Manager;

use \Exception;

use Base\CoreBundle\Entity\FilmJury;
use Base\CoreBundle\Entity\FilmJuryFunction;
use Base\CoreBundle\Entity\FilmJuryFunctionTranslation;
use Base\CoreBundle\Entity\FilmJuryType;
use Base\CoreBundle\Entity\FilmJuryTypeTranslation;
use Base\CoreBundle\Entity\FilmJuryTranslation;

/**
 * JuryManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class JuryManager extends CoreManager
{
    /**
     * festivalManager
     * 
     * @var mixed
     * @access private
     */
    private $festivalManager;

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
     * @param mixed $festivalManager
     * @return void
     */
    public function __construct($festivalManager, $personManager)
    {
        $this->festivalManager = $festivalManager;
        $this->personManager = $personManager;
        $this->repository = 'BaseCoreBundle:FilmJury';
        $this->wsResultObjectKey = 'JuryDto';
        $this->wsParameterKey = 'idJury';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setPosition' => 'OrdreAffichage'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'BaseCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            ),
            array(
                'repository' => 'BaseCoreBundle:FilmPerson',
                'soapKey' => 'IdPersonne',
                'setter' => 'setPerson',
                'manager' => $this->personManager
            )
        );
        $this->mapperTranslations = array(
            'BiographiesTraductions' => array(
                'result' => 'BiographieTraductionDto',
                'setters' => array(
                    'setBiography' => 'Description'
                ),
                'wsLangKey' => 'CodeLangue'
            )
        );
        $this->mapperEntityTranslations = array(
            'Fonction' => array(
                'repository' => 'BaseCoreBundle:FilmJuryFunction',
                'result' => 'FonctionTraductionDto',
                'setter' => 'setFunction',
                'setterTranslation' => 'setName',
                'wsKey' => 'Libelle',
                'entity' =>  new FilmJuryFunction(),
                'entityTranslation' => new FilmJuryFunctionTranslation()
            ),
            'TypeJury' => array(
                'repository' => 'BaseCoreBundle:FilmJuryType',
                'result' => 'TypeJuryTraductionDto',
                'setter' => 'setType',
                'setterTranslation' => 'setName',
                'wsKey' => 'Libelle',
                'entity' =>  new FilmJuryType(),
                'entityTranslation' => new FilmJuryTypeTranslation()
                
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
        $this->wsMethod = 'GetJury';
        $this->wsResultKey = 'GetJuryResult';
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
        $this->wsMethod = 'GetModifiedJuries';
        $this->wsResultKey = 'GetModifiedJuriesResult';
        
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
        $this->wsMethod = 'GetRemovedJuries';
        $this->wsResultKey = 'GetRemovedJuriesResult';
         
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmJury();

        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);

        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set entity related
        $this->setEntityRelated($resultObject, $entity);
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmJuryTranslation());
        
        // set entity related translations
        $this->setEntityRelatedTranslations($resultObject, $entity);
        
        // flush after added related entity 
        $this->update($entity);
        
        return $entity;
    }
}