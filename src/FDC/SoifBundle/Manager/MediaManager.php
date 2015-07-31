<?php

namespace FDC\SoifBundle\Manager;

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
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->repository = 'FDCCoreBundle:FilmMedia';
        $this->wsParameterKey = 'idElementMultimedia';
        $this->entityIdKey = 'IdSoif';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setCopyright' => 'Copyright',
            'setCategory' => 'IdCategorie',
            'setContentType' => 'ContentType',
            'setTitleVf' => 'LibelleFr',
            'setTitleVa' => 'LibelleEn',
            'setType' => 'Type'
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
        $parameters = array(
            'idElementMultimedia' => $id
        );
        $result = $this->soapCall('GetElementMultimedia', $parameters);
        
        // verify result
        if (!isset($result->GetElementMultimediaResult->Resultats->ElementMultimediaDto)) {
            $msg = __METHOD__. ' failed to parse results';
            $exception = new MissingMandatoryParametersException($msg);
            $this->throwException($msg, $exception);
        }
        $result = $result->GetElementMultimediaResult->Resultats->ElementMultimediaDto;
        $entity = ($this->findOneById(array('id' => $result->{$this->entityIdKey}))) ?: new FilmMedia();
        $persist = ($entity->getId() === null) ? true : false;

        // update entity
        foreach ($this->mapper as $setter => $soapKey) {
            if (!isset($result->{$soapKey})) {
                $this->logger->warn(__METHOD__. 'Key '. $soapKey. ' not found in WS Result');
                continue;
            }
            
            if (!method_exists($entity, $setter)) {
                $this->logger->warn(__METHOD__. 'Method '. $setter. ' not found in Entity '. get_class($entity));
                continue;
            }
            $entity->{$setter}($result->{$soapKey});
        }
        
        if (isset($result->IdFestival)) {
            $festival = $this->em->getRepository('FDCCoreBundle:FilmFestival')->findOneById($result->IdFestival);
            if ($festival === null) {
                $this->logger->warn(__METHOD__. 'Entity '. get_class($entity). ' with id '. $result->IdFestival. ' not found');
            } else {
                $entity->setFestival($festival);
            }
        } else {
            $this->logger->warn('Key IdFestival not found in WS Result');
        }
        
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
                return "default";
        }
    }
}