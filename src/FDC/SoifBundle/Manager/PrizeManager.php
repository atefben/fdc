<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmPrize;
use FDC\CoreBundle\Entity\FilmPrizeTranslation;

/**
 * PrizeManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class PrizeManager extends CoreManager
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
        $this->repository = 'FDCCoreBundle:FilmPrize';
        $this->wsParameterKey = 'idPrix';
        $this->wsMethod = 'GetPrize';
        $this->wsResultKey = 'GetPrizeResult';
        $this->wsResultObjectKey = 'PrixDto';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setPosition' => 'OrdreGeneral',
            'setType' => 'TypePrix'
        );
        $this->mapperTranslations = array(
            'CategorieTraductions' => array(
                'result' => 'CategoriePrixTraductionDto',
                'setter' => 'setTitle',
                'wsKey' => 'Libelle'
            ),
            'TitreTraductions' => array(
                'result' => 'TitreTraductionDto',
                'setter' => 'setCategory',
                'wsKey' => 'Titre'
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
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmPrize();
        $persist = ($entity->getId() === null) ? true : false;
        
        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set translations
        $localesMapper = $this->getLocalesMapper();
        foreach ($this->mapperTranslations as $key => $mapper) {
            $entityTranslations = $entity->getTranslations();
            if (!isset($resultObject->{$key}->{$mapper['result']})) {
                $msg = __METHOD__. ' failed to parse results';
                $exception = new Exception($msg);
                $this->throwException($msg, $exception);
            }
            $translations = $resultObject->{$key}->{$mapper['result']};
        
            foreach ($translations as $translation) {
                if (!isset($localesMapper[$translation->CodeLangue])) {
                    $this->logger->warn("the locales mapper {$translation->CodeLangue} doesn't exist");
                    continue;
                }
                $entityTranslation = $entity->findTranslationByLocale($localesMapper[$translation->CodeLangue]);
                $entityTranslation = ($entityTranslation !== null) ? $entityTranslation : new FilmPrizeTranslation();
                $entityTranslation->{$mapper['setter']}($translation->{$mapper['wsKey']});
                
                if ($entityTranslation->getId() === null) {
                    $entityTranslation->setLocale($localesMapper[$translation->CodeLangue]);
                    $entity->addTranslation($entityTranslation);
                }
                
            }
        }
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}