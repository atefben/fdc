<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmPerson;
use FDC\CoreBundle\Entity\FilmPersonTranslation;

/**
 * PersonManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
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
        $this->wsMethod = 'GetPersonne';
        $this->wsResultKey = 'GetPersonneResult';
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
                'setter' => 'setBiography',
                'wsKey' => 'Description'
            ),
            'ProfessionTraductions' => array(
                'result' => 'ProfessionTraductionDto',
                'setter' => 'setProfession',
                'wsKey' => 'Libelle'
            ),
        );
    }
    
    /**
     * updateEntity function.
     * 
     * @access public
     * @param mixed $id
     * @return void
     *
     * @todo save PersonneFilmDto
     */
    public function updateEntity($id)
    {
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));
        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        
        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmPerson();
        $persist = ($entity->getId() === null) ? true : false;
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmPersonTranslation());
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}