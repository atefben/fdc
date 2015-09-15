<?php

namespace FDC\SoifBundle\Manager;

use Doctrine\Common\Collections\ArrayCollection;

use FDC\CoreBundle\Entity\FilmProjection;
use FDC\CoreBundle\Entity\FilmProjectionMedia;
use FDC\CoreBundle\Entity\FilmProjectionRoom;
use FDC\CoreBundle\Entity\FilmProjectionProgrammationDynamic;
use FDC\CoreBundle\Entity\FilmProjectionProgrammationFilm;
use FDC\CoreBundle\Entity\FilmProjectionProgrammationFilmList;
use FDC\CoreBundle\Entity\FilmProjectionProgrammationType;

/**
 * ProjectionManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
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
     * filmManager
     * 
     * @var mixed
     * @access private
     */
    private $filmManager;
    
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
    public function __construct($festivalManager, $filmManager, $mediaStreamManager)
    {
        // managers
        $this->festivalManager = $festivalManager;
        $this->filmManager = $filmManager;
        $this->mediaStreamManager = $mediaStreamManager;
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
        if (property_exists($resultObject, 'ElementsMultimediaSeance') && property_exists($resultObject->ElementsMultimediaSeance, 'ElementMultimediaRefDto')) {
            $collectionNew = new ArrayCollection();
            $filmProjectionMedias = $entity->getMedias();
            // verify type and set array as default
            $resultObject->ElementsMultimediaSeance->ElementMultimediaRefDto = $this->objectToArray($resultObject->ElementsMultimediaSeance->ElementMultimediaRefDto);
            // loop through each element
            foreach ($resultObject->ElementsMultimediaSeance->ElementMultimediaRefDto as $media) {
                $entityRelated = $entity->hasMedia($media->Id);
                $entityRelated = ($entityRelated !== null) ? $entityRelated : new FilmProjectionMedia();
                $entityRelated->setFilename($media->FileName);
                $entityRelated->setType($media->IdType);
                $entityRelated->setPosition($media->Ordre);
            }
            // set the media file
            $this->mediaStreamManager->updateEntity($entityRelated, $media->Id, $this->mimeToExtension($media->ContentType));
            // save in entity
            $entity->addMedia($entityRelated);
            // save in array all the entities
            $collectionNew->add($entityRelated);
            
            // remove old relations
            $this->removeOldRelations($entity->getMedias(), $collectionNew, $entity, 'removeMedia');
        }
        
        // set projection room
        $filmProjectionRoom = $this->em->getRepository('FDCCoreBundle:FilmProjectionRoom')->findOneBy(array('id' => $resultObject->IdSalle));
        $filmProjectionRoom = ($filmProjectionRoom !== null) ? $filmProjectionRoom : new FilmProjectionRoom();
        $filmProjectionRoom->setId($resultObject->IdSalle);
        $filmProjectionRoom->setName($resultObject->Salle);
        $entity->setRoom($filmProjectionRoom);
        
        // TO DO section programmation / dynamic programmation object / film programmation object / film list programmation object
        
        // set section programmation
        if (property_exists($resultObject, 'SectionProgrammation')) {
            $entity->setProgrammationSection($resultObject->SectionProgrammation->Libelle);
            foreach ($resultObject->SectionProgrammation->Traductions as $translation) {
                $entityTranslation = $entity->findTranslationByLocale($translation->CodeLangue);
                $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new FilmProjectionTranslation();
                $entityTranslation->setProgramSection($translation->Libelle);
                $entityTranslation->setLocale($localesMapper[$translation->CodeLangue]);
                
                if ($entityTranslation->getId() === null) {
                    $entity->addTranslation($entityTranslation);
                }
            }
        }

        // set dynamic programmation object
        if (property_exists($resultObject, 'DynamicProgrammationObject') && property_exists($resultObject->DynamicProgrammationObject, 'DynamicProgrammationObjectDto')) {
            $collectionNew = new ArrayCollection();
            // verify type and set array as default
            $resultObject->DynamicProgrammationObject->DynamicProgrammationObjectDto = $this->objectToArray($resultObject->DynamicProgrammationObject->DynamicProgrammationObjectDto);
            foreach ($resultObject->DynamicProgrammationObject->DynamicProgrammationObjectDto as $obj) {
                // create related entity
                $programmationDynamic = $this->em->getRepository('FDCCoreBundle:FilmProjectionProgrammationDynamic')->findOneBy(array(
                    'type' => $obj->IdTypeProgrammation,
                    'projection' => $entity->getId()
                ));
                $programmationDynamic = ($programmationDynamic != null) ? $programmationDynamic : new FilmProjectionProgrammationDynamic();
                $programmationDynamic->setProjection($entity);
                $programmationDynamic->setDuration($obj->DureeTypeProgrammation);
                // set type
                $programmationType = $this->em->getRepository('FDCCoreBundle:FilmProjectionProgrammationType')->findOneBy(array('id' => $obj->IdTypeProgrammation));
                $programmationType = ($programmationType != null) ? $programmationType : new FilmProjectionProgrammationType();
                $programmationType->setId($obj->IdTypeProgrammation);
                $programmationType->setName($obj->NomTypeProgrammation);
                $programmationDynamic->setType($programmationType);
                // save in entity
                $entity->addProgrammationDynamic($programmationDynamic);
                // save in array all the entities
                $collectionNew->add($programmationDynamic);
            }
            
            // remove old relations
            $this->removeOldRelations($entity->getProgrammationDynamics(), $collectionNew, $entity, 'removeProgrammationDynamic');
            
            // delete collection to free memory
            unset($programmationDynamics);
        }
        
        // set film programmation object
        if (property_exists($resultObject, 'FilmProgrammationObject') && property_exists($resultObject->FilmProgrammationObject, 'FilmProgrammationObjectDto')) {
            $collectionNew = new ArrayCollection();
            // verify type and set array as default
            $resultObject->FilmProgrammationObject->FilmProgrammationObjectDto = $this->objectToArray($resultObject->FilmProgrammationObject->FilmProgrammationObjectDto);
            foreach ($resultObject->FilmProgrammationObject->FilmProgrammationObjectDto as $obj) {
                // create / get related entity
                $programmationFilm = $this->em->getRepository('FDCCoreBundle:FilmProjectionProgrammationFilm')->findOneBy(array(
                    'type' => $obj->IdTypeProgrammation,
                    'film' => $obj->IdFilm,
                    'projection' => $entity->getId()
                ));
                $programmationFilm = ($programmationFilm != null) ? $programmationFilm : new FilmProjectionProgrammationFilm();
                // set film
                $film = $this->em->getRepository('FDCCoreBundle:FilmFilm')->findOneBy(array('id' => $obj->IdFilm));
                if ($film == null) {
                    $film = $this->filmManager->updateEntity($obj->IdFilm);
                }
                $programmationFilm->setFilm($film);
                // set type
                $programmationType = $this->em->getRepository('FDCCoreBundle:FilmProjectionProgrammationType')->findOneBy(array('id' => $obj->IdTypeProgrammation));
                $programmationType = ($programmationType != null) ? $programmationType : new FilmProjectionProgrammationType();
                $programmationType->setId($obj->IdTypeProgrammation);
                $programmationType->setName($obj->NomTypeProgrammation);
                $programmationType->setType($obj->TypeObjetProgrammation);
                $programmationFilm->setType($programmationType);
                // save in entity
                $entity->addProgrammationFilm($programmationFilm);
                // save in collection all the entities
                $collectionNew->add($programmationFilm);
            }
            
            // remove old relations
            $this->removeOldRelations($entity->getProgrammationFilms(), $collectionNew, $entity, 'removeProgrammationFilm');

            // delete collection to free memory
            unset($programmationFilms);
        }
        
        // set film list programmation object
        if (property_exists($resultObject, 'FilmsListProgrammationObject') && property_exists($resultObject->FilmProgrammationObject, 'FilmsListProgrammationObjectDto')) {
            $collectionNew = new ArrayCollection();
            $collectionFilmsNew = new ArrayCollection();
            // verify type and set array as default
            $resultObject->FilmsListProgrammationObject->FilmsListProgrammationObjectDto = $this->objectToArray($resultObject->FilmsListProgrammationObject->FilmsListProgrammationObjectDto);
            foreach ($resultObject->FilmsListProgrammationObject->FilmsListProgrammationObjectDto as $obj) {
                // create related entity
                $programmationFilmList = $this->em->getRepository('FDCCoreBundle:FilmProjectionProgrammationFilm')->findOneBy(array(
                    'type' => $obj->IdTypeProgrammation,
                    'projection' => $entity->getId()
                ));
                $programmationFilmList = ($programmationFilmList != null) ? $programmationFilmList : new FilmProjectionProgrammationFilmList();
                $programmationFilmList->setProjection($entity);
                // add films
                foreach ($obj->IdsFilm as $filmId) {
                    $film = $this->em->getRepository('FDCCoreBundle:FilmFilm')->findOneBy(array('id' => $filmId));
                    if ($film == null) {
                        $film = $this->filmManager->updateEntity($filmId);
                    }
                    // save in entity
                    $programmationFilmList->addFilm($film);
                    // save in collection all the entities
                    $collectionFilmsNew->add($film);
                }
                
                // remove old relations
                $this->removeOldRelations($programmationFilmList->getFilms(), $collectionFilmsNew, $entity, 'removeFilm');
            
                // delete array to free memory
                unset($films);
                
                // set type
                $programmationType = $this->em->getRepository('FDCCoreBundle:FilmProjectionProgrammationType')->findOneBy(array('id' => $obj->IdTypeProgrammation));
                $programmationType = ($programmationType != null) ? $programmationType : new FilmProjectionProgrammationType();
                $programmationType->setId($obj->IdTypeProgrammation);
                $programmationType->setName($obj->NomTypeProgrammation);
                $programmationFilmList->setType($programmationType);
                // save in entity
                $entity->addProgrammationFilmList($programmationFilmList);
                // save in array all the entities
                $collectionNew->add($programmationFilmList);
            }
            
            // remove old relations
            $this->removeOldRelations($entity->getProgrammationFilmsList(), $collectionNew, $entity, 'removeProgrammationFilmsList');
            
            // delete collection to free memory
            unset($programmationFilmList);
        }

        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
    
    private function recursive_array_diff($a1, $a2) { 
    $r = array(); 
    foreach ($a1 as $k => $v) {
        if (array_key_exists($k, $a2)) { 
            if (is_array($v)) { 
                $rad = recursive_array_diff($v, $a2[$k]); 
                if (count($rad)) { $r[$k] = $rad; } 
            } else { 
                if ($v != $a2[$k]) { 
                    $r[$k] = $v; 
                }
            }
        } else { 
            $r[$k] = $v; 
        } 
    } 
    return $r; 
}
}