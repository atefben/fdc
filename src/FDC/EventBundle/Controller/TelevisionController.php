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
     * @Route("/live")
     * @Template("FDCEventBundle:Television:live.html.twig")
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
            )
        );

        $videos = array(
            array(
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'img' => array(
                    'path' => 'img.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
        );
        return array(
            'channels' => $channels,
            'trailers' => $channels,
            'videos' => $videos,
        );
    }

    /**
     * @Route("/channel/{id}")
     * @Template("FDCEventBundle:Television:channel.html.twig")
     */
    public function getChannelAction($id)
    {
        $channel = array(
            'most_viewed' => true,
            'image' => array(
                'path' => 'img.jpg',
                'src'       => 'http://dummyimage.com/640x404/000/fff.png',
                'srcset'    => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
            ),
            'nbVideos' => 5,
            'theme' => 'les plus vues',
            'createdAt' => new \DateTime(),
            'title' => 'Conférence de presse',
            'description' => 'Interview des réalisateurs des Courts Métrages en Compétition',
            'filter' => array(
                'date' => 'date1',
                'theme' => 'theme1',
            )
        );

        $videos = array(
            array(
                'img' => array(
                    'path' => 'http://dummyimage.com/463x291/000/fff'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'img' => array(
                    'path' => 'http://dummyimage.com/463x291/000/fff'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
        );
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
            )
        );

        return array(
            'channel' => $channel,
            'channels' => $channels,
            'videos' => $videos,
        );
    }

    /**
     * @Route("/channels")
     * @Template("FDCEventBundle:Television:channels.html.twig")
     */
    public function channelsAction()
    {
        $channels = array(
            array(
                'id' => 1,
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            )
        );

        return array(
            'channels' => $channels,
        );
    }

    /**
     * @Route("/trailers/{slug}")
     * @Template("FDCEventBundle:Television:trailers.html.twig")
     */
    public function trailersAction($slug)
    {

        $trailers = array(
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/e67e22/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/e67e22/fff.png',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            )
        );

        return array(
            'trailers' => $trailers,
        );
    }

    /**
     * @Route("/trailer/{id}")
     * @Template("FDCEventBundle:Television:trailer.html.twig")
     */
    public function getTrailerAction($id)
    {
        $trailer = array(
            'id' => 1,
            'author' => 'Olivier ASSAYAS',
            'most_viewed' => true,
            'image' => array(
                'path' => 'img.jpg',
                'src'       => 'http://dummyimage.com/640x404/000/fff.png',
                'srcset'    => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
            ),
            'nbVideos' => 5,
            'theme' => 'les plus vues',
            'createdAt' => new \DateTime(),
            'title' => 'Lorem ipsum',
            'filter' => array(
                'date' => 'date1',
                'theme' => 'theme1',
            ),
        );

        $trailers = array(
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset'    => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset'    => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset'    => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            ),
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => 'img.jpg',
                    'src'       => 'http://dummyimage.com/640x404/000/fff.png',
                    'srcset'    => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum',
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                ),
            )
        );

        return array(
            'trailer' => $trailer,
            'trailers' => $trailers,
        );
    }
}
