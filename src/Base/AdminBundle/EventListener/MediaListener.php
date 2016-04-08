<?php

namespace Base\AdminBundle\EventListener;

use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\NewsAudio;
use Base\CoreBundle\Entity\NewsFilmProjectionAssociated;
use Base\CoreBundle\Entity\NewsVideo;
use Base\CoreBundle\Entity\NewsVideoTranslation;
use Base\CoreBundle\Entity\NewsAudioTranslation;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Aws\ElasticTranscoder\ElasticTranscoderClient;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MediaListener
 * @package Base\CoreBundle\Listener
 */
class MediaListener
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

        $this->createHomepageNews($entity, $args, false);

        if ($entity instanceof MediaVideoTranslation && $entity->getAmazonRemoteFile()) {
            $this->createAmazonVideoJob($entity, $args);
        }

        if (($entity instanceof MediaVideoTranslation || $entity instanceof MediaAudioTranslation) && $entity->getFile()) {
            $this->generateThumbnails($entity->getFile());
        }
    }

    /**
     * @param $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->createHomepageNews($entity, $args);

        if ($entity instanceof MediaVideoTranslation && $entity->getAmazonRemoteFile() && $args->hasChangedField('amazonRemoteFile')) {
            $this->createAmazonVideoJob($entity, $args);
        }

        $firstCondition = $entity instanceof MediaVideoTranslation || $entity instanceof MediaAudioTranslation;
        if ($firstCondition && $entity->getFile() && $args->hasChangedField('file')) {
            $this->generateThumbnails($entity->getFile());
        }
    }

    private function createHomepageNews($entity, $args, $update = true)
    {
        $createNews = false;
        $deleteNews = false;
        $em = $args->getEntityManager();

        if ($entity instanceof MediaVideoTranslation || $entity instanceof MediaAudioTranslation) {
            $entity = $entity->getTranslatable();
        }

        if ($entity instanceof MediaVideo || $entity instanceof MediaAudio) {

            if ($entity instanceof MediaVideo && $entity->getDisplayedHome() == true) {
                if ($entity->getHomepageNews() == null) {
                    $createNews = new NewsVideo();
                } else {
                    $createNews = $entity->getHomepageNews();
                }
                $createNewsTranslation = new NewsVideoTranslation();
            } else if ($entity instanceof MediaAudio && $entity->getDisplayedHome() == true) {
                if ($entity->getHomepageNews() == null) {
                    $createNews = new NewsAudio();
                } else {
                    $createNews = $entity->getHomepageNews();
                }
                $createNewsTranslation = new NewsAudioTranslation();
            }

            // create related news
            if ($createNews !== false) {

                $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
                if ($settings !== null) {
                    $createNews->setFestival($settings->getFestival());
                }

                if (count($entity->getSites()) > 0) {
                    $hasEvenementiel = false;
                    if (count($createNews->getSites()) > 0) {

                        foreach ($createNews->getSites() as $site) {
                            if ($site->getSlug() == 'site-evenementiel') {
                                $hasEvenementiel = true;
                            }
                        }
                    }
                    foreach ($entity->getSites() as $site) {
                        if ($hasEvenementiel === false && $site->getSlug() == 'site-evenementiel') {
                            $createNews->addSite($site);
                        }
                    }
                }

                $createNews->setDisplayedHome(true);
                $createNews->setDisplayedMobile(true);
                $createNews->setTheme($entity->getTheme());
                $createNews->setHidden(true);
                $createNews->setHeader($entity->getImage());
                $createNews->setAssociatedEvent($entity->getAssociatedEvent());
                $createNews->setAssociatedFilm($entity->getAssociatedFilm());

                if (count($createNews->getAssociatedProjections()) > 0) {
                    foreach ($createNews->getAssociatedProjections() as $proj) {
                        $createNews->removeAssociatedProjection($proj);
                    }
                }

                if (count($entity->getAssociatedProjections()) > 0) {
                    foreach ($entity->getAssociatedProjections() as $proj) {
                        $tmp = new NewsFilmProjectionAssociated();
                        $tmp->setAssociation($proj->getAssociation());

                        $createNews->addAssociatedProjection($tmp);
                    }
                }

                if ($createNews instanceof NewsVideo) {
                    $createNews->setVideo($entity);
                    $createNews->setHomepageMediaVideo($entity);
                } else if ($createNews instanceof NewsAudio) {
                    $createNews->setAudio($entity);
                    $createNews->setHomepageMediaAudio($entity);
                }
                $createNews->setPublishedAt($entity->getPublishedAt());
                $createNews->setPublishEndedAt($entity->getPublishEndedAt());
                if (count($entity->getTranslations()) > 0) {
                    foreach ($entity->getTranslations() as $trans) {
                        $tmp = $createNews->findTranslationByLocale($trans->getLocale());
                        if ($createNews->findTranslationByLocale($trans->getLocale()) == null) {
                            $tmp = clone $createNewsTranslation;
                        }
                        $tmp->setLocale($trans->getLocale());
                        $tmp->setTitle($trans->getTitle());
                        $tmp->setStatus($trans->getStatus());
                        if ($tmp->getId() == null) {
                            $createNews->addTranslation($tmp);
                        }
                    }
                }

                $entity->setHomepageNews($createNews);
                $this->flush = true;
            }
        }

        if ($entity instanceof MediaVideo || $entity instanceof MediaAudio) {
            $uow = $em->getUnitOfWork();
            $array = $uow->getEntityChangeSet($entity);
            if (isset($array['displayedHome']) && $array['displayedHome'][0] == true && $array['displayedHome'][1] == false) {
                $deleteNews = true;
            }

            // delete related news
            if ($deleteNews !== false && $entity->getHomepageNews() !== null) {
                $createdNews = $em->getRepository('BaseCoreBundle:News')->findOneById($entity->getHomepageNews()->getId());
                if ($createdNews !== null) {
                    foreach ($createdNews->getTranslations() as $trans) {
                        $trans->setStatus(MediaVideoTranslation::STATUS_DEACTIVATED);
                    }

                    $this->flush = true;
                }
            }
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


    protected function createAmazonVideoJob(MediaVideoTranslation $mediaVideo, $args)
    {
        /**
         * @todo create amazon video job here
         */
		$file_name = $mediaVideo->getAmazonRemoteFile()->getName();
        $file_path = explode('/', $mediaVideo->getAmazonRemoteFile()->getUrl());
        $path_video_input = $file_path['0'] . '/';
        $path_video_output = 'media_video_encoded' . '/direct_encoded/';
        //$mediaVideo->getAmazonRemoteFile()->getId();
        $s3 = S3Client::factory(array('key'    => $this->getParameter('s3_access_key'),'secret' => $this->getParameter('s3_secret_key')));
		$nameMp4 = $path_video_output . str_replace('.mov', '.mp4', $file_name);
		$nameWebm = $path_video_output . str_replace(array('.mp4', '.mov'), '.webm', $file_name);
		
		$em = $args->getEntityManager();
		$medias_1 = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findOneBy(array('mp4Url' => $nameMp4));
		$medias_2 = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findOneBy(array('webmUrl' => $nameWebm));
		if ($medias_1 || $medias_2)
		{
			if ($medias_1)
			{
				$mediaVideo->setMp4Url($nameMp4);
				$mediaVideo->setJobMp4Id($medias_1->getJobMp4Id());
        		$mediaVideo->setJobMp4State($medias_1->getJobMp4State());
			}
			else
			{
        		$mediaVideo->setJobMp4State(2);
			}
			
			if ($medias_2)
			{
				$mediaVideo->setWebmURL($nameWebm);
				$mediaVideo->setJobWebmId($medias_2->getJobWebmId());
	        	$mediaVideo->setJobWebmState($medias_2->getJobWebmState());
			}
			else
			{
	        	$mediaVideo->setJobWebmState(2);
			}
		}
		else
		{
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
	                    'Key'      => str_replace('.mov', '.mp4', $file_name),
	                    'Rotate'   => 'auto',
						'ThumbnailPattern' => str_replace(array('.mov', '.mp4'), '.png'), $file_name),
	                    'PresetId' => $this->getParameter('s3_elastic_mp4_preset_id'),
	                ),
	            ),
	        ));

			/* @TODO
			récupérer l'URL du fichier généré par amazon
			*/

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
		
			/* @TODO
			 récupérer l'URL du fichier généré par amazon
			*/
			//$parentVideo->setImageAmazonUrl($job->get('Job')['img_url']);

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
        if ($media->getParentVideoTranslation()) {
            $parentVideo = $media->getParentVideoTranslation();
        } elseif ($media->getParentAudioTranslation()) {
            $parentAudio = $media->getParentAudioTranslation();
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
                        'Key'      => str_replace('.mov', '.mp4', $file_name),
                        'Rotate'   => 'auto',
						'ThumbnailPattern' => str_replace(array('.mov', '.mp4'), '.png'), $file_name),
                        'PresetId' => $this->getParameter('s3_elastic_mp4_preset_id'),
                    ),
                ),
            ));

            /* @TODO
            récupérer l'URL du fichier généré par amazon
             */

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

            /* @TODO
            récupérer l'URL du fichier généré par amazon
             */
            //$parentVideo->setImageAmazonUrl($job->get('Job')['img_url']);

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
                    'Key'         => $path_audio_input . $file_name,
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
