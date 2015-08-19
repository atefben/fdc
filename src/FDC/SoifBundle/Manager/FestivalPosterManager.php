<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmFestivalPoster;

/**
 * FestivalPosterManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class FestivalPosterManager extends CoreManager
{
    /**
     * festivalManager
     * 
     * @var mixed
     * @access private
     */
    private $festivalManager;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager)
    {
        $this->festivalManager = $festivalManager;
        $this->entityIdKey = 'Id';
        $this->repository = 'FDCCoreBundle:FilmFestivalPoster';
        $this->wsParameterKey = 'idPoster';
        $this->wsMethod = 'GetPoster';
        $this->wsResultKey = 'GetPosterResult';
        $this->wsResultObjectKey = 'PosterDto';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setCopyright' => 'Droits',
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            )
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
        var_dump($result);
        var_dump($resultObject);
        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmFestivalPoster();
        $persist = ($entity->getId() === null) ? true : false;
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set translations
        //$this->setEntityTranslations($resultObject, $entity, new FilmPersonTranslation());
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
        
        return $entity;
    }
}