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
//        $path = $this->generatePublicUrl($media, $media->getProviderReference());
//
//        # Region where the sample will be run.
//        $region = 'us-east-1';
//
//        $hls_64k_audio_preset_id = '1351620000001-200071';
//        $hls_0400k_preset_id     = '1351620000001-200050';
//        $hls_0600k_preset_id     = '1351620000001-200040';
//        $hls_1000k_preset_id     = '1351620000001-200030';
//        $hls_1500k_preset_id     = '1351620000001-200020';
//        $hls_2000k_preset_id     = '1351620000001-200010';
//
//        $hls_presets = array(
//            'hlsAudio' => $hls_64k_audio_preset_id,
//            'hls0400k' => $hls_0400k_preset_id,
//            'hls0600k' => $hls_0600k_preset_id,
//            'hls1000k' => $hls_1000k_preset_id,
//            'hls1500k' => $hls_1500k_preset_id,
//            'hls2000k' => $hls_2000k_preset_id,
//        );
//
//        # HLS Segment duration that will be targeted.
//        $segment_duration = '2';
//
//        #All outputs will have this prefix prepended to their output key.
//        $output_key_prefix = 'elastic-transcoder-samples/output/hls/';
//
//        # Create the client for Elastic Transcoder.
//        $transcoder_client = ElasticTranscoderClient::factory(array('region' => $region, 'default_caching_config' => '/tmp'));
//
//        // create_hls_job($transcoder_client, $pipeline_id, $input_key, $output_key_prefix, $hls_presets, $segment_duration) {
//            # Setup the job input using the provided input key.
//            $input = array('Key' => $input_key);
//
//            #Setup the job outputs using the HLS presets.
//            $output_key = hash('sha256', utf8_encode($input_key));
//
//            # Specify the outputs based on the hls presets array spefified.
//            $outputs = array();
//            foreach ($hls_presets as $prefix => $preset_id) {
//                array_push($outputs, array('Key' => "$prefix/$output_key", 'PresetId' => $preset_id, 'SegmentDuration' => $segment_duration));
//            }
//
//            # Setup master playlist which can be used to play using adaptive bitrate.
//            $playlist = array(
//                'Name' => 'hls_' . $output_key,
//                'Format' => 'HLSv3',
//                'OutputKeys' => array_map(function($x) { return $x['Key']; }, $outputs)
//            );
//
//            # Create the job.
//            $create_job_request = array(
//                'PipelineId' => $pipeline_id,
//                'Input' => $input,
//                'Outputs' => $outputs,
//                'OutputKeyPrefix' => "$output_key_prefix$output_key/",
//                'Playlists' => array($playlist)
//            );
//            $create_job_result = $transcoder_client->createJob($create_job_request)->toArray();
//            // return $job = $create_job_result['Job'];
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
