<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Aws\ElasticTranscoder\ElasticTranscoderClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/ws/aws")
 * Class ArtistController
 * @package FDC\EventBundle\Controller
 */
class AWSController extends Controller
{
    /**
     * @Route("/", options={"i18n": false})
     *
     * @return JsonResponse
     */
    public function callbackAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobMp4State' => '3'));
        foreach ($medias as $media) {
            $this->updateAmazonStatus($media, $media->getJobMp4Id(), 'setJobMp4');
        }

        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobWebmState' => '1'));
        foreach ($medias as $media) {
            $this->updateAmazonStatus($media, $media->getJobWebmId(), 'setJobWebm');
        }

        $medias = $em->getRepository('BaseCoreBundle:MediaAudioTranslation')->findBy(array('jobMp3State' => '1'));
        foreach ($medias as $media) {
            $this->updateAmazonStatus($media, $media->getJobMp3Id(), 'setJobMp3');
        }

        $em->flush();
        return new JsonResponse();

    }

    public function updateAmazonStatus(&$media, $jobid, $method)
    {
        $elasticTranscoder = ElasticTranscoderClient::factory(array(
            'credentials' => array(
                'key'    => $this->getParameter('s3_access_key'),
                'secret' => $this->getParameter('s3_secret_key'),
            ),
            'region'      => $this->getParameter('s3_video_region'),
        ));
        $response = $elasticTranscoder->readJob(array('Id' => $jobid));
        $jobData = $response->get('Job');

        $statuses = array(
            'Complete'    => 3,
            'Error'       => 2,
            'Progressing' => 1,
        );

        $media->{$method . 'State'}($statuses[$jobData['Status']]);

        $this
            ->getDoctrine()
            ->getManager()
            ->persist($media)
        ;
    }


}