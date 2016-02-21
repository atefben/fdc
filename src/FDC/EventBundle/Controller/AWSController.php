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
        $logger = $this->get('logger');
		
        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobMp4State' => '1'));
		//print_r(\Doctrine\Common\Util\Debug::export($medias, 6));
		foreach($medias as $media) {
			echo $media->getJobId();
			$this->updateAmazonStatus($media->getJobId(), $media->getJobMp4Id(), 'mp4');
		}
		
        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobWebmState' => '1'));
		foreach($medias as $media) {
			//$this->updateAmazonStatus($media->getJobId(), $media->getJobWebmId(), 'webm');
		}
		
		$medias = $em->getRepository('BaseCoreBundle:MediaAudioTranslation')->findBy(array('jobWebmState' => '1'));
		foreach($medias as $media) {
			//$this->updateAmazonStatus($media->getJobId(), $media->getJobMp3Id(), 'mp3');
		}

        $em->flush();

        return new JsonResponse();

    }
	
    public function updateAmazonStatus($media, $jobid, $mime)
    {
        $elasticTranscoder = ElasticTranscoderClient::factory(array(
            'credentials' => array(
                'key'    => 'AKIAJHXD67GEPPA2F4TQ',
                'secret' => '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',
            ),
            'region'      => 'eu-west-1',
        ));
		
		$elasticTranscoder->readJob(array('Id' => $jobid));
		$jobData = $response->get('Job');
		print_r($jobData['Status']);
		
		switch($jobData['Status']){
			case 'completed': break;
			case 'error': break;
		}

		// TODO JEAN LUC
        // $media->setImageAmazonUrl('http://');
        // $media->setState(0);
	}
	
}