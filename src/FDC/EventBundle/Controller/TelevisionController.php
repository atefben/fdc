<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/web-tv")
 */
class TelevisionController extends Controller
{
    /**
     * @Route("/direct")
     * @Template("FDCEventBundle:Television:television.live.html.twig")
     */
    public function liveAction()
    {
        $channels = array(
            array(
                'most_viewed' => true,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => true,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            )
        );


        return array(
            'channels' => $channels,
            'trailers' => $channels,
            'videos' => $channels,
        );
    }

    /**
     * @Route("/channels")
     * @Template("FDCEventBundle:Television:television.live.html.twig")
     */
    public function channelsAction()
    {
        $webTv = "";
        $channels = "";

        return array(
            'webtv' => $webTv,
            'channels' => $channels,
        );
    }

    /**
     * @Route("/trailers")
     * @Template("FDCEventBundle:Television:television.live.html.twig")
     */
    public function trailersAction()
    {
        $webTv = "";
        $channels = "";

        return array(
            'webtv' => $webTv,
            'channels' => $channels,
        );
    }
}
