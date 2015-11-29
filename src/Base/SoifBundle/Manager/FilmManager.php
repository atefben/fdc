<?php

namespace Base\SoifBundle\Manager;

use Doctrine\Common\Collections\ArrayCollection;

use Base\CoreBundle\Entity\FilmAddress;
use Base\CoreBundle\Entity\FilmAddressTranslation;
use Base\CoreBundle\Entity\FilmContact;
use Base\CoreBundle\Entity\FilmContactPerson;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmCountry;
use Base\CoreBundle\Entity\FilmFilmPerson;
use Base\CoreBundle\Entity\FilmFilmPersonTranslation;
use Base\CoreBundle\Entity\FilmFilmPersonFunction;
use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmFilmTranslation;
use Base\CoreBundle\Entity\FilmFunction;
use Base\CoreBundle\Entity\FilmFunctionTranslation;
use Base\CoreBundle\Entity\FilmSelection;
use Base\CoreBundle\Entity\FilmSelectionSection;
use Base\CoreBundle\Entity\FilmSelectionSectionTranslation;
use Base\CoreBundle\Entity\FilmSelectionSubsection;
use Base\CoreBundle\Entity\FilmSelectionSubsectionTranslation;

/**
 * FilmManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class FilmManager extends CoreManager
{
    /**
     * festivalManager
     * 
     * @var mixed
     * @access private
     */
    private $festivalManager;

    /**
     * mediaManager
     * 
     * @var mixed
     * @access private
     */
    private $mediaManager;

    /**
     * personManager
     * 
     * @var mixed
     * @access private
     */
    private $personManager;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager, $mediaManager, $personManager)
    {
        // managers
        $this->festivalManager = $festivalManager;
        $this->mediaManager = $mediaManager;
        $this->personManager = $personManager;
        
        // soif parameters
        $this->repository = 'BaseCoreBundle:FilmFilm';
        $this->wsParameterKey = 'idFilm';
        $this->wsResultObjectKey = 'FilmDto';
        $this->entityIdKey = 'Id';
        
        // mappers entity setters to soif properties
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setDirectorFirst' => 'EstPremierFilm',
            'setRestored' => 'EstRestaure',
            'setTitleVO' => 'TitreOriginal',
            'setTitleVOAlphabet' => 'TitreOriginalAlphabetOriginal',
            'setProductionYear' => 'AnneeDeProduction',
            'setDuration' => 'Duree',
            'setWebsite' => 'SiteWeb',
            'setCastingCommentary' => 'CommentaireCasting',
            'setGalaId' => 'IdGala',
            'setGalaName' => 'NomGala'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'BaseCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            )
        );

        $this->mapperTranslations = array(
            'FilmTraductions' => array(
                'result' => 'FilmTraductionDto',
                'setters' => array(
                    'setDialog' => 'Dialogue',
                    'setSynopsis' => 'Synopsis',
                    'setTitle' => 'Titre'
                ),
                'wsLangKey' => 'IdLangue'
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
        $this->wsMethod = 'GetMovie';
        $this->wsResultKey = 'GetMovieResult';
        
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));
        
        if (!isset($result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey})) {
            $this->logger->warn($this->wsMethod . " {$id} not found");
            return null;
        }

        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};

        // update entity
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
        $this->wsMethod = 'GetModifiedMovies';
        $this->wsResultKey = 'GetModifiedMoviesResult';
         
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
        $this->wsMethod = 'GetRemovedMovies';
        $this->wsResultKey = 'GetRemovedMoviesResult';
         
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to), false);
        // verify if we have results
        $resultObjects = $this->mixedToArray($result->{$this->wsResultKey}->Resultats);
        
        // deleteMultiple objects
        $this->deleteMultiple($resultObjects);
        
        // loop 3 times because results are returned that way
        foreach ($resultObjects as $types) {
            foreach ($types as $ids) {
                // make sure we have an array even when one single result is returned
                $ids = $this->mixedToArray($ids);
                foreach ($ids as $id) {
                    $this->remove($id);
                }
            }
        }
        
        // save entities
        $this->em->flush();
        
        // end timer
        $this->end(__METHOD__);
    }
    
    private function set($resultObject, $result)
    {
        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmFilm();

        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // presave to use current entity in personManager
        $this->update($entity);
        
        $localesMapper = $this->getLocalesMapper();
        // set film production country
        if (!property_exists($resultObject, 'FilmPaysProduction') || !property_exists($resultObject->FilmPaysProduction, 'PaysProductionDto')) {
            $this->logger->warning(__METHOD__. "FilmPaysProduction not found");
        } else {
            // create an array when we get an object to standardize the code
            $resultObject->FilmPaysProduction->PaysProductionDto = $this->mixedToArray($resultObject->FilmPaysProduction->PaysProductionDto);
            $collection = new ArrayCollection();
            foreach ($resultObject->FilmPaysProduction->PaysProductionDto as $filmProdCountry) {
                // check if country already exists if not call the ws
                $country = $this->em->getRepository('BaseCoreBundle:Country')->findOneBy(array('iso' => $filmProdCountry->CodeIso));
                if ($country === null) {
                    $this->logger->warning(__METHOD__. "Country with iso {$filmProdCountry->CodeIso} not found");
                    continue;
                }
                // find related entity
                $entityRelated = $this->em->getRepository('BaseCoreBundle:FilmFilmCountry')->findOneBy(array(
                    'film' => $entity,
                    'country' => $country
                ));
                $entityRelated = ($entityRelated !== null) ? $entityRelated : new FilmFilmCountry();
                
                // set properties
                $entityRelated->setCountry($country);
                $entityRelated->setPosition($filmProdCountry->Ordre);
                
                // set country
                $entity->addCountry($entityRelated);
                $collection->add($entityRelated);
            }
            // remove old relations
            $this->removeOldRelations($entity->getCountries(), $collection, $entity, 'removeCountry');
        }
        
        // set film elements multimedia
        if (property_exists($resultObject, 'FilmElementsMultimedias') && property_exists($resultObject->FilmElementsMultimedias, 'ElementMultimediaRefDto')) {
            $collection = new ArrayCollection();
            foreach ($resultObject->FilmElementsMultimedias->ElementMultimediaRefDto as $filmFilmMedia) {
                // find if filmMedia already exists
                $entityRelated = $this->em->getRepository('BaseCoreBundle:FilmFilmMedia')->findOneBy(array(
                    'film' => $entity,
                    'media' => $filmFilmMedia->Id
                ));
                $entityRelated = ($entityRelated !== null) ? $entityRelated : new FilmFilmMedia();
                $entityRelated->setFilename($filmFilmMedia->FileName);
                //@TODO GetTypeElementMultimedia
                $entityRelated->setType($filmFilmMedia->IdType);
                $entityRelated->setPosition($filmFilmMedia->Ordre);

                // get the related media
                $filmMedia = $this->mediaManager->getById($filmFilmMedia->Id);
                $entityRelated->setMedia($filmMedia);

                // add media
                $entity->addMedia($entityRelated);
                $collection->add($entityRelated);
            }
            // remove old relations
            $this->removeOldRelations($entity->getMedias(), $collection, $entity, 'removeMedia');
        }

        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmFilmTranslation());
        
        // set film section programmation
        if (property_exists($resultObject, 'FilmSectionProgrammation') && property_exists($resultObject->FilmSectionProgrammation, 'FilmSectionProgrammationDto')) {
            if (gettype($resultObject->FilmSectionProgrammation->FilmSectionProgrammationDto) == 'object') {
                $resultObject->FilmSectionProgrammation->FilmSectionProgrammationDto = array($resultObject->FilmSectionProgrammation->FilmSectionProgrammationDto);
            }
            $langs = array('fr', 'en');
            foreach ($resultObject->FilmSectionProgrammation->FilmSectionProgrammationDto as $obj) {
                foreach ($langs as $lang) {
                    $entityTranslation = $entity->findTranslationByLocale($lang);
                    $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new FilmFilmTranslation();
                    $entityTranslation->setProgramSection($obj->{'Libelle'. ucfirst($lang)});
                    $entityTranslation->setLocale($lang);
                    
                    if ($entityTranslation->getId() === null) {
                        $entity->addTranslation($entityTranslation);
                    }
                }
            }
        }

        // set selection
        if (property_exists($resultObject, 'FilmSelections') && property_exists($resultObject->FilmSelections, 'FilmSelectionDto')) {
            $object = $resultObject->FilmSelections->FilmSelectionDto;
            // create / get selection
            $filmSelection = $this->em->getRepository('BaseCoreBundle:FilmSelection')->findOneBy(array('codeSignup' => $object->CodeInscription));
            $filmSelection = ($filmSelection !== null) ? $filmSelection : new FilmSelection();
            $filmSelection->setCodeSignup($object->CodeInscription);

            $entity->setSelection($filmSelection);
            
            $entityTranslation = array();
                
            // create / update selection section
            if (property_exists($object, 'SectionSelection') && property_exists($object->SectionSelection->Traductions, 'FilmSectionSelectionTraductionDto')) {
            
                // get related entity
                $translations = $object->SectionSelection->Traductions->FilmSectionSelectionTraductionDto;
                $filmSelectionSection = $this->em->getRepository('BaseCoreBundle:FilmSelectionSection')->findOneBy(array('id' => $object->SectionSelection->Code));
                $filmSelectionSection = ($filmSelectionSection !== null) ? $filmSelectionSection : new FilmSelectionSection();
                $filmSelectionSection->setId($object->SectionSelection->Code);
                $filmSelection->addSection($filmSelectionSection);
    
                $festival = $this->em->getRepository('BaseCoreBundle:FilmFestival')->findOneBy(array('id' => $object->SectionSelection->IdFestival));
                $festival = ($festival !== null) ? $festival : $this->festivalManager->getById($object->SectionSelection->IdFestival);
                if ($festival !== null) {
                    $filmSelectionSection->setFestival($festival);
                }
                
                // loop through translations
                foreach ($translations as $translation) {
                    if (!isset($localesMapper[$translation->CodeLangue])) {
                        $this->logger->warning(__METHOD__. " the locales mapper {$translation->CodeLangue} doesn't exist");
                        continue;
                    }
                    if (!isset($entityTranslation[$translation->CodeLangue])) {
                        $entityTranslation[$translation->CodeLangue] = $filmSelectionSection->findTranslationByLocale($localesMapper[$translation->CodeLangue]);
                    }
                    
                    // set translations
                    $entityTranslation[$translation->CodeLangue] = ($entityTranslation[$translation->CodeLangue] !== null) ? $entityTranslation[$translation->CodeLangue] : new FilmSelectionSectionTranslation();
                    $entityTranslation[$translation->CodeLangue]->setName($translation->Libelle);
                    $entityTranslation[$translation->CodeLangue]->setLocale($localesMapper[$translation->CodeLangue]);
                    
                    // if new entity add translation to parent
                    if ($entityTranslation[$translation->CodeLangue]->getId() === null) {
                        $filmSelectionSection->addTranslation($entityTranslation[$translation->CodeLangue]);
                    }
                }
            }

            // create / update selection subsection
            if (property_exists($object, 'SousSectionSelection') && property_exists($object->SousSectionSelection->Traductions, 'FilmSousSectionSelectionTraductionDto')) {
                // create an array when we get an object to standardize the code
                if (gettype($object->SousSectionSelection->Traductions->FilmSousSectionSelectionTraductionDto) == 'object') {
                     $object->SousSectionSelection->Traductions->FilmSousSectionSelectionTraductionDto = array($object->SousSectionSelection->Traductions->FilmSousSectionSelectionTraductionDto);
                }
                
                // loop through translations
                $translations = $object->SousSectionSelection->Traductions->FilmSousSectionSelectionTraductionDto;
                
                $filmSelectionSubsection = new FilmSelectionSubsection();
                $filmSelection->addSubsection($filmSelectionSubsection);
                
                foreach ($translations as $translation) {
                    if (!isset($localesMapper[$translation->CodeLangue])) {
                        $this->logger->warning(__METHOD__. " the locales mapper {$translation->CodeLangue} doesn't exist");
                        continue;
                    }
                    
                    // set translations
                    $filmSelectionSubsectionTranslation = new FilmSelectionSubsectionTranslation();
                    $filmSelectionSubsectionTranslation->setName($translation->Libelle);
                    $filmSelectionSubsectionTranslation->setLocale($localesMapper[$translation->CodeLangue]);
                    $filmSelectionSubsection->addTranslation($filmSelectionSubsectionTranslation);
                }
            }
        }
        
        // set persons (directors)
        $persons = array();
        if (property_exists($resultObject, 'FilmRealisateurs') && property_exists($resultObject->FilmRealisateurs, 'RealisateurRefDto')) {
            $objects = $resultObject->FilmRealisateurs->RealisateurRefDto;
            // create an array when we get an object to standardize the code
            if (gettype($objects) == 'object') {
                 $objects = array($objects);
            }
            
            // create / update director
            foreach ($objects as $object) {
                $ids[] = $object->Id;
                $person = $this->personManager->getById($object->Id);
                
                if (!isset($persons[$object->Id])) {
                    $persons[$object->Id] = $this->em->getRepository('BaseCoreBundle:FilmFilmPerson')->findOneBy(array('person' => $object->Id, 'film' => $entity->getId()));
                    $persons[$object->Id] = ($persons[$object->Id] !== null) ? $persons[$object->Id] : new FilmFilmPerson();
                }
                // set person
                $persons[$object->Id]->setPerson($person);
                
                // set function
                $function = $this->em->getRepository('BaseCoreBundle:FilmFunction')->findOneById($object->IdFonction);
                if ($function !== null) {
                    $filmFilmPersonFunction = $this->em->getRepository('BaseCoreBundle:FilmFilmPersonFunction')->findOneBy(array('filmPerson' => $persons[$object->Id]->getId(), 'function' => $object->IdFonction));
                    $filmFilmPersonFunction = ($filmFilmPersonFunction !== null) ? $filmFilmPersonFunction : new FilmFilmPersonFunction();
                    $filmFilmPersonFunction->setFunction($function);
                    $filmFilmPersonFunction->setFilmPerson($persons[$object->Id]);
                    $filmFilmPersonFunction->setPosition($object->OrdreAffichage);
                    $persons[$object->Id]->addFunction($filmFilmPersonFunction);
                } else {
                    $this->logger->error(__METHOD__. "Function {$object->IdFonction} not found");
                }
                
                if ($persons[$object->Id]->getId() === null) {
                    $entity->addPerson($persons[$object->Id]);
                }
            }
        }
        
        // set persons (credits)
        if (property_exists($resultObject, 'FilmCredits') && property_exists($resultObject->FilmCredits, 'FilmCreditDto')) {
            $objects = $resultObject->FilmCredits->FilmCreditDto;
            if (gettype($objects) == 'object') {
                 $objects = array($objects);
            }
            
            // create / update person
            $functions = array();
            foreach ($objects as $object) {
                $ids[] = $object->Id;
                $id = $object->Id;
                $functionId = $object->IdFonction;
                $order = $object->Ordre;
                
                // find person
                $person = $this->personManager->getById($object->Id);
                if (!isset($persons[$object->Id])) {
                    $persons[$object->Id] = $this->em->getRepository('BaseCoreBundle:FilmFilmPerson')->findOneBy(array('person' => $object->Id, 'film' => $entity->getId()));
                    $persons[$object->Id] = ($persons[$object->Id] !== null) ? $persons[$object->Id] : new FilmFilmPerson();
                }
                $persons[$object->Id]->setPerson($person);

                // set function
                if (property_exists($object, 'FonctionsTraductions') && property_exists($object->FonctionsTraductions, 'FonctionTraductionDto')) {
                    $translations = $object->FonctionsTraductions->FonctionTraductionDto;
                    $collectionFunctions = new ArrayCollection();
                    $functions[$functionId] = (isset($functions[$functionId])) ?  $functions[$functionId] : $this->em->getRepository('BaseCoreBundle:FilmFunction')->findOneById($functionId);
                    // set function
                    if (!isset($functions[$functionId])) {
                        $functions[$functionId] = new FilmFunction();
                        $functions[$functionId]->setId($functionId);
                    }
                    
                    $entityTranslation = array();
                    foreach ($translations as $translation) {
                        if (!isset($localesMapper[$translation->CodeLangue])) {
                            $this->logger->warning(__METHOD__. "The locales mapper {$translation->CodeLangue} doesn't exist");
                            continue;
                        }
                        if (!isset($entityTranslation[$translation->CodeLangue])) {
                            $entityTranslation[$translation->CodeLangue] = $functions[$functionId]->findTranslationByLocale($localesMapper[$translation->CodeLangue]);
                        }
                        // set translations
                        $entityTranslation[$translation->CodeLangue] = ($entityTranslation[$translation->CodeLangue] !== null) ? $entityTranslation[$translation->CodeLangue] : new FilmFunctionTranslation();
                        $entityTranslation[$translation->CodeLangue]->setName($translation->Libelle);
                        $entityTranslation[$translation->CodeLangue]->setLocale($localesMapper[$translation->CodeLangue]);
                        
                        // if new entity add translation to parent
                        if ($entityTranslation[$translation->CodeLangue]->getId() === null) {
                            $functions[$functionId]->addTranslation($entityTranslation[$translation->CodeLangue]);
                        }
                    }
                    
                    // set person function
                    $filmFilmPersonFunction = $this->em->getRepository('BaseCoreBundle:FilmFilmPersonFunction')->findOneBy(array('filmPerson' => $persons[$id]->getId(), 'function' => $functionId));
                    $filmFilmPersonFunction = ($filmFilmPersonFunction !== null) ? $filmFilmPersonFunction : new FilmFilmPersonFunction();
                    $filmFilmPersonFunction->setFunction($functions[$functionId]);
                    $filmFilmPersonFunction->setFilmPerson($persons[$id]);
                    $filmFilmPersonFunction->setPosition($order);
                    
                    $persons[$id]->addFunction($filmFilmPersonFunction);
                    // save in array all the entities
                    $collectionFunctions->add($filmFilmPersonFunction);
                    // remove old relations
                    $this->removeOldRelations($persons[$id]->getFunctions(), $collectionFunctions, $persons[$id], 'removeFunction');
                }
                
                if ($persons[$id]->getId() === null) {
                    $entity->addPerson($persons[$id]);
                }
            }
        }
        
        $this->update($entity);
        
        // set persons (actors)
        if (property_exists($resultObject, 'FilmActeurs') && property_exists($resultObject->FilmActeurs, 'ActeurDto')) {
            $objects = $resultObject->FilmActeurs->ActeurDto;
            if (gettype($objects) == 'object') {
                 $objects = array($objects);
            }
            
            // create / update person
            foreach ($objects as $object) {
                $ids[] = $object->Id;
                $person = $this->personManager->getById($object->Id);

                if (!isset($persons[$object->Id])) {
                    $persons[$object->Id] = $this->em->getRepository('BaseCoreBundle:FilmFilmPerson')->findOneBy(array('person' => $object->Id, 'film' => $entity->getId()));
                    $persons[$object->Id] = ($persons[$object->Id] !== null) ? $persons[$object->Id] : new FilmFilmPerson();
                }
                
                // find person
                $persons[$object->Id]->setPerson($person);
                $persons[$object->Id]->setFilm($entity);
                
                // set function
                $function = $this->em->getRepository('BaseCoreBundle:FilmFunction')->findOneById($object->IdFonction);
                if ($function !== null) {
                    $filmFilmPersonFunction = $this->em->getRepository('BaseCoreBundle:FilmFilmPersonFunction')->findOneBy(array('filmPerson' => $persons[$object->Id]->getId(), 'function' => $object->IdFonction));
                    $filmFilmPersonFunction = ($filmFilmPersonFunction !== null) ? $filmFilmPersonFunction : new FilmFilmPersonFunction();
                    $filmFilmPersonFunction->setFunction($function);
                    $filmFilmPersonFunction->setFilmPerson($persons[$object->Id]);
                    $filmFilmPersonFunction->setPosition($object->OrdreAffichage);
                    $persons[$object->Id]->addFunction($filmFilmPersonFunction);
                } else {
                    $this->logger->error(__METHOD__. "Function {$object->IdFonction} not found");
                }

                // set translations for roles
                if (property_exists($object, 'TraductionsRole') && property_exists($object->TraductionsRole, 'TraductionsRoleDto')) {
                    $roles = $object->TraductionsRole->TraductionsRoleDto;
                    if (gettype($roles) == 'object') {
                        $roles = array($roles);
                    }
    
                    foreach ($roles as $role) {
                        if (!isset($localesMapper[$role->CodeLangue])) {
                            $this->logger->warning(__METHOD__. " the locales mapper {$role->CodeLangue} doesn't exist");
                            continue;
                        }
                        $entityTranslation = $persons[$object->Id]->findTranslationByLocale($localesMapper[$role->CodeLangue]);
                        $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new FilmFilmPersonTranslation();
                        $entityTranslation->setRole($role->Traductionrole);
                        $entityTranslation->setLocale($localesMapper[$role->CodeLangue]);
                        
                        if ($entityTranslation->getId() === null) {
                            $persons[$object->Id]->addTranslation($entityTranslation);
                        }
                    }
                }
        
                $entity->addPerson($persons[$object->Id]);
            }
        }

        // set contacts
        if (property_exists($resultObject, 'FilmContacts') && property_exists($resultObject->FilmContacts, 'ContactDto')) {
            $objects = $resultObject->FilmContacts->ContactDto;
            if (gettype($objects) == 'object') {
                 $objects = array($objects);
            }
            
            // create / update contact
            $collection = new ArrayCollection();
            foreach ($objects as $object) {
                $filmContact = $this->em->getRepository('BaseCoreBundle:FilmContact')->findOneBy(array('id' => $object->IdContact));
                $filmContact = ($filmContact !== null) ? $filmContact : new FilmContact();
                
                // set properties
                $filmContact->setId($object->IdContact);
                $filmContact->setType($object->TypesContactId);
                $filmContact->setCompanyName($object->NomSociete);
                
                $entity->addContact($filmContact);
                $collection->add($filmContact);
                
                // set address
                if (property_exists($object, 'Adresse')) {
                    $address = $object->Adresse;
                    $filmAddress = ($filmContact->getAddress() !== null) ? $filmContact->getAddress() : new FilmAddress();
                    if (!empty($address->CodeIsoPays)) {
                        $country = $this->em->getRepository('BaseCoreBundle:Country')->findOneBy(array('iso' => $address->CodeIsoPays));
                        if ($country === null) {
                            $this->logger->warning(__METHOD__. " Country with iso {$address->CodeIsoPays} not found");
                        } else {
                            $filmAddress->setCountry($country);
                        }
                    }
                    $filmAddress->setStreet($address->Rue);
                    $filmAddress->setPostalCode($address->CodePostal);
                    $filmAddress->setCity($address->Ville);
                    $filmAddress->setFax($address->Fax);
                    $filmAddress->setPhone($address->Telephone);
                    $filmAddress->setMobilePhone($address->TelPortable);
                    $filmAddress->setEmail($address->Email);
                    $filmAddress->setWebsite($address->SiteWeb);
                    if (property_exists($filmAddress, 'Ordre')) {
                        $filmAddress->setPosition($address->Ordre);
                    }
                    $filmContact->setAddress($filmAddress);
                    
                    // set state translations
                    if (property_exists($address, 'EtatsTraductions') && property_exists($address->EtatsTraductions, 'EtatTraductionDto')) {
                        $translations = $address->EtatsTraductions->EtatTraductionDto;
                        if (count($translations) > 0) {
                            foreach ($translations as $translation) {
                                if (!isset($localesMapper[$translation->CodeLangue])) {
                                    $this->logger->warning(__METHOD__ . " the locales mapper {$translation->CodeLangue} doesn't exist");
                                    continue;
                                }

                                $entityTranslation = $filmAddress->findTranslationByLocale($localesMapper[$translation->CodeLangue]);
                                $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new FilmAddressTranslation();
                                $entityTranslation->setState($translation->Nom);
                                $entityTranslation->setLocale($localesMapper[$translation->CodeLangue]);

                                if ($entityTranslation->getId() === null) {
                                    $filmAddress->addTranslation($entityTranslation);
                                }
                            }
                        }
                    }
                }
                
                // set person
                if (property_exists($object, 'PersonneContact')) {
                    $person = $object->PersonneContact;
                    // this api returns sometimes a link on a contact with ID -1 and empty values, dont use it...
                    if ($person->Id != -1) {
                        $filmContactPerson = $this->em->getRepository('BaseCoreBundle:FilmContactPerson')->findOneById(array('id' => $person->Id));
                        $filmContactPerson = ($filmContactPerson !== null) ? $filmContactPerson : new FilmContactPerson();
                        $filmContactPerson->setId($person->Id);
                        $filmContactPerson->setFirstname($person->Nom);
                        $filmContactPerson->setFirstname($person->Prenom);
                        $filmContactPerson->setEmail($person->Email);
                        $filmContact->setPerson($filmContactPerson);
                    }
                }
                
                // set subordinates
                if (property_exists($object, 'ContactSecondaires') && property_exists($object->ContactSecondaires, 'PersonneContactSecondaireDto')) {
                    $subordinates = $object->ContactSecondaires->PersonneContactSecondaireDto;
                    $subordinates = $this->mixedToArray($subordinates);
                    $collectionSubordinates = new ArrayCollection();
                    foreach ($subordinates as $subordinate) {
                        $filmContactPersonSubordinate = $this->em->getRepository('BaseCoreBundle:FilmContactPerson')->findOneById(array('id' => $subordinate->Id));
                        $filmContactPersonSubordinate = ($filmContactPersonSubordinate !== null) ? $filmContactPersonSubordinate: new FilmContactPerson();
                        $filmContactPersonSubordinate->setId($subordinate->Id);
                        $filmContactPersonSubordinate->setEmail($subordinate->Email);
                        $filmContactPersonSubordinate->setLastname($subordinate->Nom);
                        $filmContactPersonSubordinate->setFirstname($subordinate->Prenom);
                        $filmContactPersonSubordinate->setMobilePhone($subordinate->TelephonePortable);
                        
                        $filmContactPerson->addSubordinate($filmContactPersonSubordinate);
                        $collectionSubordinates->add($filmContactPerson);
                    }
                    $this->removeOldRelations($filmContactPerson->getSubordinates(), $collectionSubordinates, $filmContactPerson, 'removeSubordinate');
                }
            }
            $this->removeOldRelations($entity->getContacts(), $collection, $entity, 'removeContact');
        }
        
        return $entity;
    }
}