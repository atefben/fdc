<?php

namespace Application\Sonata\MediaBundle\Provider;

use Sonata\MediaBundle\Provider\FileProvider;
use Sonata\MediaBundle\Model\MediaInterface;

use Aws\ElasticTranscoder\ElasticTranscoderClient;

class VideoProvider extends FileProvider
{
    /**
     * {@inheritdoc}
     */
    public function getProviderMetadata()
    {
        return new Metadata($this->getName(), $this->getName().'.description', false, 'SonataMediaBundle', array('class' => 'fa fa-picture-o'));
    }

    public function generateThumbnails(MediaInterface $media)
    {
		//error_log(print_r($media, true));
		
		$path = $this->generatePublicUrl($media, $media->getProviderReference());
		error_log(print_r($this->getReferenceImage($media), true));
		exit();
		$elasticTranscoder = ElasticTranscoderClient::factory(array(
		    'credentials' => array(
		        'key' => 'your key',
		        'secret' => 'your secret',
		    ),
		    'region' => 'eu-west-1', // dont forget to set the region
		));
		
		$job = $elasticTranscoder->createJob(array(
		    'PipelineId' => '<your pipeline id>',
		    'OutputKeyPrefix' => 'your/output/prefix/',
		    'Input' => array(
		        'Key' => 'key/to/your/input/file.mp4',
		        'FrameRate' => 'auto',
		        'Resolution' => 'auto',
		        'AspectRatio' => 'auto',
		        'Interlaced' => 'auto',
		        'Container' => 'auto',
		    ),
		    'Outputs' => array(
		        array(
		            'Key' => 'myOutput.mp4',
		            'Rotate' => 'auto',
		            'PresetId' => '<your trancoding preset id>',
		        ),
		    ),
		));

		$jobData = $job->get('Job');
		$jobId = $jobData['Id'];
		error_log($jobId);
		
        //
       
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceImage(MediaInterface $media)
    {
        return sprintf('%s/%s',
            $this->generatePath($media),
            $media->getProviderReference()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function doTransform(MediaInterface $media)
    {
        parent::doTransform($media);

        if (!is_object($media->getBinaryContent()) && !$media->getBinaryContent()) {
            return;
        }

        $media->setProviderStatus(MediaInterface::STATUS_OK);
    }

    /**
     * {@inheritdoc}
     */
    public function updateMetadata(MediaInterface $media, $force = true)
    {
        try {
            // this is now optimized at all!!!
            $path       = tempnam(sys_get_temp_dir(), 'sonata_update_metadata');
            $fileObject = new \SplFileObject($path, 'w');
            $fileObject->fwrite($this->getReferenceFile($media)->getContent());

            $image = $this->imagineAdapter->open($fileObject->getPathname());
            $size  = $image->getSize();

            $media->setSize($fileObject->getSize());
            $media->setWidth($size->getWidth());
            $media->setHeight($size->getHeight());
        } catch (\LogicException $e) {
            $media->setProviderStatus(MediaInterface::STATUS_ERROR);

            $media->setSize(0);
            $media->setWidth(0);
            $media->setHeight(0);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function generatePublicUrl(MediaInterface $media, $format)
    {
        if ($format == 'reference') {
            $path = $this->getReferenceImage($media);
        } else {
            $path = $this->thumbnail->generatePublicUrl($this, $media, $format);
        }

        return $this->getCdn()->getPath($path, $media->getCdnIsFlushable());
    }

    /**
     * {@inheritdoc}
     */
    public function generatePrivateUrl(MediaInterface $media, $format)
    {
        return $this->thumbnail->generatePrivateUrl($this, $media, $format);
    }

}
