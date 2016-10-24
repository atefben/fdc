<?php

namespace FDC\CorporateBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/mediatheque")
 * Class MediaController
 * @package FDC\EventBundle\Controller
 */
class MediaController extends Controller
{
    /**
     * @Route("/")
     * @Template("FDCCorporateBundle:Media:index.html.twig")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $page = $em->getRepository('BaseCoreBundle:FDCPageMediatheque')->find(1);
        $locale = $request->getLocale();

        $medias = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, '', true, true, true);

        dump($medias);


        exit;

        if($request->isMethod('POST')) {
            $search = $request->get('search');
            $photo = $request->get('photo') ? true : false;
            $video = $request->get('video') ? true : false;
            $audio = $request->get('audio') ? true : false;
            $yearStart = $request->query->get('year-start');
            $yearEnd = $request->query->get('year-end');

            $medias = $em->getRepository('BaseCoreBundle:Media')->searchMedias($locale, $search, $photo, $video, $audio, $yearStart, $yearEnd, 100);

            $selection = false;
        } else {
            $mediatheque = $em->getRepository('BaseCoreBundle:CorpoMediatheque')->find(1);
            $medias = $mediatheque->getMediasSelection();

            $selection = true;
        }


        return array('page' => $page, 'medias' => $medias, 'selection' => $selection);
    }
}