<?php

namespace FDC\SoifBundle\Manager;

use FDC\CoreBundle\Entity\FilmFestival;

use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

/**
 * FestivalManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class FestivalManager extends CoreManager
{
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->repository = 'FDCCoreBundle:FilmFestival';
        $this->wsParameterKey = 'idFestival';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setYear' => 'Annee'
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
        $result = $this->soapCall('GetFestival', array($this->wsParameterKey => $id));
        // verify result
        if (!isset($result->GetFestivalResult->Resultats->FestivalDto)) {
            $msg = __METHOD__. ' failed to parse results';
            $exception = new MissingMandatoryParametersException($msg);
            $this->throwException($msg, $exception);
        }
        // get the result - create / get entity
        $result = $result->GetFestivalResult->Resultats->FestivalDto;
        $entity = ($this->findOneById(array('id' => $result->{$this->entityIdKey}))) ?: new FilmFestival();
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
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}