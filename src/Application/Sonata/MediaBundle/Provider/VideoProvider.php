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
		//$path = $this->generatePublicUrl($media, $media->getProviderReference());
		$elasticTranscoder = ElasticTranscoderClient::factory(array(
		    'credentials' => array(
		        'key' => 'AKIAJHXD67GEPPA2F4TQ',
		        'secret' => '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',
		    ),
		    'region' => 'eu-west-1',
		));
		error_log('MATDAC DEBUG 1 :: ' . print_r($media->path(), true));
		//System preset generic 1080p MP4 ID : 1351620000001-000001
		
		$job = $elasticTranscoder->createJob(array(
		    'PipelineId' => '1454076999739-uy533t',
		    'OutputKeyPrefix' => 'your/output/prefix/',
		    'Input' => array(
		        'Key' => $media->getProviderReference(),
		        'FrameRate' => 'auto',
		        'Resolution' => 'auto',
		        'AspectRatio' => 'auto',
		        'Interlaced' => 'auto',
		        'Container' => 'auto',
		    ),
		    'Outputs' => array(
		        array(
		            'Key' => str_replace('media_video', 'media_video_encoded', $media->getProviderReference()),
		            'Rotate' => 'auto',
		            'PresetId' => '1351620000001-000001',
		        ),
		    ),
		));
		
		$jobData = $job->get('Job');
		error_log('MATDAC DEBUG 2 :: ' . print_r($jobData, true));
		$jobId = $jobData['Id'];
		error_log('MATDAC DEBUG 3 :: ' . $jobId);
       
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
