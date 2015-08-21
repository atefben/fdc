<?php

namespace FDC\SoifBundle\Manager;

use FDC\CoreBundle\Entity\FilmProjection;
use FDC\CoreBundle\Entity\FilmProjectionMedia;
use FDC\CoreBundle\Entity\FilmProjectionRoom;

/**
 * ProjectionManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class ProjectionManager extends CoreManager
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
        // managers
        $this->festivalManager = $festivalManager;
        // webservice properties
        $this->entityIdKey = 'Id';
        $this->repository = 'FDCCoreBundle:FilmProjection';
        $this->wsParameterKey = 'idAgenda';
        $this->wsMethod = 'GetAgenda';
        $this->wsResultKey = 'GetAgendaResult';
        $this->wsResultObjectKey = 'SeanceProgrammationDto';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setStartsAt' => 'DateDebut',
            'setEndsAt' => 'DateFin',
            'setType' => 'TypeProjection'
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
     */
    public function updateEntity($id)
    {
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));
        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        
        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmProjection();
        $persist = ($entity->getId() === null) ? true : false;
        $entity->setId($resultObject->{$this->entityIdKey});
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // set elements multimedia
        if (property_exists($resultObject, 'ElementsMultimediaSeance') && property_exists($resultObject->ElementsMultimediaSeance, 'FilmProgrammationObjectDto')) {
            $filmProjectionMedias = $entity->getMedias();
            foreach ($resultObject->FilmElementsMultimedias->ElementMultimediaRefDto as $media) {
                $entityRelated = $entity->hasMedia($media->soifId);
                $entityRelated = ($entityRelated !== null) ? $entityRelated : new FilmProjectionMedia();
                $entityRelated->setFilename($media->FileName);
                $entityRelated->setType($media->IdType);
                $entityRelated->setPosition($$media->Ordre);
            }
            // get the media
            $filmMedia = $this->mediaManager->updateEntity($filmFilmMedia->Id);
            $entityRelated->setMedia($filmMedia);
            $entityRelated->setFilm($entity);
                
            if ($entityRelated->getid() !== null) {
                $entity->addMedia($entityRelated);
            }
        }
        var_dump($resultObject);
        // set projection room
        $filmProjectionRoom = $this->em->getRepository('FDCCoreBundle:FilmProjectionRoom')->findOneBy(array('id' => $resultObject->IdSalle));
        $filmProjectionRoom = ($filmProjectionRoom !== null) ? $filmProjectionRoom : new FilmProjectionRoom();
        $filmProjectionRoom->setId($resultObject->IdSalle);
        $filmProjectionRoom->setName($resultObject->Salle);
        $entity->setRoom($filmProjectionRoom);
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}