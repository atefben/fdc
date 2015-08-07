<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmJury;
use FDC\CoreBundle\Entity\FilmJuryFunction;
use FDC\CoreBundle\Entity\FilmJuryFunctionTranslation;
use FDC\CoreBundle\Entity\FilmJuryTranslation;

/**
 * JuryManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class JuryManager extends CoreManager
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
     * juryFunctionManager
     * 
     * @var mixed
     * @access private
     */
    private $juryFunctionManager;
    

    /**
     * __construct function.
     * 
     * @access public
     * @param mixed $festivalManager
     * @return void
     */
    public function __construct($festivalManager, $personManager, $juryFunctionManager)
    {
        $this->festivalManager = $festivalManager;
        $this->repository = 'FDCCoreBundle:FilmJury';
        $this->wsMethod = 'GetJury';
        $this->wsResultKey = 'GetJuryResult';
        $this->wsResultObjectKey = 'JuryDto';
        $this->wsParameterKey = 'idJury';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setPosition' => 'OrdreAffichage'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            ),
            array(
                'repository' => 'FDCCoreBundle:FilmPerson',
                'soapKey' => 'IdPersonne',
                'setter' => 'setPerson',
                'manager' => $this->personManager
            ),
           /* array(
                'repository' => 'FDCCoreBundle:FilmJuryType',
                'soapKey' => 'TypeJury',
                'soapKeyIdentifier' => 'Id'
                'setter' => 'setType',
                'manager' => $this->juryTypeManager
            ),*/
        );
        $this->mapperTranslations = array(
            'BiographiesTraductions' => array(
                'result' => 'BiographieTraductionDto',
                'setter' => 'setBiography',
                'wsKey' => 'Description'
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmJury();
        $persist = ($entity->getId() === null) ? true : false;
        
        var_dump($resultObject);
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);

        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // set translations
        $this->setEntityTranslations($resultObject, $entity, new FilmJuryTranslation());
        
        // set function translation
        
        /*
                        'Traductions' => array(
                'result' => 'FonctionTraductionDto',
                'setter' => 'setName',
                'wsKey' => 'Libelle'
            )
            */
        if (!isset($resultObject->Fonction)) {
            $msg = __METHOD__. ' failed to parse results';
            $exception = new Exception($msg);
            $this->throwException($msg, $exception);
        }
        
        $function = $this->em->getRepository('FDCCoreBundle:FilmJuryFunction')->findOneBy(array('id' => $resultObject->Fonction->Id));
        $function = ($function !== null) ? $function : new FilmJuryFunction();
        $function->setId($resultObject->Fonction->Id);
        
        if (!isset($resultObject->Fonction->Traductions) || !isset($resultObject->Fonction->Traductions->FonctionTraductionDto)) {
            $msg = __METHOD__. ' failed to parse results';
            $exception = new Exception($msg);
            $this->throwException($msg, $exception);
        }
        // adapt this with previous comment
        /*$localesMapper = $this->getLocalesMapper();
        foreach ($this->mapperTranslations as $key => $mapper) {
            $entityTranslations = $entity->getTranslations();
            if (!isset($result->{$key}->{$mapper['result']})) {
                $msg = __METHOD__. ' failed to parse results';
                $exception = new Exception($msg);
                $this->throwException($msg, $exception);
            }
            $translations = $result->{$key}->{$mapper['result']};
        
            foreach ($translations as $translation) {
                if (!isset($localesMapper[$translation->CodeLangue])) {
                    $this->logger->warn("the locales mapper {$translation->CodeLangue} doesn't exist");
                    continue;
                }
                if (!isset($entityTranslation[$translation->CodeLangue])) {
                    $entityTranslation[$translation->CodeLangue] = $entity->findTranslationByLocale($localesMapper[$translation->CodeLangue]);
                }
                $entityTranslation[$translation->CodeLangue] = ($entityTranslation[$translation->CodeLangue] !== null) ? $entityTranslation[$translation->CodeLangue] : new FilmJuryFunctionTranslation();
                $entityTranslation[$translation->CodeLangue]->{$mapper['setter']}($translation->{$mapper['wsKey']});
                $entityTranslation[$translation->CodeLangue]->setLocale($localesMapper[$translation->CodeLangue]);
                
                if ($entityTranslation[$translation->CodeLangue]->getId() === null) {
                    $entity->addTranslation($entityTranslation[$translation->CodeLangue]);
                }
            }
        }*/
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}