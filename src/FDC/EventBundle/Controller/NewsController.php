<?php

namespace FDC\EventBundle\Controller;

use \DateTime;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("")
 * Class NewsController
 * @package FDC\EventBundle\Controller
 */
class NewsController extends Controller
{

    /**
     * @Route("/")
     * @Template("FDCEventBundle:News:home.html.twig")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getManager();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null && $settings->getFestival() !== null) {
            throw new NotFoundHttpException();
        }

        // SocialGraph
        $timeline = $em->getRepository('BaseCoreBundle:SocialGraph')->findBy(array('festival' => $settings->getFestival()), array('date' => 'ASC'), 12, null);

        $socialGraphTimeline      = array();
        $socialGraphTimelineCount = array();
        $socialGraph = array();

        foreach ($timeline as $key => $timelineDate) {
            $socialGraphTimeline[]['date']  = $timelineDate->getDate();
            $socialGraphTimelineCount[]     = $timelineDate->getCount();
        }

        $socialGraph['timeline'] = $socialGraphTimeline;
        $socialGraph['timelineCount'] = json_encode($socialGraphTimelineCount);

        // Homepage
        $homepage = $em->getRepository('BaseCoreBundle:Homepage')->findOneBy(array('festival' => $settings->getFestival()));
        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

        //filters init
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0] = 'all';

        // TODO: clean this
        $homeSlider = array(
            array(
                'id'=> 0,
                'image'=>array(
                    'path' => '/bundles/fdcevent/img/slider/slider01.jpg',
                ),
                'theme'=>'Rencontre',
                'title'=>'Xavier DOLAN : « Tant qu’il y a encore un peu de spontanéité, il y a de l’art »',
            ),
            array(
                'id'=> 0,
                'image'=>array(
                    'path' => '/bundles/fdcevent/img/slider/slider01.jpg',
                ),
                'theme'=>'Rencontre',
                'title'=>'Xavier DOLAN : « Tant qu’il y a encore un peu de spontanéité, il y a de l’art »',
            ),
            array(
                'id'=> 0,
                'image'=>array(
                    'path' => '/bundles/fdcevent/img/slider/slider01.jpg',
                ),
                'theme'=>'Rencontre',
                'title'=>'Xavier DOLAN : « Tant qu’il y a encore un peu de spontanéité, il y a de l’art »',
            ),
        );

        $home = array(
            'article' => array(
                array(
                    'title' => 'Stéphane Beizé interroge la loi du marché',
                    'createdAt' => new \DateTime(),
                    'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                    ),
                    'format' => 'article',
                    'theme' => 'competition',
                    'category' => 'competition',
                    'double' => true,
                ),
                array(
                    'title' => 'Stéphane Beizé interroge la loi du marché',
                    'createdAt' => new \DateTime(),
                    'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                    ),
                    'format' => 'video',
                    'theme' => 'competition',
                    'category' => 'competition',
                    'double' => false,
                ),
                array(
                    'title' => 'Stéphane Beizé interroge la loi du marché',
                    'createdAt' => new \DateTime(),
                    'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                    ),
                    'format' => 'photo',
                    'theme' => 'competition',
                    'category' => 'competition',
                    'double' => false,
                ),
            ),
            'bottomArticle' => array(
                array(
                    'title' => 'Stéphane Beizé interroge la loi du marché',
                    'createdAt' => new \DateTime(),
                    'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                    ),
                    'format' => 'audio',
                    'theme' => 'competition',
                    'category' => 'competition',
                ),
                array(
                    'title' => 'Stéphane Beizé interroge la loi du marché',
                    'createdAt' => new \DateTime(),
                    'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                    ),
                    'format' => 'article',
                    'theme' => 'competition',
                    'category' => 'competition',
                ),
                array(
                    'title' => 'Stéphane Beizé interroge la loi du marché',
                    'createdAt' => new \DateTime(),
                    'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                    ),
                    'format' => 'article',
                    'theme' => 'competition',
                    'category' => 'competition',
                ),
            ),
            'widgets' => array(
                array(
                    'type' => 'image',
                    'copyright' => "Équipe du film - Photocall - The Lobster",
                    'photos' => array(
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        )
                    )
                ),
                array(
                    'type' => 'video',
                    'videos' => array(
                        array(
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        )
                    )
                )
            ),
        );

        $featuredMovies = array(
            'type' => 'fullVideo',
            'video' => array(
                array(
                    'film' => array(
                        'title' => 'Sils Maria',
                        'theme' => 'Compétition',
                        'author' => array(
                            'fullName' => 'Olivier ASSAYAS',
                            'slug' => 'olivier-assayas'
                        )
                    ),
                    'source' => array(
                        'm4v' => 'https://broken-links.com/tests/media/BigBuck.m4v',
                        'webm' => 'https://broken-links.com/tests/media/BigBuck.webm',
                        'image' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider/slider01.jpg'
                    )
                ),
                array(
                    'film' => array(
                        'title' => 'Sils Maria',
                        'theme' => 'Compétition',
                        'author' => array(
                            'fullName' => 'Olivier ASSAYAS',
                            'slug' => 'olivier-assayas'
                        )
                    ),
                    'source' => array(
                        'm4v' => 'https://broken-links.com/tests/media/BigBuck.m4v',
                        'webm' => 'https://broken-links.com/tests/media/BigBuck.webm',
                        'image' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider/slider01.jpg'
                    )
                )

            )
        );
        $homeCategories = array(
            array(
                'title' => 'Le jury',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push01.jpg'
                ),
            ),
            array(
                'title' => 'Le palmares',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push02.jpg'
                ),
            ),
            array(
                'title' => 'La programmation',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push03.jpg'
                ),
            ),
        );
        $homeCategoriesFeatured = array(
            array(
                'title' => 'Espace presse',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push04.jpg'
                ),
            ),
            array(
                'title' => '',
                'blank' => true,
                'bigger' => true,
                'href' => '',
                'image' => array(
                    'path' => ''
                ),
            ),
            array(
                'title' => 'Participer <br> au festival',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push05.jpg'
                ),
            ),
            array(
                'title' => 'L\'oeil du photographe',
                'blank' => false,
                'bigger' => true,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push06.jpg'
                ),
            ),
            array(
                'title' => 'Lorem ipsum',
                'blank' => true,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
                ),
            ),
            array(
                'title' => 'Lorem ipsum',
                'blank' => true,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
                ),
            ),
            array(
                'title' => 'Les évènements',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push07.jpg'
                ),
            ),
            array(
                'title' => '69 ans d\'archives',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push08.jpg'
                ),
            )
        );
        $videos = array(
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => true,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'nbVideos' => 125,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => true,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'nbVideos' => 125,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => true,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'nbVideos' => 125,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'nbVideos' => 125,
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'nbVideos' => 125,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/02.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'nbVideos' => 125,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/03.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'nbVideos' => 125,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/01.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'nbVideos' => 125,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/02.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'nbVideos' => 125,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-channels/03.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            )
        );
        $videoSlider = array(
            array(
                'title' => 'Lorem Ipsum',
                'source' => array(
                    'mp4' => 'https://broken-links.com/tests/media/BigBuck.m4v',
                    'webm' => 'https://broken-links.com/tests/media/BigBuck.webm',
                ),
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/slider/slider01.jpg'
                ),
                'category' => 'Lorem ipsum',
                'author' => array(
                    'fullName' => 'Lorem Ipsum'
                )
            ),
            array(
                'title' => 'Lorem Ipsum',
                'source' => array(
                    'mp4' => 'https://broken-links.com/tests/media/BigBuck.m4v',
                    'webm' => 'https://broken-links.com/tests/media/BigBuck.webm',
                ),
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/slider/slider01.jpg'
                ),
                'category' => 'Lorem ipsum',
                'author' => array(
                    'fullName' => 'Lorem Ipsum'
                )
            ),
        );
        $wallPosts = array(
            array(
                'big' => true,
            ),
            array(
                'big' => true,
            ),
            array(
                'big' => false,
            ),
            array(
                'big' => false,
            ),
            array(
                'big' => false,
            ),
            array(
                'big' => false,
            ),
            array(
                'big' => false,
            ),
            array(
                'big' => false,
            ),
            array(
                'big' => false,
            ),
            array(
                'big' => false,
            ),
        );

        return array(
            'homepage' => $homepage,
            'socialGraph' => $socialGraph,
            // TODO: clean this
            'homeSlider' => $homeSlider,
            'homeArticles' => $home,
            'filters' => $filters,
            'videos' => $videos,
            'videoSlider' => $videoSlider,
            'featuredMovies' => $featuredMovies,
            'homeCategories' => $homeCategories,
            'homeCategoriesFeatured' => $homeCategoriesFeatured,
            'wallPosts' => $wallPosts
        );
    }

    /**
     * @Route("/articles/{slug}")
     * @Template("FDCEventBundle:News:main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        //$token = $this->get('security.token_storage')->getToken();
        //$isAdmin = ($token) ? true : false;
        $isAdmin = true;
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null && $settings->getFestival() !== null) {
            throw new NotFoundHttpException();
        }

        // GET NEWS
        $news = $em->getRepository('BaseCoreBundle:News')->getNewsBySlug(
            $slug,
            $settings->getFestival()->getId(),
            $locale,
            $dateTime->format('Y-m-d H:i:s'),
            $isAdmin
        );

        if ($news === null) {
            throw new NotFoundHttpException();
        }

        // SEO
       // $this->get('base.manager.seo')->setFDCEventPageNewsSeo($news, $locale);

        $associatedFilm = $news->getAssociatedFilm();
        $associatedFilmDuration = date('H:i', mktime(0,$associatedFilm->getDuration()));

        /*
        foreach($associatedFilm->getMedias() as $media) {
            echo'<pre>'; print_r($media->getMedia()); echo '</pre>';
        }
         exit;
        */

