<?php

namespace FDC\SoifBundle\Manager;

use \DateTime;

use FDC\CoreBundle\Entity\FilmAtelier;
use FDC\CoreBundle\Entity\FilmAtelierTranslation;

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
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager)
    {
        // managers
        $this->festivalManager = $festivalManager;

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
                $filmPerson = $this->em->getRepository('FDCCoreBundle:FilmPerson')->findOneBy(array('person' => $director->int));
                $filmPerson = ($filmPerson !== null) ? $person : $this->personManager->updateEntity($director->int);
                
                $filmAtelierPerson = $this->em->getRepository('FDCCoreBundle:FilmAtelierPerson')->findOneBy(array('film', $entity->getId(), 'person' => $director->int, 'function' => $director->IdFunction));
                $filmAtelierPerson = ($filmAtelierPerson !== null)  ? $filmAtelierPerson : new FilmAtelierPerson();
                $filmAtelierPerson->setPerson($filmPerson);
                
                $filmFunction = $function = $this->em->getRepository('FDCCoreBundle:FilmFunction')->findOneById($object->IdFonction);
                if ($function !== null) {
                    $filmFilmPerson->setFunction($function);
                }
               // $function = $this->em->getRepository('FDCCoreBundle:FilmFunctionTranslation')->
               // $entity->addPerson()
                
            }
        }
        // set persons (realisateurs)
      //  if (property_exists($object, 'IdRealisateurs'))
        //$persons = $entity->getPersons();
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);

        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}