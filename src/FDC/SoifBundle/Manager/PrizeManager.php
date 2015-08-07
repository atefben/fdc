<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmPrize;
use FDC\CoreBundle\Entity\FilmPrizeTranslation;

use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

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
        $this->repository = 'FDCCoreBundle:FilmPrize';
        $this->wsMethod = 'GetPrize';
        $this->wsParameterKey = 'idPrix';
        $this->entityIdKey = 'Id';
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
        // verify result
        if (!isset($result->GetPrizeResult->Resultats->PrixDto)) {
            $msg = __METHOD__. ' failed to parse results';
            $exception = new MissingMandatoryParametersException($msg);
            $this->throwException($msg, $exception);
        }
        
        // get soifupdatedat
        $soifUpdatedAt = null;
        if (!isset($result->GetPrizeResult->DateDerniereModification)) {
            $this->logger->warning(__METHOD__. 'DateDerniereModification not found in WS Result');
        } else {
            $soifUpdatedAt = new \DateTime($result->GetPrizeResult->DateDerniereModification);
        }
        
        // get the result - create / get entity
        $result = $result->GetPrizeResult->Resultats->PrixDto;
        $entity = ($this->findOneById(array('id' => $result->{$this->entityIdKey}))) ?: new FilmPrize();
        $persist = ($entity->getId() === null) ? true : false;

        // set entity properties
        foreach ($this->mapper as $setter => $soapKey) {
            if (!isset($result->{$soapKey})) {
                $this->logger->warning(__METHOD__. 'Key '. $soapKey. ' not found in WS Result');
                continue;
            }
            
            if (!method_exists($entity, $setter)) {
                $this->logger->warning(__METHOD__. 'Method '. $setter. ' not found in Entity '. get_class($entity));
                continue;
            }
            $entity->{$setter}($result->{$soapKey});
        }
        
        // set soif updated at
        if ($soifUpdatedAt !== null) {
            $entity->setSoifUpdatedAt($soifUpdatedAt);
        }
        
        // set translations
        $localesMapper = $this->getLocalesMapper();
        foreach ($this->mapperTranslations as $key => $mapper) {
            $entityTranslations = $entity->getTranslations();
            if (!isset($result->{$key}->{$mapper['result']})) {
                $msg = __METHOD__. ' failed to parse results';
                $exception = new MissingMandatoryParametersException($msg);
                $this->throwException($msg, $exception);
            }
            $translations = $result->{$key}->{$mapper['result']};
        
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