        /*foreach($associatedFilm->getProjectionProgrammationFilmsList() as $projection) {
            echo'<pre>'; print_r($projection->getProjection()); echo '</pre>';
        }
         exit;
        */

        //FAKE CONTENT
        $film = array(
            'title' => $associatedFilm->getTitleVO(),
            'releaseDate' => $associatedFilm->getProductionYear(),
            'duration' => date('H:i', mktime(0,$associatedFilm->getDuration())),
            'competition' => 'Un certain regard',
            'author' => array(
                'fullName' =>'toto',//$associatedFilm->getDuration()->getPersons()->getDirectorsRandomly,
                'from' => 'France'
            ),
            'image' => array(
                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/article/007.jpg'
            ),
            'programmation' => array(
                array(
                    'startAt' => new \DateTime(),
                    'room' => 'Salle Debussy'
                ),
                array(
                    'startAt' => new \DateTime(),
                    'room' => 'Salle Debussy'
                ),
                array(
                    'startAt' => new \DateTime(),
                    'room' => 'Salle Debussy'
                ),
                array(
                    'startAt' => new \DateTime(),
                    'room' => 'Salle Debussy'
                )
            )
        );
        $focusArticles = array(
            array(
                'title' => 'Stéphane Beizé interroge la loi du marché',
                'createdAt' => new \DateTime(),
                'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                ),
                'format' => 'article',
                'theme' => 'competition',
                'category' => 'competition',
            ),
            array(
                'title' => 'Stéphane Beizé interroge la loi du marché',
                'createdAt' => new \DateTime(),
                'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                ),
                'format' => 'article',
                'theme' => 'competition',
                'category' => 'competition',
            ),
        );
        $dayArticles = array(
            array(
                'title' => 'Stéphane Beizé interroge la loi du marché',
                'createdAt' => new \DateTime(),
                'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                ),
                'format' => 'article',
                'theme' => 'competition',
                'category' => 'competition',
            ),
            array(
                'title' => 'Stéphane Beizé interroge la loi du marché',
                'createdAt' => new \DateTime(),
                'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                ),
                'format' => 'article',
                'theme' => 'competition',
                'category' => 'competition',
            ),
            array(
                'title' => 'Stéphane Beizé interroge la loi du marché',
                'createdAt' => new \DateTime(),
                'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                ),
                'format' => 'article',
                'theme' => 'competition',
                'category' => 'competition',
            ),
        );

