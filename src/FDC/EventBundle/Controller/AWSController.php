<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobMp4state' => 1));
		foreach($medias as $media) {
			error_log(print_r($media, true));
			$this->updateAmazonStatus($media, 'mp4');
		}
		
        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobWebmState' => 1));
		foreach($medias as $media) {
			error_log(print_r($media, true));
			$this->updateAmazonStatus($media, 'webm');
		}
		
		// TODO JEAN LUC
		/*
        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobMp3mState' => 1));
		foreach($medias as $media) {
			
			$this->updateAmazonStatus($media, 'mp3');
		}*/

        $em->flush();

        return new JsonResponse();

    }
	
    public function updateAmazonStatus($media, $mime)
    {
		// TODO JEAN LUC
        $media->setImageAmazonUrl('http://');
        $media->setState(0);
	}
	
}