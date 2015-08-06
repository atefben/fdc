<?php

namespace FDC\SoifBundle\Manager;

use FDC\CoreBundle\Entity\FilmAward;

use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

/**
 * AwardManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class AwardManager extends CoreManager
{
    /**
     * festivalManager
     * 
     * @var mixed
     * @access private
     */
    private $festivalManager;
    
    /**
     * prizeManager
     * 
     * @var mixed
     * @access private
     */
    private $prizeManager;
    
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager, $prizeManager)
    {
        $this->festivalManager = $festivalManager;
        $this->prizeManager = $prizeManager;
        $this->repository = 'FDCCoreBundle:FilmAward';
        $this->wsMethod = 'GetAward';
        $this->wsParameterKey = 'idAward';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setComment' => 'Commentaire',
            'setExAequo' => 'ExAequo',
            'setFilmMutual' => 'CommunFilm',
            'setPersonMutual' => 'CommunPersonne',
            'setPosition' => 'OrdreAffichage',
            'setUnanimity' => 'Unanimite'
        );
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            ),
            array(
                'repository' => 'FDCCoreBundle:FilmPrize',
                'soapKey' => 'IdPrix',
                'setter' => 'setPrize',
                'manager' => $this->prizeManager
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
        if (!isset($result->GetAwardResult->Resultats->RecompenseDto)) {
            $msg = __METHOD__. ' failed to parse results';
            $exception = new MissingMandatoryParametersException($msg);
            $this->throwException($msg, $exception);
        }
        
        // get soifupdatedat
        $soifUpdatedAt = null;
        if (!isset($result->GetAwardResult->DateDerniereModification)) {
            $this->logger->warning(__METHOD__. ' DateDerniereModification not found in WS Result');
        } else {
            $soifUpdatedAt = new \DateTime($result->GetAwardResult->DateDerniereModification);
        }
        
        // get the result - create / get entity
        $soifUpdatedAt = new \DateTime($result->GetAwardResult->DateDerniereModification);
        $result = $result->GetAwardResult->Resultats->RecompenseDto;
        $entity = ($this->findOneById(array('id' => $result->{$this->entityIdKey}))) ?: new FilmAward();
        $persist = ($entity->getId() === null) ? true : false;

        // set entity properties
        foreach ($this->mapper as $setter => $soapKey) {
            if (!isset($result->{$soapKey})) {
                $this->logger->warning(__METHOD__. ' Key '. $soapKey. ' not found in WS Result');
                continue;
            }
            
            if (!method_exists($entity, $setter)) {
                $this->logger->warning(__METHOD__. ' Method '. $setter. ' not found in Entity '. get_class($entity));
                continue;
            }
            $entity->{$setter}($result->{$soapKey});
        }
        
        // set soif updated at
        if ($soifUpdatedAt !== null)  {
            $entity->setSoifUpdatedAt($soifUpdatedAt);
        }
        
        // set related entity
        foreach ($this->mapperEntity as $property) {
            $property['manager'] = ($property['manager'] !== null) ? $property['manager'] : null;
            $entityRelated = $this->updateRelatedEntity($property['repository'], $result, $property['soapKey'], $property['manager']);
            if ($entityRelated !== null) {
                $entity->{$property['setter']}($entityRelated);
            }
        }
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}