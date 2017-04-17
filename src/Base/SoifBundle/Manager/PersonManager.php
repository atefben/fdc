<?php

namespace Base\SoifBundle\Manager;

use Base\CoreBundle\Entity\FilmFilmPerson;
use Base\CoreBundle\Entity\FilmFilmPersonFunction;
use Base\CoreBundle\Entity\FilmFunction;
use Base\CoreBundle\Entity\FilmFunctionTranslation;
use Base\CoreBundle\Entity\FilmPerson;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Base\CoreBundle\Entity\FilmPersonTranslation;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;

/**
 * PersonManager class.
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class PersonManager extends CoreManager
{
    /**
     * mediaManager
     * @var mixed
     * @access private
     */
    private $mediaManager;

    /**
     * @var array
     */
    private $filmsNotImported = array();

    /**
     * @return array
     */
    public function getFilmsNotImported()
    {
        return $this->filmsNotImported;
    }


    /**
     * __construct function.
     * @access public
     * @return void
     */
    public function __construct($mediaManager)
    {
        $this->mediaManager = $mediaManager;
        $this->entityIdKey = 'Id';
        $this->repository = 'BaseCoreBundle:FilmPerson';
        $this->wsParameterKey = 'idPersonne';
        $this->wsResultObjectKey = 'PersonneDto';
        $this->mapper = array(
            'setId'        => $this->entityIdKey,
            'setAsianName' => 'IsAsianName',
            'setLastname'  => 'Nom',
            'setFirstname' => 'Prenom',
            'setSelfkit'   => 'IdSelfkit',
        );
        $this->mapperTranslations = array(
            'CiviliteTraductions'   => array(
                'result'    => 'CiviliteTraductionDto',
                'setters'   => array(
                    'setGender' => 'Libelle',
                ),
                'wsLangKey' => 'CodeLangue',
            ),
            'BiographieTraductions' => array(
                'result'    => 'BiographieTraductionDto',
                'setters'   => array(
                    'setBiography' => 'Description',
                ),
                'wsLangKey' => 'CodeLangue',
            ),
            'ProfessionTraductions' => array(
                'result'    => 'ProfessionTraductionDto',
                'setters'   => array(
                    'setProfession' => 'Libelle',
                ),
                'wsLangkey' => 'CodeLangue',
            ),
        );
    }

    /**
     * getById function.
     * @access public
     * @param mixed $id
     * @return void
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

        // set entities
        foreach ($resultObjects as $resultObject) {
            try {
                $entity = $this->set($resultObject, $result);
            } catch (Exception $e) {
                $this->logger->critical($e->getMessage());
                continue;
            }
            $this->update($entity);
        }

        // end timer
        $this->end(__METHOD__);
    }

    /**
     * getRemoved function.
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

        // delete objects with duplicate check
        $this->deleteMultiple($resultObjects, true);

        // save entities
        //$this->em->flush();

        // end timer
        $this->end(__METHOD__);
    }

    /**
     * set function.
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
        $country = $this->em->getRepository('BaseCoreBundle:Country')->findOneByIso($resultObject->Nationalite);
        if ($country === null) {
            $msg = __METHOD__ . "Country {$resultObject->Nationalite} not found";
            $this->logger->warn($msg);
        } else {
            $entity->setNationality($country);
        }

        // set nationality2
        $country = $this->em->getRepository('BaseCoreBundle:Country')->findOneByIso($resultObject->NationaliteSecondaire);
        if ($country === null) {
            $msg = __METHOD__ . "Country {$resultObject->NationaliteSecondaire} not found";
            $this->logger->warn($msg);
        } else {
            $entity->setNationality2($country);
        }
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmPersonTranslation());
        // set multimedias
        if (property_exists($resultObject, 'PersonneElementsMultimedias') && property_exists($resultObject->PersonneElementsMultimedias, 'ElementMultimediaRefDto')) {
            $collection = new ArrayCollection();
            $resultObject->PersonneElementsMultimedias->ElementMultimediaRefDto = $this->mixedToArray($resultObject->PersonneElementsMultimedias->ElementMultimediaRefDto);
            foreach ($resultObject->PersonneElementsMultimedias->ElementMultimediaRefDto as $filmPersonMedia) {
                // find if filmMedia already exists
                $entityRelated = $this->em->getRepository('BaseCoreBundle:FilmPersonMedia')->findOneBy(array(
                    'person' => $entity,
                    'media'  => $filmPersonMedia->Id,
                ))
                ;
                $entityRelated = ($entityRelated !== null) ? $entityRelated : new FilmPersonMedia();
                $entityRelated->setFilename($filmPersonMedia->FileName);
                $entityRelated->setPerson($entity);
                $entityRelated->setType($filmPersonMedia->IdType);
                $entityRelated->setPosition($filmPersonMedia->Ordre);

                // get the related media
                $filmMedia = $this->mediaManager->getById($filmPersonMedia->Id, false);
                $entityRelated->setMedia($filmMedia);
                if (!$entityRelated->getId()) {
                    $this->em->persist($entityRelated);
                    $this->em->flush();
                }

                // add media
                $collection->add($entityRelated);
            }
            // remove old relations
            $this->removeOldRelations($entity->getMedias(), $collection, $entity, 'removeMedia');
        }

        // set films
        if (property_exists($resultObject, 'PersonneFilms') && property_exists($resultObject->PersonneFilms, 'PersonneFilmDto')) {
            $collection = new ArrayCollection();
            $localesMapper = $this->getLocalesMapper();
            $resultObject->PersonneFilms->PersonneFilmDto = $this->mixedToArray($resultObject->PersonneFilms->PersonneFilmDto);
            $collectionFunctions = new ArrayCollection();
            foreach ($resultObject->PersonneFilms->PersonneFilmDto as $obj) {
                $entityRelated = $this->em->getRepository('BaseCoreBundle:FilmFilmPerson')->findOneBy(array(
                    'film'   => $obj->IdFilm,
                    'person' => $entity->getId(),
                ))
                ;
                $entityRelated = ($entityRelated !== null) ? $entityRelated : new FilmFilmPerson();

                $film = $this->em->getRepository('BaseCoreBundle:FilmFilm')->findOneById(array('id' => $obj->IdFilm));
                if ($film === null) {
                    $this->filmsNotImported[] = $obj->IdFilm;
                    $msg = __METHOD__ . " Film {$obj->IdFilm} not found, call php app/console base:soif:get_film {$obj->IdFilm} to import it";
                    $this->logger->warn($msg);
                    continue;
                }
                $entityRelated->setFilm($film);
                // set functions
                if (isset($obj->FonctionsTraductions) &&
                    isset($obj->FonctionsTraductions->FonctionTraductionDto) &&
                    count($obj->FonctionsTraductions->FonctionTraductionDto) > 0
                ) {
                    $entityRelatedFunction = $this->em->getRepository('BaseCoreBundle:FilmFilmPersonFunction')->findOneBy(array(
                        'filmPerson' => $entityRelated->getId(),
                        'function'   => $obj->IdFonction,
                    ))
                    ;
                    $entityRelatedFunction = ($entityRelatedFunction !== null) ? $entityRelatedFunction : new FilmFilmPersonFunction();
                    $function = $this->em->getRepository('BaseCoreBundle:FilmFunction')->findOneById(array('id' => $obj->IdFonction));
                    if ($function === null) {
                        $function = new FilmFunction();
                    }
                    $function->setId($obj->IdFonction);

                    // loop through translations
                    $entityTranslation = array();
                    $translations = $obj->FonctionsTraductions->FonctionTraductionDto;
                    foreach ($translations as $translation) {
                        if (!isset($localesMapper[$translation->CodeLangue])) {
                            $this->logger->warning(__METHOD__ . " the locales mapper {$translation->CodeLangue} doesn't exist");
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

        // duplicates
        if (property_exists($resultObject, 'LinkedDeletedPersonnes')) {
            $collection = new ArrayCollection();
            $duplicates = clone $entity->getDuplicates();
            if (property_exists($resultObject->LinkedDeletedPersonnes, 'LinkedDeletedPersonneDto')) {
                $objects = $this->mixedToArray($resultObject->LinkedDeletedPersonnes->LinkedDeletedPersonneDto);
                $duplicateIds = array();
                $duplicateSelfkits = array();
                foreach ($objects as $obj) {
                    $duplicateIds[] = $obj->PersonneId;
                    $duplicateSelfkits[] = $obj->PersonneSelfkitId;
                }
                $entity->setDuplicateIds($duplicateIds);
                $entity->setDuplicateSelfkits($duplicateSelfkits);
                foreach ($objects as $obj) {
                    $person = $this->em->getRepository('BaseCoreBundle:FilmPerson')->find($obj->PersonneId);
                    if ($person !== null) {
                        $person->setDuplicate(1);
                        $person->setOwner($entity);
                        $person->setSelfkit($obj->PersonneSelfkitId);
                        $collection->add($person);

                        /* link owner to the duplicate person films */
                        foreach ($person->getFilms() as $filmFilmPersonDuplicate) {
                            $filmDuplicate = $filmFilmPersonDuplicate->getFilm();
                            $found = false;
                            foreach ($entity->getFilms() as $filmFilmPersonOwner) {
                                $filmOwner = $filmFilmPersonOwner->getFilm();
                                if ($filmDuplicate->getId() == $filmOwner->getId()) {
                                    $found = true;
                                    break;
                                }
                            }

                            if ($found == false) {
                                $entity->addFilm($filmFilmPersonDuplicate);
                            }
                        }

                        if (!$entity->getDuplicates()->contains($person)) {
                            $entity->addDuplicate($person);
                        }
                    }
                }

                //// unset old duplicates when we have data
                //if ($duplicates->count() > 0) {
                //    foreach ($duplicates as $duplicate) {
                //        if (!$collection->contains($duplicate)) {
                //            $duplicate->setDuplicate(false);
                //            $duplicate->setOwner(null);
                //            $entity->removeDuplicate($duplicate);
                //        }
                //    }
                //}

            }
        }

        /*if (count($this->getFilmsNotImported()) > 0) {
            foreach ($this->getFilmsNotImported() as $filmId) {
                $this->logger->info("Importing film {$filmId}");
                exec("php app/console base:soif:get_film {$filmId}");
            }
        }*/

        return $entity;
    }
}