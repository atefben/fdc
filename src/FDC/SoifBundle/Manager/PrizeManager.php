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
        $this->wsMethod = 'GetPrize';
        $this->wsResultKey = 'GetPrizeResult';
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
        var_dump($resultObject);
        
        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmPrize();
        $persist = ($entity->getId() === null) ? true : false;
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmPrizeTranslation());
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}