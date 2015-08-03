<?php

namespace FDC\SoifBundle\Manager;

use Application\Sonata\MediaBundle\Entity\Media;

use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

/**
 * MediaStreamManager class.
 * 
 * @extends CoreManager
 */
class MediaStreamManager extends CoreManager
{
    /**
     * sonataMediaManager
     * 
     * @var mixed
     * @access private
     */
    private $sonataMediaManager;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->wsParameterKey = 'idElementMultimedia';
    }
    
    public function setSonataMediaManager($sonataMediaManager)
    {
        $this->sonataMediaManager = $sonataMediaManager;
    }

    public function updateEntity($entity, $id, $provider = 'sonata.provider.media.image', $context = 'image')
    {
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall('GetStreamElementMultimedia', array($this->wsParameterKey => $id));
        
        // verify result
        if (!isset($result->GetStreamElementMultimediaResult)) {
            $msg = __METHOD__. ' failed to parse results';
            $exception = new MissingMandatoryParametersException($msg);
            $this->throwException($msg, $exception);
        }
        $result = $result->GetStreamElementMultimediaResult;

        // update entity
        $media = $entity->getFile();
        $media = ($media === null) ? $this->sonataMediaManager->create() : $media;
        $media->setBinaryContent('/Users/antmin/Desktop/ok.png');
        $this->sonataMediaManager->save($media, $context, $provider);

        // update entity
        $entity->setMedia($media);
        
        // end timer
        $this->end(__METHOD__);
    }
}