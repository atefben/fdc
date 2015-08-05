<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

use FDC\CoreBundle\Entity\FilmMedia;

use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

/**
 * MediaManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class MediaManager extends CoreManager
{
    
    /**
     * festivalManager
     * 
     * @var mixed
     * @access private
     */
    private $festivalManager;
    
    /**
     * mediaStreamManager
     * 
     * @var mixed
     * @access private
     */
    private $mediaStreamManager;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager, $mediaStreamManager)
    {
        $this->repository = 'FDCCoreBundle:FilmMedia';
        $this->wsParameterKey = 'idElementMultimedia';
        $this->entityIdKey = 'IdSoif';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setCopyright' => 'Copyright',
            'setContentType' => 'ContentType',
            'setTitleVf' => 'LibelleFr',
            'setTitleVa' => 'LibelleEn',
            'setType' => 'Type'
        );
        $this->festivalManager = $festivalManager;
        $this->mediaStreamManager = $mediaStreamManager;
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            ),
            array(
                'repository' => 'FDCCoreBundle:FilmMediaCategory',
                'soapKey' => 'IdCategorie',
                'setter' => 'setCategory',
                'manager' => null
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
        $result = $this->soapCall('GetElementMultimedia', array($this->wsParameterKey => $id));
        
        // verify result
        if (!isset($result->GetElementMultimediaResult->Resultats->ElementMultimediaDto)) {
            $msg = __METHOD__. ' - failed to parse results';
            $exception = new MissingMandatoryParametersException($msg);
            $this->throwException($msg, $exception);
        }
        $result = $result->GetElementMultimediaResult->Resultats->ElementMultimediaDto;
        
        $entity = ($this->findOneById(array('id' => $result->{$this->entityIdKey}))) ?: new FilmMedia();
        $persist = ($entity->getId() === null) ? true : false;

        // set entity properties
        foreach ($this->mapper as $setter => $soapKey) {
            if (!isset($result->{$soapKey})) {
                $this->logger->warning(__METHOD__. ' - Key '. $soapKey. ' not found in WS Result');
                continue;
            }
            
            if (!method_exists($entity, $setter)) {
                $this->logger->warning(__METHOD__. ' -  Method '. $setter. ' not found in Entity '. get_class($entity));
                continue;
            }
            $entity->{$setter}($result->{$soapKey});
        }
        
        // set related entity
        foreach ($this->mapperEntity as $property) {
            $property['manager'] = ($property['manager'] !== null) ? $property['manager'] : null;
            $entityRelated = $this->findRelatedEntity($property['repository'], $result, $property['soapKey'], $property['manager']);
            if ($entityRelated !== null) {
                $entity->{$property['setter']}($entityRelated);
            }
        }
        
        // set related media
        $this->mediaStreamManager->updateEntity($entity, $result->{$this->entityIdKey}, $this->mimeToExtension($result->ContentType));
        

        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
    
    /**
     * mimeToExtension function.
     * 
     * @access private
     * @param mixed $mimeType
     * @return void
     */
    private function mimeToExtension($mimeType) {
        switch ($mimeType) {
            case "application/pdf":
                return "pdf";
            case "image/gif":
                return "gif";
            case "image/png":
                return "png";
            case "image/jpeg":
                return "jpg";
            default:
                $msg = __METHOD__. " - The mime type {$mimeType} is not supported.";
                $exception = new Exception($msg);
                $this->throwException($msg, $exception);
        }
    }
}