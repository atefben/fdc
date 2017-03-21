<?php

namespace Base\AdminBundle\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Aws\ElasticTranscoder\ElasticTranscoderClient;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use FDC\CourtMetrageBundle\Entity\CcmMediaAudioTranslation;
use FDC\CourtMetrageBundle\Entity\CcmMediaVideoTranslation;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MediaListener
 * @package Base\CoreBundle\Listener
 */
class CcmMediaListener
{
    /**
     * @var bool
     */
    private $flush;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
        $this->flush = false;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->flush = true;

        if ($entity instanceof CcmMediaAudioTranslation && $entity->getAmazonRemoteFile()) {
            $this->createAmazonAudioJob($entity, $args);
        }

        if ($entity instanceof CcmMediaVideoTranslation && $entity->getAmazonRemoteFile()) {
            $this->createAmazonVideoJob($entity, $args);
        }

        if (($entity instanceof CcmMediaVideoTranslation || $entity instanceof CcmMediaAudioTranslation) && $entity->getFile()) {
            $this->generateThumbnails($entity->getFile());
        }
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof CcmMediaVideoTranslation && $entity->getAmazonRemoteFile() && $args->hasChangedField('amazonRemoteFile')) {
            $this->createAmazonVideoJob($entity, $args);
        }

        if ($entity instanceof CcmMediaAudioTranslation && $entity->getAmazonRemoteFile() && $args->hasChangedField('amazonRemoteFile')) {
            $this->createAmazonAudioJob($entity, $args);
        }

        $firstCondition = $entity instanceof CcmMediaVideoTranslation || $entity instanceof CcmMediaAudioTranslation;
        if ($firstCondition && $entity->getFile() && $args->hasChangedField('file')) {
            $this->generateThumbnails($entity->getFile());
        }
    }

    /**
     * @param PostFlushEventArgs $eventArgs
     */
    public function postFlush(PostFlushEventArgs $eventArgs)
    {
        if ($this->flush === true) {
            $this->flush = false;
            $eventArgs->getEntityManager()->flush();
        }
    }

    /**
     * @param CcmMediaAudioTranslation $mediaAudio
     * @param PreUpdateEventArgs $args
     */
    protected function createAmazonAudioJob(CcmMediaAudioTranslation $mediaAudio, $args)
    {
        $file_name = $mediaAudio->getAmazonRemoteFile()->getName();
        $file_path = explode('/', $mediaAudio->getAmazonRemoteFile()->getUrl());
        $path_audio_input = $file_path['0'] . '/';
        $path_audio_output = 'media_audio_encoded' . '/direct_encoded/';
        $em = $args->getEntityManager();
        $medias_audio_exist = $em->getRepository('FDCCourtMetrageBundle:CcmMediaAudioTranslation')->findOneBy(array('mp3Url' => $path_audio_output . $file_name));
        if ($medias_audio_exist) {
            $mediaAudio->setMp3Url($path_audio_output . $file_name);
            $mediaAudio->setJobMp3Id($medias_audio_exist->getJobMp3Id());
            $mediaAudio->setJobMp3State($medias_audio_exist->getJobMp3State());
        } else {
            $elasticTranscoder = ElasticTranscoderClient::factory(array(
                'credentials' => array(
                    'key'    => $this->getParameter('s3_access_key'),
                    'secret' => $this->getParameter('s3_secret_key'),
                ),
                'region'      => $this->getParameter('s3_video_region'),
            ));
            $job = $elasticTranscoder->createJob(array(
                'PipelineId'      => $this->getParameter('s3_elastic_mp3_pipeline_id'),
                'OutputKeyPrefix' => $path_audio_output,
                'Input'           => array(
                    'Key' => $path_audio_input . $file_name,
                ),
                'Outputs'         => array(
                    array(
                        'Key'      => $file_name,
                        'PresetId' => $this->getParameter('s3_elastic_mp3_preset_id'),
                    ),
                ),
            ));
            $mediaAudio->setJobMp3Id($job->get('Job')['Id']);
            $mediaAudio->setMp3Url($path_audio_output . $file_name);
            $mediaAudio->setJobMp3State(1);
        }
    }

    /**
     * @param CcmMediaVideoTranslation $mediaVideo
     * @param PreUpdateEventArgs $args
     */
    protected function createAmazonVideoJob(CcmMediaVideoTranslation $mediaVideo, $args)
    {
        $file_name = $mediaVideo->getAmazonRemoteFile()->getName();
        $file_path = explode('/', $mediaVideo->getAmazonRemoteFile()->getUrl());
        $path_video_input = $file_path['0'] . '/';
        $path_video_output = 'media_video_encoded' . '/direct_encoded/';
        //$mediaVideo->getAmazonRemoteFile()->getId();
        $s3 = S3Client::factory(array('key' => $this->getParameter('s3_access_key'), 'secret' => $this->getParameter('s3_secret_key')));
        $nameMp4 = $path_video_output . str_replace('.mov', '.mp4', $file_name);
        $nameWebm = $path_video_output . str_replace(array('.mp4', '.mov'), '.webm', $file_name);

        $em = $args->getEntityManager();
        $medias_1 = $em->getRepository('FDCCourtMetrageBundle:CcmMediaVideoTranslation')->findOneBy(array('mp4Url' => $nameMp4));
        $medias_2 = $em->getRepository('FDCCourtMetrageBundle:CcmMediaVideoTranslation')->findOneBy(array('webmUrl' => $nameWebm));
        if ($medias_1 || $medias_2) {
            if ($medias_1) {
                $mediaVideo->setImageAmazonUrl($path_video_output . '00002/' . str_replace(array('.mov', '.mp4'), '.png', $file_name));
                $mediaVideo->setMp4Url($nameMp4);
                $mediaVideo->setJobMp4Id($medias_1->getJobMp4Id());
                $mediaVideo->setJobMp4State($medias_1->getJobMp4State());
            } else {
                $mediaVideo->setJobMp4State(2);
            }

            if ($medias_2) {
                $mediaVideo->setWebmURL($nameWebm);
                $mediaVideo->setJobWebmId($medias_2->getJobWebmId());
                $mediaVideo->setJobWebmState($medias_2->getJobWebmState());
            } else {
                $mediaVideo->setJobWebmState(2);
            }
        } else {
            $elasticTranscoder = ElasticTranscoderClient::factory(array(
                'credentials' => array(
                    'key'    => $this->getParameter('s3_access_key'),
                    'secret' => $this->getParameter('s3_secret_key'),
                ),
                'region'      => $this->getParameter('s3_video_region'),
            ));

            $job = $elasticTranscoder->createJob(array(
                'PipelineId'      => $this->getParameter('s3_elastic_mp4_pipeline_id'),
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
                        'Key'              => str_replace('.mov', '.mp4', $file_name),
                        'Rotate'           => 'auto',
                        'ThumbnailPattern' => '{count}/' . str_replace(array('.mov', '.mp4'), '', $file_name),
                        'PresetId'         => $this->getParameter('s3_elastic_mp4_preset_id'),
                    ),
                ),
            ));

            $mediaVideo->setImageAmazonUrl($path_video_output . '00002/' . str_replace(array('.mov', '.mp4'), '.png', $file_name));
            $mediaVideo->setJobMp4Id($job->get('Job')['Id']);
            $mediaVideo->setMp4Url($path_video_output . str_replace('.mov', '.mp4', $file_name));
            $mediaVideo->setJobMp4State(1);

            $job = $elasticTranscoder->createJob(array(
                'PipelineId'      => $this->getParameter('s3_elastic_webm_pipeline_id'),
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
                        'PresetId' => $this->getParameter('s3_elastic_webm_preset_id'),
                    ),
                ),
            ));

            $mediaVideo->setJobWebmId($job->get('Job')['Id']);
            $mediaVideo->setWebmURL($path_video_output . str_replace(array('.mp4', '.mov'), '.webm', $file_name));
            $mediaVideo->setJobWebmState(1);
        }

    }

    /**
     * @param $name
     * @return mixed
     */
    protected function getParameter($name)
    {
        return $this->container->getParameter($name);
    }

    protected function generateThumbnails(MediaInterface $media)
    {
        $provider = $this->container->get($media->getProviderName());
        if ($media->getCcmParentVideoTranslation()) {
            $parentVideo = $media->getCcmParentVideoTranslation();
        } elseif ($media->getCcmParentAudioTranslation()) {
            $parentAudio = $media->getCcmParentAudioTranslation();
        } else {
            throw new NotFoundHttpException('Media parent not found.');
        }

        $elasticTranscoder = ElasticTranscoderClient::factory(array(
            'credentials' => array(
                'key'    => $this->getParameter('s3_access_key'),
                'secret' => $this->getParameter('s3_secret_key'),
            ),
            'region'      => $this->getParameter('s3_video_region'),
        ));

        if (isset($parentVideo)) {

            $file_name = $media->getProviderReference();
            $path = $provider->generatePublicUrl($media, 'reference');

            $file_path = explode('/', $path);
            $path_video_input = $file_path['3'] . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';
            $path_video_output = 'media_video_encoded' . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';

            $job = $elasticTranscoder->createJob(array(
                'PipelineId'      => $this->getParameter('s3_elastic_mp4_pipeline_id'),
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
                        'Key'              => str_replace('.mov', '.mp4', $file_name),
                        'Rotate'           => 'auto',
                        'ThumbnailPattern' => '{count}/' . str_replace(array('.mov', '.mp4'), '', $file_name),
                        'PresetId'         => $this->getParameter('s3_elastic_mp4_preset_id'),
                    ),
                ),
            ));

            $parentVideo->setImageAmazonUrl($path_video_output . '00002/' . str_replace(array('.mov', '.mp4'), '.png', $file_name));
            $parentVideo->setJobMp4Id($job->get('Job')['Id']);
            $parentVideo->setMp4Url($path_video_output . str_replace('.mov', '.mp4', $file_name));
            $parentVideo->setJobMp4State(1);

            $job = $elasticTranscoder->createJob(array(
                'PipelineId'      => $this->getParameter('s3_elastic_webm_pipeline_id'),
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
                        'PresetId' => $this->getParameter('s3_elastic_webm_preset_id'),
                    ),
                ),
            ));

            $parentVideo->setJobWebmId($job->get('Job')['Id']);
            $parentVideo->setWebmURL($path_video_output . str_replace(array('.mp4', '.mov'), '.webm', $file_name));
            $parentVideo->setJobWebmState(1);

        } elseif (isset($parentAudio)) {
            $file_name = $media->getProviderReference();
            $path = $provider->generatePublicUrl($media, $media->getProviderReference());
            $file_path = explode('/', $path);
            $path_audio_input = $file_path['3'] . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';
            $path_audio_output = 'media_audio_encoded' . '/' . $file_path['4'] . '/' . $file_path['5'] . '/';

            $job = $elasticTranscoder->createJob(array(
                'PipelineId'      => $this->getParameter('s3_elastic_mp3_pipeline_id'),
                'OutputKeyPrefix' => $path_audio_output,
                'Input'           => array(
                    'Key' => $path_audio_input . $file_name,
                ),
                'Outputs'         => array(
                    array(
                        'Key'      => $file_name,
                        'PresetId' => $this->getParameter('s3_elastic_mp3_preset_id'),
                    ),
                ),
            ));
            $parentAudio->setJobMp3Id($job->get('Job')['Id']);
            $parentAudio->setMp3Url($path_audio_output . $file_name);
            $parentAudio->setJobMp3State(1);
        }

    }
}
