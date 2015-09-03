<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmMedia;

/**
 * MediaManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class MediaManager extends CoreManager
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
        $this->repository = 'FDCCoreBundle:FilmMedia';
        $this->wsMethod = 'GetElementMultimedia';
        $this->wsResultKey = 'GetElementMultimediaResult';
        $this->wsResultObjectKey = 'ElementMultimediaDto';
        $this->wsParameterKey = 'idElementMultimedia';
        $this->entityIdKey = 'IdSoif';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setCopyright' => 'Copyright',
            'setContentType' => 'ContentType',
            'setTitleVf' => 'LibelleFr',
            'setTitleVa' => 'LibelleEn',
            'setType' => 'Type'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            ),
            array(
                'repository' => 'FDCCoreBundle:FilmMediaCategory',
                'soapKey' => 'IdCategorie',
                'setter' => 'setCategory',
                'manager' => null
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmMedia();
        $persist = ($entity->getId() === null) ? true : false;

        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);

        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // set related media
        $this->mediaStreamManager->updateEntity($entity, $resultObject->{$this->entityIdKey}, $this->mimeToExtension($resultObject->ContentType));
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
        
        return $entity;
    }
}