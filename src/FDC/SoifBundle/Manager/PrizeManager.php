<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmPrize;
use FDC\CoreBundle\Entity\FilmPrizeTranslation;

/**
 * PrizeManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class PrizeManager extends CoreManager
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
        $this->repository = 'FDCCoreBundle:FilmPrize';
        $this->wsParameterKey = 'idPrix';
        $this->wsResultObjectKey = 'PrixDto';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setPosition' => 'OrdreGeneral',
            'setType' => 'TypePrix'
        );
        $this->mapperTranslations = array(
            'CategorieTraductions' => array(
                'result' => 'CategoriePrixTraductionDto',
                'setters' => array(
                    'setTitle' => 'Libelle'
                ),
                'wsLangKey' => 'CodeLangue'
            ),
            'TitreTraductions' => array(
                'result' => 'TitreTraductionDto',
                'setters' => array(
                    'setCategory' => 'Titre'
                ),
                'wsLangKey' => 'CodeLangue'
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
        $this->wsMethod = 'GetPrize';
        $this->wsResultKey = 'GetPrizeResult';
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
        $this->wsMethod = 'GetModifiedPrizes';
        $this->wsResultKey = 'GetModifiedPrizesResult';

        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to), false);
        // verify if we have results
        if (!isset($result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey})) {
            $this->logger->info("No entities found for timestamp interval {$from} - > {$to} ");
            return;
        }
        $resultObjects = $this->objectToArray($result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey});
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmPrize();
        $persist = ($entity->getId() === null) ? true : false;
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmPrizeTranslation());
        
        return $entity;
    }
}