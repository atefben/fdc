<?php

namespace Base\SoifBundle\Manager;

use \Exception;

use Application\Sonata\MediaBundle\Entity\Media;

/**
 * MediaStreamManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
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
     * soifUploadDirectory
     * 
     * @var mixed
     * @access protected
     */
    private $soifUploadDirectory;
    
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->wsParameterKey = 'idElementMultimedia';
        $this->wsResultKey = 'GetStreamElementMultimediaResult';
    }
    
    /**
     * setSoifUploadDirectory function.
     * 
     * @access public
     * @param mixed $soifUploadDirectory
     * @return void
     */
    public function setSoifUploadDirectory($soifUploadDirectory)
    {
        $this->soifUploadDirectory = $soifUploadDirectory;
    }
    
    /**
     * setSonataMediaManager function.
     * 
     * @access public
     * @param mixed $sonataMediaManager
     * @return void
     */
    public function setSonataMediaManager($sonataMediaManager)
    {
        $this->sonataMediaManager = $sonataMediaManager;
    }

    /**
     * getById function.
     * 
     * @access public
     * @param mixed $entity
     * @param mixed $id
     * @param mixed $extension
     * @param string $provider (default: 'sonata.media.provider.image')
     * @param string $context (default: 'image')
     * @return void
     */
    public function getById($entity, $id, $extension, $provider = 'sonata.media.provider.image', $context = 'film_film')
    {
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall('GetStreamElementMultimedia', array($this->wsParameterKey => $id));
        $base64 = $result->GetStreamElementMultimediaResult;

        // create file for sonata media
        $filename = $this->soifUploadDirectory. md5($id). '.'. $extension;
        if ($this->createFileFromString($base64, $filename, $extension) === false) {
            return;
        }

        // update entity / generate thumbnails
        $media = $entity->getFile();
        $media = ($media === null) ? $this->sonataMediaManager->create() : $this->sonataMediaManager->find($media->getId());
        $media->setSoifId($id);
        $media->setBinaryContent($filename);
        $media->setEnabled(true);
        $media->setProviderReference($filename);
        $provider = ($extension == 'pdf') ? 'sonata.media.provider.pdf' : $provider;
        $context = ($extension == 'pdf') ? 'pdf' : $context;
        $this->sonataMediaManager->save($media, $context, $provider);

        // update entity
        $entity->setFile($media);
        
        // end timer
        $this->end(__METHOD__);
    }
    
    /**
     * createFileFromString function.
     * 
     * @access private
     * @param mixed $base64
     * @param mixed $extension
     * @return void
     */
    private function createFileFromString($base64, $filename, $extension)
    {
        $extensionsImage = array('jpg', 'gif', 'png');

        if ($extension == 'pdf')
            $result = file_put_contents($filename, $base64);
        else if (in_array($extension, $extensionsImage)) {
            $result = @imagecreatefromstring($base64);
        } else {
            $msg = __METHOD__. " - The extension {$extension} is not supported.";
            $exception = new Exception($msg);
            $this->throwException($msg, $exception);
            return false;
        }
        
        if ($result === false) {
            $msg = __METHOD__. " - Impossible to create image from base 64 of {$this->wsParameterKey} : {$filename}";
            $exception = new Exception($msg);
            $this->throwException($msg, $exception);
        }

        switch ($extension) {
            case 'jpg':
                $file = imagejpeg($result, $filename);
                break;
            case 'gif':
                $file = imagegif($result, $filename);
                break;
            case 'png':
                $file = imagepng($result, $filename);
                break;
            case 'pdf':
                return;
            default:
                $msg = __METHOD__. " - The extension handler {$extension} is not found.";
                $exception = new Exception($msg);
                $this->throwException($msg, $exception);
                break;
        }
        
        if ($file === false) {
            $msg = __METHOD__. " - Impossible to create image from string {$this->wsParameterKey} : {$filename}";
            $exception = new Exception($msg);
            $this->throwException($msg, $exception);
            return false;
        }

        return true;
    }
}