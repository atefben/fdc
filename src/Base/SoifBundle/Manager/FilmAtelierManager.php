<?php

namespace Base\SoifBundle\Manager;

use \DateTime;
use \Exception;

use Base\CoreBundle\Entity\FilmAtelier;
use Base\CoreBundle\Entity\FilmAtelierCountry;
use Base\CoreBundle\Entity\FilmAtelierLanguage;
use Base\CoreBundle\Entity\FilmAtelierPerson;
use Base\CoreBundle\Entity\FilmAtelierTranslation;
use Base\CoreBundle\Entity\FilmAtelierPersonFunction;
use Base\CoreBundle\Entity\FilmAtelierProductionCompany;
use Base\CoreBundle\Entity\FilmAtelierProductionCompanyAddress;
use Base\CoreBundle\Entity\FilmAtelierProductionCompanyAddressTranslation;

/**
 * FilmAtelierManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class FilmAtelierManager extends CoreManager
{
    /**
     * festivalManager
     * 
     * @var mixed
     * @access private
     */
    private $festivalManager;
    
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
    public function __construct($festivalManager, $personManager)
    {
        // managers
        $this->festivalManager = $festivalManager;
        $this->personManager = $personManager;

        // soif parameters
        $this->repository = 'BaseCoreBundle:FilmAtelier';
        $this->wsResultObjectKey = 'AtelierDto';
        $this->wsParameterKey = 'idAtelier';
        $this->entityIdKey = 'Id';
        
        // mappers entity setters to soif properties
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setTitleVo' => 'TitreVO',
            'setProductionYear' => 'AnneProduction',
            'setBudgetEstimation' => 'BudgetPrevisionnel',
            'setFilmingPlace' => 'DetailsLieuTournage',
            'setDuration' => 'DureeFilm',
            'setSessionName' => 'LabelSessionAtelier',
            'setProductionCompanyName' => 'NomSocieteProduction',
            'setBudgetAcquired' => 'FinacementAcquis',
            'setCinanoUrl' => 'UrlProjetCinando'
        );

        $this->mapperEntity = array(
            array(
                'repository' => 'BaseCoreBundle:FilmFestival',
                'soapKey' => 'IdFestivalAtelier',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
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
        $this->wsMethod = 'GetAtelier';
        $this->wsResultKey = 'GetAtelierResult';

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
        $this->wsMethod = 'GetModifiedAteliers';
        $this->wsResultKey = 'GetModifiedAteliersResult';
         
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
     * 
     * @access public
     * @param mixed $from
     * @param mixed $to
     * @return void
     */
    public function getRemoved($from, $to)
    {
        $this->wsMethod = 'GetRemovedAtelier';
        $this->wsResultKey = 'GetRemovedAtelierResult';
         
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmAtelier();
        $id = $resultObject->{$this->entityIdKey};
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);

        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set translations for name and lang
        $localesMapper = $this->getLocalesMapper();
        $propertiesTranslations = array(
            'fr' => array(
                'setTitle' => 'TitreVF',
                'setSynopsis' => 'SynopsisFR',
                'setApplicantNote' => 'NoteIntentionFR'
            ),
            'en' => array(
                'setTitle' => 'TitreEn',
                'setSynopsis' => 'SynopsisEN',
                'setApplicantNote' => 'NoteIntentionEN'
            )
        );
        
        foreach ($propertiesTranslations as $lang => $properties) {
            $entityTranslation = $entity->findTranslationByLocale($lang);
            $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new FilmAtelierTranslation();
            $entityTranslation->setLocale($lang);
            
            foreach ($properties as $setter => $wsKey) {
                $entityTranslation->{$setter}($resultObject->{$wsKey});
            }
            
            if ($entityTranslation->getId() === null) {
                $entity->addTranslation($entityTranslation);
            }
        }
        
        if ($resultObject->DateTournage !== null) {
            $entity->setFilmingDate(new DateTime($resultObject->DateTournage));
        }
        
        // @todo realisateurs, probleme duplicate function film_person_translation link to film_function
        if (property_exists($resultObject, 'IdRealisateurs') && property_exists($resultObject->IdRealisateurs, 'int')) {
            // create an array when we get an object to standardize the code
            foreach ($resultObject->IdRealisateurs as $types) {
                $types = $this->mixedToArray($types);
                foreach ($types as $directorId) {
                    $filmPerson = $this->em->getRepository('BaseCoreBundle:FilmPerson')->findOneBy(array('id' => $directorId));
                    $filmPerson = ($filmPerson !== null) ? $filmPerson : $this->personManager->getById($directorId);
                    
                    $filmAtelierPerson = $this->em->getRepository('BaseCoreBundle:FilmAtelierPerson')->findOneBy(array('film' => $entity->getId(), 'person' => $directorId));
                    $filmAtelierPerson = ($filmAtelierPerson !== null)  ? $filmAtelierPerson : new FilmAtelierPerson();
                    $filmAtelierPerson->setPerson($filmPerson);
                    
                    // set function
                    if ($filmAtelierPerson->getFunctions()->count() == 0) {
                        $functionTranslation = $this->em->getRepository('BaseCoreBundle:FilmFunctionTranslation')->findOneBy(array('locale' => 'en', 'name' => 'Director'));
                        if ($functionTranslation === null) {
                            $this->logger->error(__METHOD__. " {$id}, function translation Director not found");
                        } else {
                            $filmAtelierPersonFunction = new FilmAtelierPersonFunction();
                            $filmAtelierPersonFunction->setFunction($functionTranslation->getTranslatable());
                            $filmAtelierPerson->addFunction($filmAtelierPersonFunction);
                        }
                    }
                }
            }
        }

        // set production company
        $filmAtelierProductionCompany = $this->em->getRepository('BaseCoreBundle:FilmAtelierProductionCompany')->findOneBy(array('name' => $resultObject->NomSocieteProduction));
        $filmAtelierProductionCompany = ($filmAtelierProductionCompany !== null) ? $filmAtelierProductionCompany : new FilmAtelierProductionCompany();
        $filmAtelierProductionCompany->setName($resultObject->NomSocieteProduction);
        
        // set production company address
        $filmAtelierProductionCompanyAddress = ($filmAtelierProductionCompany->getAddress() !== null) ? $filmAtelierProductionCompany->getAddress() : new FilmAtelierProductionCompanyAddress();
        $filmAtelierProductionCompanyAddress->setPostalCode($resultObject->AdresseSocieteProduction->CodePostal);
        $filmAtelierProductionCompanyAddress->setEmail($resultObject->AdresseSocieteProduction->Email);
        $filmAtelierProductionCompanyAddress->setStreet($resultObject->AdresseSocieteProduction->Rue);
        $filmAtelierProductionCompanyAddress->setWebsite($resultObject->AdresseSocieteProduction->SiteWeb);
        $filmAtelierProductionCompanyAddress->setMobilePhone($resultObject->AdresseSocieteProduction->TelPortable);
        $filmAtelierProductionCompanyAddress->setPhone($resultObject->AdresseSocieteProduction->Telephone);
        $filmAtelierProductionCompanyAddress->setCity($resultObject->AdresseSocieteProduction->Ville);
        
        $country = $this->em->getRepository('BaseCoreBundle:Country')->findOneBy(array('iso' => $resultObject->AdresseSocieteProduction->CodeIsoPays));
        if ($country === null) {
            $this->logger->error(__METHOD__. " {$id} Country with iso {$resultObject->AdresseSocieteProduction->CodeIsoPays} not found");
        } else {
            $filmAtelierProductionCompanyAddress->setCountry($country);
        }
        
        // set state translations
        $translations = $resultObject->AdresseSocieteProduction->EtatsTraductions;
        foreach ($translations as $translation) {
            if (!isset($localesMapper[$translation->CodeLangue])) {
                $this->logger->warning(__METHOD__. " the locales mapper {$translation->CodeLangue} doesn't exist");
                continue;
            }
            
            $entityTranslation = $filmAtelierProductionCompanyAddress->findTranslationByLocale($localesMapper[$role->CodeLangue]);
            $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new FilmAtelierProductionCompanyAddressTranslation();
            $entityTranslation->setState($translation->Nom);
            $entityTranslation->setLocale($localesMapper[$translation->CodeLangue]);
            
            if ($entityTranslation->getId() === null) {
                $filmAtelierProductionCompanyAddress->addTranslation($entityTranslation);
            }
        }
        
        
        $filmAtelierProductionCompany->setAddress($filmAtelierProductionCompanyAddress);
        $entity->setProductionCompany($filmAtelierProductionCompany);
        
        
        // set languages
        foreach ($resultObject->LanguesTournage as $languages) {
            $languages = $this->mixedToArray($languages);
            foreach ($languages as $language) {
                $country = $this->em->getRepository('BaseCoreBundle:Country')->findOneBy(array('iso' => $language));
                if ($country === null) {
                    $this->logger->error(__METHOD__. " {$id} Country with iso {$language} not found");
                    continue;
                } else {
                    $filmAtelierLanguage = new FilmAtelierLanguage();
                    $filmAtelierLanguage->setFilm($entity);
                    $filmAtelierLanguage->setCountry($country);
                    
                }
                if (!$entity->getLanguages()->contains($filmAtelierLanguage)) {
                    $entity->addLanguage($filmAtelierLanguage);
                }
            }
        }

        // set countries
        foreach ($resultObject->PaysTournage as $language) {
            $country = $this->em->getRepository('BaseCoreBundle:Country')->findOneBy(array('iso' => $language));
            if ($country === null) {
                $this->logger->error(__METHOD__. " {$id} Country with iso {$language} not found");
            } else {
                $filmAtelierCountry = new FilmAtelierCountry();
                $filmAtelierCountry->setFilm($entity);
                $filmAtelierCountry->setCountry($country);
                
                if (!$entity->getCountries()->contains($filmAtelierCountry)) {
                    $entity->addCountry($filmAtelierCountry);
                }
            }
        }
    
        // set selectionsection
        $filmSelectionSection = $this->em->getRepository('BaseCoreBundle:FilmSelectionSection')->findOneBy(array('id' => $resultObject->IdSectionSelection));
        if ($filmSelectionSection === null) {
            $this->logger->error(__METHOD__. " {$id} FilmSelectionSection with id {$resultObject->IdSectionSelection} not found");
        } else {
            $entity->setSelectionSection($filmSelectionSection);
        }
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        return $entity;
    }
}