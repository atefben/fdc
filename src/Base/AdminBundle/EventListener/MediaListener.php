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

    public function __construct()
    {
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
            $this->createAmazonVideoJob($entity);
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
            $this->createAmazonVideoJob($entity);
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


    protected function createAmazonVideoJob(MediaVideoTranslation $mediaVideo)
    {
        /**
         * @todo create amazon video job here
         */
		$file_name = $mediaVideo->getAmazonRemoteFile()->getName();
        $file_path = explode('/', $mediaVideo->getAmazonRemoteFile()->getUrl());
        $path_video_input = $file_path['0'] . '/';
        $path_video_output = 'media_video_encoded' . '/direct_encoded/';
        //$mediaVideo->getAmazonRemoteFile()->getId();
        $s3 = S3Client::factory(array('key'    => 'AKIAJHXD67GEPPA2F4TQ','secret' => '8TtlhHgQEIPwQBQiDqCzG7h5Eq856H2jst1PtER6'));
		$info = $s3->doesObjectExist('ohwee-symfony-test-video', $path_video_output .  str_replace('.mov', '.mp4', $file_name));
		if ($info)
		{
			$mediaVideo->setMp4Url($path_video_output . str_replace('.mov', '.mp4', $file_name));
	        $mediaVideo->setJobMp4State(3);
			
			$mediaVideo->setWebmURL($path_video_output . str_replace(array('.mp4', '.mov'), '.webm', $file_name));
	        $mediaVideo->setJobWebmState(3);
		}
		else
		{
	        $elasticTranscoder = ElasticTranscoderClient::factory(array(
	            'credentials' => array(
	                'key'    => 'AKIAJHXD67GEPPA2F4TQ',
	                'secret' => '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',
	            ),
	            'region'      => 'eu-west-1',
	        ));
		
			

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

	        $mediaVideo->setJobMp4Id($job->get('Job')['Id']);
			$mediaVideo->setMp4Url($path_video_output . str_replace('.mov', '.mp4', $file_name));
	        $mediaVideo->setJobMp4State(1);


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

	        $mediaVideo->setJobWebmId($job->get('Job')['Id']);
			$mediaVideo->setWebmURL($path_video_output . str_replace(array('.mp4', '.mov'), '.webm', $file_name));
	        $mediaVideo->setJobWebmState(1);
		}

    }


}
