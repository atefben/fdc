<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use Doctrine\Common\Collections\ArrayCollection;

use FDC\CoreBundle\Entity\FilmPerson;
use FDC\CoreBundle\Entity\FilmPersonTranslation;
use FDC\CoreBundle\Entity\FilmFilmPerson;
use FDC\CoreBundle\Entity\FilmFilmPersonFunction;
use FDC\CoreBundle\Entity\FilmFunction;
use FDC\CoreBundle\Entity\FilmFunctionTranslation;

/**
 * PersonManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
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
        $this->wsResultObjectKey = 'PersonneDto';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setAsianName' => 'IsAsianName',
            'setLastname' => 'Nom',
            'setFirstname' => 'Prenom'
        );
        $this->mapperTranslations = array(
            'BiographieTraductions' => array(
                'result' => 'BiographieTraductionDto',
                'setters' => array(
                    'setBiography' => 'Description'
                ),
                'wsLangKey' => 'CodeLangue'
            ),
            'ProfessionTraductions' => array(
                'result' => 'ProfessionTraductionDto',
                'setters' => array(
                    'setProfession' => 'Libelle'
                ),
                'wsLangkey' => 'CodeLangue'
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
        $this->wsMethod = 'GetPersonne';
        $this->wsResultKey = 'GetPersonneResult';
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
        
        // update entity
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
        $this->wsMethod = 'GetModifiedPersons';
        $this->wsResultKey = 'GetModifiedPersonsResult';

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
        $entities = array();
        
        // set entities
        foreach ($resultObjects as $resultObject) {
            $entities[] = $this->set($resultObject, $result);
        }

        // save entities
        $this->updateMultiple($entities);
        
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
        $this->wsMethod = 'GetRemovedPersons';
        $this->wsResultKey = 'GetRemovedPersonsResult';
         
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmPerson();
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set nationality
        $country = $this->em->getRepository('FDCCoreBundle:Country')->findOneByIso($resultObject->Nationalite);
        if ($country === null) {
            $msg = __METHOD__. "Country {$resultObject->Nationalite} not found";
            $this->logger->warn($msg);
        } else {
            $entity->setNationality($country);
        }
        
        // set nationality2
        $country = $this->em->getRepository('FDCCoreBundle:Country')->findOneByIso($resultObject->NationaliteSecondaire);
        if ($country === null) {
            $msg = __METHOD__. "Country {$resultObject->NationaliteSecondaire} not found";
            $this->logger->warn($msg);
        } else {
            $entity->setNationality2($country);
        }
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmPersonTranslation());
        
        // set films
        if (property_exists($resultObject, 'PersonneFilms') && property_exists($resultObject->PersonneFilms, 'PersonneFilmDto')) {
            $collection = new ArrayCollection();
            $localesMapper = $this->getLocalesMapper();
            $resultObject->PersonneFilms->PersonneFilmDto = $this->mixedToArray($resultObject->PersonneFilms->PersonneFilmDto);
            $collectionFunctions = new ArrayCollection();
            foreach ($resultObject->PersonneFilms->PersonneFilmDto as $obj) {
                $entityRelated = $this->em->getRepository('FDCCoreBundle:FilmFilmPerson')->findOneBy(array(
                    'film' => $obj->IdFilm,
                    'person' => $entity->getId(),
                ));
                $entityRelated = ($entityRelated !== null) ? $entityRelated : new FilmFilmPerson();
                
                $film = $this->em->getRepository('FDCCoreBundle:FilmFilm')->findOneById(array('id' => $obj->IdFilm));
                if ($film === null) {
                    $msg = __METHOD__. " Film {$obj->IdFilm} not found, call php app/console fdc:soif:get_film {$obj->IdFilm} to import it";
                    $this->logger->warn($msg);
                    continue;
                }
                $entityRelated->setFilm($film);
                // set functions
                if (isset($obj->FonctionsTraductions) &&
                    isset($obj->FonctionsTraductions->FonctionTraductionDto)  &&
                    count($obj->FonctionsTraductions->FonctionTraductionDto) > 0) {
                    $entityRelatedFunction = $this->em->getRepository('FDCCoreBundle:FilmFilmPersonFunction')->findOneBy(array(
                        'filmPerson' => $entityRelated->getId(),
                        'function' => $obj->IdFonction,
                    ));
                    $entityRelatedFunction = ($entityRelatedFunction !== null) ? $entityRelatedFunction : new FilmFilmPersonFunction();
                    $function = $this->em->getRepository('FDCCoreBundle:FilmFunction')->findOneById(array('id' => $obj->IdFonction));
                    if ($function === null) {
                        $function = new FilmFunction();
                    }
                    $function->setId($obj->IdFonction);
                    
                    // loop through translations
                    $entityTranslation = array();
                    $translations = $obj->FonctionsTraductions->FonctionTraductionDto;
                    foreach ($translations as $translation) {
                        if (!isset($localesMapper[$translation->CodeLangue])) {
                            $this->logger->warning(__METHOD__. " the locales mapper {$translation->CodeLangue} doesn't exist");
                            continue;
                        }
                        if (!isset($entityTranslation[$translation->CodeLangue])) {
                            $entityTranslation[$translation->CodeLangue] = $function->findTranslationByLocale($localesMapper[$translation->CodeLangue]);
                        }
                        
                        // set translations
                        $entityTranslation[$translation->CodeLangue] = ($entityTranslation[$translation->CodeLangue] !== null) ? $entityTranslation[$translation->CodeLangue] : new FilmFunctionTranslation();
                        $entityTranslation[$translation->CodeLangue]->setName($translation->Libelle);
                        $entityTranslation[$translation->CodeLangue]->setLocale($localesMapper[$translation->CodeLangue]);
                        
                        // if new entity add translation to parent
                        if ($entityTranslation[$translation->CodeLangue]->getId() === null) {
                            $function->addTranslation($entityTranslation[$translation->CodeLangue]);
                        }
                    }
                    $entityRelatedFunction->setFunction($function);
                    $entityRelated->addFunction($entityRelatedFunction);
                    $collectionFunctions->add($entityRelatedFunction);
                    $this->removeOldRelations($entityRelated->getFunctions(), $collectionFunctions, $entityRelated, 'removeFunction');
                }
                $entity->addFilm($entityRelated);
                // save in array all the entities
                $collection->add($entityRelated);
                
                $this->update($entity);
            }

            // remove old relations
            $this->removeOldRelations($entity->getFilms(), $collection, $entity, 'removeFilm');
        }
        
        return $entity;
    }
}