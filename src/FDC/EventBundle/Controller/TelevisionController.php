<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => true,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            )
        );

        $videos = array(
            array(
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
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
     * @param Request $request
     * @param $slug
     * @return array
     * @throws NotFoundHttpException
     *
     * @Route("/channel/{slug}")
     * @Template("FDCEventBundle:Television:channel.html.twig")
     */
    public function getChannelAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $festival = $settings->getFestival();
        $locale = $request->getLocale();

        $webTv = $em->getRepository('BaseCoreBundle:WebTv')->getWebTvBySlug($slug, $locale, $festival);


        if (!$webTv || !$webTv->getMediaVideos()->count()) {
            throw $this->createNotFoundException('Web TV not found');
        }

        $channel = array(
            'slug' => $webTv->getSlug(),
            'most_viewed' => true,
            'image' => array(
                'path' => 'img.jpg',
                'src'       => 'http://dummyimage.com/640x404/000/fff.png',
                'srcset'    => 'http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x',
            ),
            'nbVideos' => 5,
            'theme' => 'les plus vues',
            'createdAt' => $webTv->getCreateAt(),
            'title' => $webTv->getName(),
            'description' => 'Interview des réalisateurs des Courts Métrages en Compétition',
            'filter' => array(
                'date' => 'date1',
                'theme' => 'theme1',
            )
        );

        $videos = array(
            array(
                'image' => array(
                    'path' => 'http://dummyimage.com/463x291/000/fff'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'image' => array(
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
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => true,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
                ),
                'nbVideos' => 5,
                'theme' => 'les plus vues',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum'
            ),
            array(
                'most_viewed' => false,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg'
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
            'author' => array(
                'fullName' => 'Olivier ASSAYAS',
            ),
            'most_viewed' => true,
            'image' => array(
                'path' => 'img.jpg',
                'src'       => 'http://dummyimage.com/640x404/000/fff.png',
            ),
            'nbVideos' => 5,
            'theme' => 'les plus vues',
            'createdAt' => new \DateTime(),
            'filter' => array(
                'date' => 'date1',
                'theme' => 'theme1',
            ),
            'film' => array(
                'type' => 'Bande annonce',
                'title' => 'Lorem Ipsum'
            ),
        );
        $channels = array(
            array(
                'id' => 1,
                'author' => 'Olivier ASSAYAS',
                'most_viewed' => true,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
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
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
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
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
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
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
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
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
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
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
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
        );

        $filmShowings = array(
            array(
                'date' => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            ),
            array(
                'date' => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            ),
            array(
                'date' => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            ),
            array(
                'date' => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            ),
            array(
                'date' => new \DateTime(),
                'place' => "Grand théâtre Lumière",
            )
        );

        return array(
            'trailer' => $trailer,
            'channels' => $channels,
            'filmShowings' => $filmShowings
        );
    }
}
