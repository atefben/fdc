<?php

namespace Application\Sonata\MediaBundle\Provider;

use Sonata\MediaBundle\Provider\FileProvider;
use Sonata\MediaBundle\Model\MediaInterface;

use Aws\ElasticTranscoder\ElasticTranscoderClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
		// problem mime-type MOV
		//error_log(print_r($media->getBinaryContent(),true));
		//error_log(print_r($media->getClientOriginalName(),true));
		
		//error_log(print_r(substr($media->getClientOriginalName(), -3),true));


		if ($media->getParentVideoTranslation()) {
			$parent = $media->getParentVideoTranslation();
		}
		elseif ($media->getParentAudioTranslation()) {
			$parent = $media->getParentAudioTranslation();
		}
		else {
			throw new NotFoundHttpException('Media parent not found.');
		}
		$path = $this->generatePublicUrl($media, $media->getProviderReference());

		$file_path = explode('/', $path);
		$path_video_input = $file_path['3'] . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';
		$path_video_output = 'media_video_encoded' . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';

		//mime_content_type('php.gif');
		
		$elasticTranscoder = ElasticTranscoderClient::factory(array(
		    'credentials' => array(
		        'key' => 'AKIAJHXD67GEPPA2F4TQ',
		        'secret' => '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',
		    ),
		    'region' => 'eu-west-1',
		));

		//System preset generic 1080p MP4 ID : 1351620000001-000001
		$job = $elasticTranscoder->createJob(array(
		    'PipelineId' => '1454076999739-uy533t',
		    'OutputKeyPrefix' => $path_video_output,
		    'Input' => array(
		        'Key' => $path_video_input . $media->getProviderReference(),
		        'FrameRate' => 'auto',
		        'Resolution' => 'auto',
		        'AspectRatio' => 'auto',
		        'Interlaced' => 'auto',
		        'Container' => 'auto',
		    ),
		    'Outputs' => array(
		        array(
		            'Key' =>  $media->getProviderReference(),
		            'Rotate' => 'auto',
		            'PresetId' => '1351620000001-000001',
		        ),
		    ),
		));

		
		$jobData = $job->get('Job');
		$parent->setJobMp4Id($jobData['Id']);
		$parent->setJobMp4State(1);

		//System preset: Webm 720p ID : 1351620000001-100240
		$job = $elasticTranscoder->createJob(array(
		    'PipelineId' => '1454076999739-uy533t',
		    'OutputKeyPrefix' => $path_video_output,
		    'Input' => array(
		        'Key' => $path_video_input . $media->getProviderReference(),
		        'FrameRate' => 'auto',
		        'Resolution' => 'auto',
		        'AspectRatio' => 'auto',
		        'Interlaced' => 'auto',
		        'Container' => 'auto',
		    ),
		    'Outputs' => array(
		        array(
		            'Key' =>  str_replace('.mp4', '.webm', $media->getProviderReference()),
		            'Rotate' => 'auto',
		            'PresetId' => '1351620000001-100240',
		        ),
		    ),
		));
		
		$jobData = $job->get('Job');
		$parent->setJobWebmId($jobData['Id']);
		$parent->setJobWebmState(1);
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
