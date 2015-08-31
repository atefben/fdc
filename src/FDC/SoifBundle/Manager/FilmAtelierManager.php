<?php

namespace FDC\SoifBundle\Manager;

use \DateTime;

use FDC\CoreBundle\Entity\FilmAtelier;
use FDC\CoreBundle\Entity\FilmAtelierCountry;
use FDC\CoreBundle\Entity\FilmAtelierLanguage;
use FDC\CoreBundle\Entity\FilmAtelierPerson;
use FDC\CoreBundle\Entity\FilmAtelierTranslation;
use FDC\CoreBundle\Entity\FilmAtelierProductionCompany;
use FDC\CoreBundle\Entity\FilmAtelierProductionCompanyAddress;

/**
 * FilmAtelierManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
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
        $this->repository = 'FDCCoreBundle:FilmAtelier';
        $this->wsMethod = 'GetAtelier';
        $this->wsResultKey = 'GetAtelierResult';
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
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestivalAtelier',
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmAtelier();
        $persist = ($entity->getId() === null) ? true : false;
        
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
        if (property_exists($resultObject, 'IdRealisateurs')) {
            // create an array when we get an object to standardize the code
            if (gettype($resultObject->IdRealisateurs) == 'object') {
                $resultObject->IdRealisateurs = array($resultObject->IdRealisateurs);
            }
            
            foreach ($resultObject->IdRealisateurs as $director) {
                $filmPerson = $this->em->getRepository('FDCCoreBundle:FilmPerson')->findOneBy(array('id' => $director->int));
                $filmPerson = ($filmPerson !== null) ? $filmPerson : $this->personManager->updateEntity($director->int);
                
                $filmAtelierPerson = $this->em->getRepository('FDCCoreBundle:FilmAtelierPerson')->findOneBy(array('film' => $entity->getId(), 'person' => $director->int));
                $filmAtelierPerson = ($filmAtelierPerson !== null)  ? $filmAtelierPerson : new FilmAtelierPerson();
                $filmAtelierPerson->setPerson($filmPerson);
                
                // set function
                if ($filmAtelierPerson->getFunctions()->count() == 0) {
                    $functionTranslation = $this->em->getRepository('FDCCoreBundle:FilmFunctionTranslation')->findOneBy(array('locale' => 'en', 'name' => 'Director'));
                    if ($functionTranslation === null) {
                        $this->logger->error(__METHOD__. " {$id}, function translation Director not found");
                    } else {
                        $filmAtelierPersonFunction = new FilmAtelierPersonFunction();
                        $filmAtelierPersonFunction->setFunction($functionTranslation->getFunction());
                        $filmAtelierPerson->addFuntion($filmAtelierPersonFunction);
                    }
                }
            }
        }

        // set production company
        $filmAtelierProductionCompany = $this->em->getRepository('FDCCoreBundle:FilmAtelierProductionCompany')->findOneBy(array('name' => $resultObject->NomSocieteProduction));
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
        
        $country = $this->em->getRepository('FDCCoreBundle:Country')->findOneBy(array('iso' => $resultObject->AdresseSocieteProduction->CodeIsoPays));
        if ($country === null) {
            $this->logger->error(__METHOD__. " {$id} Country with iso {$resultObject->AdresseSocieteProduction->CodeIsoPays} not found");
        } else {
            $filmAtelierProductionCompanyAddress->setCountry($country);
        }
        // @TODO: EtatsTraductions
        $filmAtelierProductionCompany->setAddress($filmAtelierProductionCompanyAddress);
        $entity->setProductionCompany($filmAtelierProductionCompany);
        
        
        // set languages
        foreach ($resultObject->LanguesTournage as $language) {
            $country = $this->em->getRepository('FDCCoreBundle:Country')->findOneBy(array('iso' => $language));
            if ($country === null) {
                $this->logger->error(__METHOD__. " {$id} Country with iso {$language} not found");
            } else {
                $filmAtelierLanguage = new FilmAtelierLanguage();
                $filmAtelierLanguage->setFilm($entity);
                $filmAtelierLanguage->setCountry($country);
                
                if (!$entity->getLanguages()->contains($filmAtelierLanguage)) {
                    $entity->addLanguage($filmAtelierLanguage);
                }
            }
        }

        // set countries
        foreach ($resultObject->PaysTournage as $language) {
            $country = $this->em->getRepository('FDCCoreBundle:Country')->findOneBy(array('iso' => $language));
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
        $filmSelectionSection = $this->em->getRepository('FDCCoreBundle:FilmSelectionSection')->findOneBy(array('id' => $resultObject->IdSectionSelection));
        if ($filmSelectionSection === null) {
            $this->logger->error(__METHOD__. " {$id} FilmSelectionSection with id {$resultObject->IdSectionSelection} not found");
        } else {
            $entity->setSelectionSection($filmSelectionSection);
        }
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);

        // update entity
        $this->update($entity, $persist);
        
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
        $result = $this->soapCall($this->wsMethod, array('fromTimeStamp' => $from, 'toTimeStamp' => $to));
        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        $entities = array();
        $persists = array();
        
        foreach ($resultObject as $object) {
             // create / get entity
            $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmAtelier();
            $persists[] = ($entity->getId() === null) ? true : false;
            
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
            if (property_exists($resultObject, 'IdRealisateurs')) {
                // create an array when we get an object to standardize the code
                if (gettype($resultObject->IdRealisateurs) == 'object') {
                    $resultObject->IdRealisateurs = array($resultObject->IdRealisateurs);
                }
                
                foreach ($resultObject->IdRealisateurs as $director) {
                    $filmPerson = $this->em->getRepository('FDCCoreBundle:FilmPerson')->findOneBy(array('id' => $director->int));
                    $filmPerson = ($filmPerson !== null) ? $filmPerson : $this->personManager->updateEntity($director->int);
                    
                    $filmAtelierPerson = $this->em->getRepository('FDCCoreBundle:FilmAtelierPerson')->findOneBy(array('film' => $entity->getId(), 'person' => $director->int));
                    $filmAtelierPerson = ($filmAtelierPerson !== null)  ? $filmAtelierPerson : new FilmAtelierPerson();
                    $filmAtelierPerson->setPerson($filmPerson);
                    
                    // set function
                    if ($filmAtelierPerson->getFunctions()->count() == 0) {
                        $functionTranslation = $this->em->getRepository('FDCCoreBundle:FilmFunctionTranslation')->findOneBy(array('locale' => 'en', 'name' => 'Director'));
                        if ($functionTranslation === null) {
                            $this->logger->error(__METHOD__. " {$id}, function translation Director not found");
                        } else {
                            $filmAtelierPersonFunction = new FilmAtelierPersonFunction();
                            $filmAtelierPersonFunction->setFunction($functionTranslation->getFunction());
                            $filmAtelierPerson->addFuntion($filmAtelierPersonFunction);
                        }
                    }
                }
            }
    
            // set production company
            $filmAtelierProductionCompany = $this->em->getRepository('FDCCoreBundle:FilmAtelierProductionCompany')->findOneBy(array('name' => $resultObject->NomSocieteProduction));
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
            
            $country = $this->em->getRepository('FDCCoreBundle:Country')->findOneBy(array('iso' => $resultObject->AdresseSocieteProduction->CodeIsoPays));
            if ($country === null) {
                $this->logger->error(__METHOD__. " {$id} Country with iso {$resultObject->AdresseSocieteProduction->CodeIsoPays} not found");
            } else {
                $filmAtelierProductionCompanyAddress->setCountry($country);
            }
            // @TODO: EtatsTraductions
            $filmAtelierProductionCompany->setAddress($filmAtelierProductionCompanyAddress);
            $entity->setProductionCompany($filmAtelierProductionCompany);
            
            
            // set languages
            foreach ($resultObject->LanguesTournage as $language) {
                $country = $this->em->getRepository('FDCCoreBundle:Country')->findOneBy(array('iso' => $language));
                if ($country === null) {
                    $this->logger->error(__METHOD__. " {$id} Country with iso {$language} not found");
                } else {
                    $filmAtelierLanguage = new FilmAtelierLanguage();
                    $filmAtelierLanguage->setFilm($entity);
                    $filmAtelierLanguage->setCountry($country);
                    
                    if (!$entity->getLanguages()->contains($filmAtelierLanguage)) {
                        $entity->addLanguage($filmAtelierLanguage);
                    }
                }
            }
    
            // set countries
            foreach ($resultObject->PaysTournage as $language) {
                $country = $this->em->getRepository('FDCCoreBundle:Country')->findOneBy(array('iso' => $language));
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
            $filmSelectionSection = $this->em->getRepository('FDCCoreBundle:FilmSelectionSection')->findOneBy(array('id' => $resultObject->IdSectionSelection));
            if ($filmSelectionSection === null) {
                $this->logger->error(__METHOD__. " {$id} FilmSelectionSection with id {$resultObject->IdSectionSelection} not found");
            } else {
                $entity->setSelectionSection($filmSelectionSection);
            }
            
            // set related entity
            $this->setEntityRelated($resultObject, $entity);
            
            $entities[] = $entity;
        }
        
        // update entity
        $this->updates($entities, $persists);
        
        // end timer
        $this->end(__METHOD__);
    }
}