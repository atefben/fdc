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
        $jobId = 1;

        $media = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findOneByJob($jobId);
        if ($media === null) {
            $logger->error('Job id #'. $jobId. ' not found');
            throw new NotFoundHttpException();
        }
        $media->setImageAmazonUrl('http://');
        $media->setState(0);

        $em->flush();

        return new JsonResponse();

    }
}