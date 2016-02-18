<?php

namespace Base\SoifBundle\Manager;

use \Exception;

use Base\CoreBundle\Entity\FilmMedia;
use Base\CoreBundle\Entity\FilmFilmMedia;

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
     * mediaCategoryManager
     * 
     * @var mixed
     * @access private
     */
    private $mediaCategoryManager;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager, $mediaStreamManager, $mediaCategoryManager)
    {
        $this->festivalManager = $festivalManager;
        $this->mediaStreamManager = $mediaStreamManager;
        $this->mediaCategoryManager = $mediaCategoryManager;
        $this->repository = 'BaseCoreBundle:FilmMedia';
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
                'repository' => 'BaseCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            ),
            array(
                'repository' => 'BaseCoreBundle:FilmMediaCategory',
                'soapKey' => 'IdType',
                'setter' => 'setCategory',
                'manager' => $this->mediaCategoryManager
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
        $this->wsMethod = 'GetElementMultimedia';
        $this->wsResultKey = 'GetElementMultimediaResult';
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));

        if (!isset($result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey})) {
            $this->logger->warn($this->wsMethod . " {$id} not found");
            return null;
        }

        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        
        // set entity
        $entity = $this->set($resultObject, $result);
        
        // save entity
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
        $this->wsMethod = 'GetModifiedElementMultimedia';
        $this->wsResultKey = 'GetModifiedElementMultimediaResult';

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

        // set entities
        foreach ($resultObjects as $resultObject) {
            $entity = $this->set($resultObject, $result);
            $this->update($entity);
        }

        
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
        $this->wsMethod = 'GetRemovedElementMultimedia';
        $this->wsResultKey = 'GetRemovedElementMultimediaResult';
         
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmMedia();
        $persist = ($entity->getId() === null) ? true : false;

        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);

        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // set related media
        $this->mediaStreamManager->getById($entity, $resultObject->{$this->entityIdKey}, $this->mimeToExtension($resultObject->ContentType),'sonata.media.provider.image',$this->typeToContext($resultObject->IdType));

        return $entity;
    }

    private function typeToContext($type){
        $context = 'film_film';
        switch($type) {
            case FilmFilmMedia::TYPE_DIRECTOR:
                $context = 'film_director';
                break;
            case FilmFilmMedia::TYPE_POSTER:
                $context = 'film_poster';
                break;
            case FilmFilmMedia::TYPE_MAIN:
                $context = 'film_main';
                break;
            case FilmFilmMedia::TYPE_FILM:
                $context = 'film_film';
                break;
        }

        return $context;

    }
}