        return array(
            'associatedFilmDuration' => $associatedFilmDuration,
            'news' => $news,
            'associatedFilm' => $associatedFilm,
            'film' => $film,
            'focusArticles' => $focusArticles,
            'dayArticles' => $dayArticles,
            //  'article' => $article
        );
    }

    /**
     * @Route("/articles")
     *
     * @Template("FDCEventBundle:News/list:article.html.twig")
     */
    public function getArticlesAction()
    {
        //$offset = 30;
        $dateTime = new DateTime();

        $em   = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null && $settings->getFestival() !== null) {
            throw new NotFoundHttpException();
        }

        //GET ALL NEWS ARTICLES
        $newsArticles = $em->getRepository('BaseCoreBundle:News')->getNewsArticles($locale,$settings->getFestival()->getId(),$dateTime);
        if ($newsArticles === null) {
            throw new NotFoundHttpException();
        }

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0] = 'all';

        $translator = $this->get('translator');
        foreach($newsArticles as $key => $newsArticle) {
            $newsArticle->image = $newsArticle->getHeader();
            $newsArticle->theme = $newsArticle->getTheme();

            //check if filters don't already exist
            if(!in_array($newsArticle->getPublishedAt(),$filters['dates'])) {
                $date = $newsArticle->getPublishedAt();
                $filters['dates'][] = ($date != null) ? $date->format('Y-m-d H:i:s') : null;
            }


            if(!in_array($newsArticle->getTheme()->getName(),$filters['themes']['content'])) {
                $filters['themes']['slug'][] = $newsArticle->getTheme()->getName();
                $filters['themes']['content'][] = $newsArticle->getTheme();
            }

        }

        $articles = $newsArticles;

        return array(
            'articles' => $articles,
            'filters' => $filters,
        );
    }

    /**
     * @Route("/photos")
     * @Template("FDCEventBundle:News/list:photo.html.twig")
     */
    public function getPhotosAction()
    {
       /* //$offset = 30;
        $dateTime = new DateTime();

        $em   = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null && $settings->getFestival() !== null) {
            throw new NotFoundHttpException();
        }

        //GET ALL NEWS ARTICLES
        $newsPhotos = $em->getRepository('BaseCoreBundle:News')->getNewsPhotos($locale,$settings->getFestival()->getId(),$dateTime);

        foreach($newsPhotos as $newsPhoto) {
            $newsPhoto->image = $newsPhoto->getHeader();
            $newsPhoto->theme = $newsPhoto->getTheme();
        }

        $photos = $newsPhotos;

       */

        //echo'<pre>'; print_r($photos); echo '</pre>';

        $photos = array(
            array(
                'format'    => 'portrait',
                'theme' => 'Conférence de presse',
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => 'img.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'format'    => 'portrait',
                'theme' => 'Conférence de presse',
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => 'img.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'format'    => 'portrait',
                'theme' => 'Conférence de presse',
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => 'img.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'format'    => 'portrait',
                'theme' => 'Conférence de presse',
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => 'img.jpg',
                    'src'      => 'http://dummyimage.com/640x404/000/fff.png',
                    'large'    => 'http://dummyimage.com/1280x808/ddd/000.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            )
        );

        $filters = array(
            'dates' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Toutes',
                ),
                array(
                    'slug' => 'date',
                    'content' => 'Date 1',
                ),
                array(
                    'slug' => 'date1',
                    'content' => 'Date 2',
                ),
            ),
            'themes' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Tous',
                ),
                array(
                    'slug' => 'theme1',
                    'content' => 'Thème 1',
                ),
                array(
                    'slug' => 'theme2',
                    'content' => 'Thème 2',
                ),
            )
        );

        return array(
            'photos' => $photos,
            'filters' => $filters,
        );
    }

    /**
     * @Route("/videos")
     * @Template("FDCEventBundle:News/list:video.html.twig")
     */
    public function getVideosAction()
    {
        $videos = array(
            array(
                'theme' => 'Conférence de presse',
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'image' => array(
                    'path' => 'img.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
        );

        $filters = array(
            'dates' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Toutes',
                ),
                array(
                    'slug' => 'date',
                    'content' => 'Date 1',
                ),
                array(
                    'slug' => 'date1',
                    'content' => 'Date 2',
                ),
            ),
            'themes' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Tous',
                ),
                array(
                    'slug' => 'theme1',
                    'content' => 'Thème 1',
                ),
                array(
                    'slug' => 'theme2',
                    'content' => 'Thème 2',
                ),
            )
        );

        return array(
            'videos' => $videos,
            'filters' => $filters,
        );

    }

    /**
     * @Route("/audios")
     * @Template("FDCEventBundle:News:list-audio.html.twig")
     */
    public function getAudiosAction()
    {
        $audios = array(
            array(
                'theme' => 'Conférence de presse',
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'sound'=> 'audio.mp3',
                'image' => array(
                    'path' => 'img.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
        );

        $filters = array(
            'dates' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Toutes',
                ),
                array(
                    'slug' => 'date',
                    'content' => 'Date 1',
                ),
                array(
                    'slug' => 'date1',
                    'content' => 'Date 2',
                ),
            ),
            'themes' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Tous',
                ),
                array(
                    'slug' => 'theme1',
                    'content' => 'Thème 1',
                ),
                array(
                    'slug' => 'theme2',
                    'content' => 'Thème 2',
                ),
            )
        );

        return array(
            'audios' => $audios,
            'filters' => $filters,
        );
    }

}
