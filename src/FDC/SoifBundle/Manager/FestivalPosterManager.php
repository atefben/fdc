<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmFestivalPoster;
use FDC\CoreBundle\Entity\FilmFestivalPosterTranslation;

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
     * mediaStreamManager
     * 
     * @var mixed
     * @access private
     */
    private $mediaStreamManager;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager, $mediaStreamManager)
    {
        $this->festivalManager = $festivalManager;
        $this->mediaStreamManager = $mediaStreamManager;
        $this->entityIdKey = 'Id';
        $this->repository = 'FDCCoreBundle:FilmFestivalPoster';
        $this->wsParameterKey = 'idPoster';
        $this->wsMethod = 'GetPoster';
        $this->wsResultKey = 'GetPosterResult';
        $this->wsResultObjectKey = 'PosterDto';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setCopyright' => 'Droits',
            'setType' => 'Type'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'FestivalId',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            )
        );
        
        $this->mapperTranslations = array(
            'TraductionElementMultimedias' => array(
                'result' => 'TraductionElementMultimediaDto',
                'setters' => array(
                    'setDescription' => 'Description',
                    'setTitle' => 'Libelle'
                ),
                'wsLangKey' => 'Culture'
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

        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmFestivalPoster();
        $persist = ($entity->getId() === null) ? true : false;
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set media
        $media = $this->mediaStreamManager->updateEntity($entity, $resultObject->ElementMultimediaId, 'jpg');
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmFestivalPosterTranslation());
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
        
        return $entity;
    }
}