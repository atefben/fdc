<?php

namespace Base\SoifBundle\Manager;

use \Exception;

use Base\CoreBundle\Entity\FilmFestivalPoster;
use Base\CoreBundle\Entity\FilmFestivalPosterTranslation;

/**
 * FestivalPosterManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
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
        $this->repository = 'BaseCoreBundle:FilmFestivalPoster';
        $this->wsParameterKey = 'idPoster';
        $this->wsResultObjectKey = 'PosterDto';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setCopyright' => 'Droits',
            'setType' => 'Type'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'BaseCoreBundle:FilmFestival',
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
        $this->wsMethod = 'GetPoster';
        $this->wsResultKey = 'GetPosterResult';

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
        $this->wsMethod = 'GetModifiedPosters';
        $this->wsResultKey = 'GetModifiedPostersResult';
         
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
        $this->wsMethod = 'GetRemovedPoster';
        $this->wsResultKey = 'GetRemovedPosterResult';
         
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmFestivalPoster();
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set media
        $media = $this->mediaStreamManager->getById($entity, $resultObject->ElementMultimediaId, 'jpg');
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmFestivalPosterTranslation());
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        return $entity;
    }
}