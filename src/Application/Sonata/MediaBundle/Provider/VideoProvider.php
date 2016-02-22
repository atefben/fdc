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
        return new Metadata($this->getName(), $this->getName() . '.description', false, 'SonataMediaBundle', array('class' => 'fa fa-picture-o'));
    }

    public function generateThumbnails(MediaInterface $media)
    {
        if ($media->getParentVideoTranslation()) {
            $parentVideo = $media->getParentVideoTranslation();
        } elseif ($media->getParentAudioTranslation()) {
            $parentAudio = $media->getParentAudioTranslation();
        } else {
            throw new NotFoundHttpException('Media parent not found.');
        }

        $elasticTranscoder = ElasticTranscoderClient::factory(array(
            'credentials' => array(
                'key'    => 'AKIAJHXD67GEPPA2F4TQ',
                'secret' => '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',
            ),
            'region'      => 'eu-west-1',
        ));

        if (isset($parentVideo)) {
			
			$file_name = $media->getProviderReference();
            $path = $this->generatePublicUrl($media, $media->getProviderReference());

            $file_path = explode('/', $path);
            $path_video_input = $file_path['3'] . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';
            $path_video_output = 'media_video_encoded' . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';

            //System preset generic 1080p MP4 ID : 1456133456345-3dts1g
            $job = $elasticTranscoder->createJob(array(
                'PipelineId'      => '1454076999739-uy533t',
                'OutputKeyPrefix' => $path_video_output,
                'Input'           => array(
                    'Key'         => $path_video_input . $file_name,
                    'FrameRate'   => 'auto',
                    'Resolution'  => 'auto',
                    'AspectRatio' => 'auto',
                    'Interlaced'  => 'auto',
                    'Container'   => 'auto',
                ),
                'Outputs'         => array(
                    array(
                        'Key'      => str_replace('.mov', '.mp4', $file_name),
                        'Rotate'   => 'auto',
                        'PresetId' => '1456133456345-3dts1g',
                    ),
                ),
            ));
			
			/* @TODO
			récupérer l'URL du fichier généré par amazon
			*/

            $parentVideo->setJobMp4Id($job->get('Job')['Id']);
			$parentVideo->setMp4Url($path_video_output . str_replace('.mov', '.mp4', $file_name));
            $parentVideo->setJobMp4State(1);


            //System preset: Webm 720p ID : 1456133404879-sv127j
            $job = $elasticTranscoder->createJob(array(
                'PipelineId'      => '1454076999739-uy533t',
                'OutputKeyPrefix' => $path_video_output,
                'Input'           => array(
                    'Key'         => $path_video_input . $file_name,
                    'FrameRate'   => 'auto',
                    'Resolution'  => 'auto',
                    'AspectRatio' => 'auto',
                    'Interlaced'  => 'auto',
                    'Container'   => 'auto',
                ),
                'Outputs'         => array(
                    array(
                        'Key'      => str_replace(array('.mp4', '.mov'), '.webm', $file_name),
                        'Rotate'   => 'auto',
                        'PresetId' => '1456133404879-sv127j',
                    ),
                ),
            ));
			
			/* @TODO
			 récupérer l'URL du fichier généré par amazon
			*/
			//$parentVideo->setImageAmazonUrl($job->get('Job')['img_url']);

            $parentVideo->setJobWebmId($job->get('Job')['Id']);
			$parentVideo->setWebmURL($path_video_output . str_replace(array('.mp4', '.mov'), '.webm', $file_name));
            $parentVideo->setJobWebmState(1);
			
        } elseif (isset($parentAudio)) {
            $file_name = $media->getProviderReference();
	        $path = $this->generatePublicUrl($media, $media->getProviderReference());
	        $file_path = explode('/', $path);
	        $path_audio_input = $file_path['3'] . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';
	        $path_audio_output = 'media_audio_encoded' . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';

	        //System preset: Audio MP3 - 128k : 1351620000001-300040
	        $job = $elasticTranscoder->createJob(array(
	            'PipelineId'      => '1455903590532-u7lwud',
	            'OutputKeyPrefix' => $path_audio_output,
	            'Input'           => array(
	                'Key'         => $path_audio_input . $file_name,
	            ),
	            'Outputs'         => array(
	                array(
	                    'Key'      => $file_name,
	                    'PresetId' => '1351620000001-300040',
	                ),
	            ),
	        ));
            $parentAudio->setJobMp3Id($job->get('Job')['Id']);
            $parentAudio->setMp3Url($path_audio_output . $file_name);
           	$parentAudio->setJobMp3State(1);
        }

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
            $path = tempnam(sys_get_temp_dir(), 'sonata_update_metadata');
            $fileObject = new \SplFileObject($path, 'w');
            $fileObject->fwrite($this->getReferenceFile($media)->getContent());

            $image = $this->imagineAdapter->open($fileObject->getPathname());
            $size = $image->getSize();

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
