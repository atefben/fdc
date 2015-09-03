<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmJury;
use FDC\CoreBundle\Entity\FilmJuryFunction;
use FDC\CoreBundle\Entity\FilmJuryFunctionTranslation;
use FDC\CoreBundle\Entity\FilmJuryType;
use FDC\CoreBundle\Entity\FilmJuryTypeTranslation;
use FDC\CoreBundle\Entity\FilmJuryTranslation;

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
        $this->repository = 'FDCCoreBundle:FilmJury';
        $this->wsMethod = 'GetJury';
        $this->wsResultKey = 'GetJuryResult';
        $this->wsResultObjectKey = 'JuryDto';
        $this->wsParameterKey = 'idJury';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setPosition' => 'OrdreAffichage'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            ),
            array(
                'repository' => 'FDCCoreBundle:FilmPerson',
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
                'repository' => 'FDCCoreBundle:FilmJuryFunction',
                'result' => 'FonctionTraductionDto',
                'setter' => 'setFunction',
                'setterTranslation' => 'setName',
                'wsKey' => 'Libelle',
                'entity' =>  new FilmJuryFunction(),
                'entityTranslation' => new FilmJuryFunctionTranslation()
            ),
            'TypeJury' => array(
                'repository' => 'FDCCoreBundle:FilmJuryType',
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmJury();
        $persist = ($entity->getId() === null) ? true : false;

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
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}