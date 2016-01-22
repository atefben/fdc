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

        //get associated film to the news
        $associatedFilm = $news->getAssociatedFilm();
        $associatedFilmDuration = date('H:i', mktime(0,$associatedFilm->getDuration()));

        //get film projection
        $programmations = array();
        foreach($associatedFilm->getProjectionProgrammationFilms() as $projection) {
            $programmations[] = $projection->getProjection();
        }

        //get focus articles
        $associatedNews = $news->getAssociatedNews();
        $focusArticles = array();
        foreach($associatedNews as $associatedNew) {
            $focusArticles[] = $associatedNew->getAssociation();
        }

        //get day articles
        $count = 3;
        $newsDate = $news->getPublishedAt();
        $sameDayArticles = $em->getRepository('BaseCoreBundle:News')
            ->getSameDayNews(
                $settings->getFestival()->getId(),
                $locale,
                $newsDate,
                $count,
                $news->getId()
            );

        return array(
            'focusArticles' => $focusArticles,
            'programmations' => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news' => $news,
            'associatedFilm' => $associatedFilm,
            'sameDayArticles' => $sameDayArticles,
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

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0] = 'all';

        foreach($newsArticles as $key => $newsArticle) {
            $newsArticle->image = $newsArticle->getHeader();
            $newsArticle->theme = $newsArticle->getTheme();

            //check if filters don't already exist
            if(!in_array($newsArticle->getPublishedAt(),$filters['dates'])) {
                $date = $newsArticle->getPublishedAt();
                $filters['dates'][] = ($date != null) ? $date : null;
            }

            if(!in_array($newsArticle->getTheme()->getName(),$filters['themes']['content'])) {
                $filters['themes']['slug'][] = $newsArticle->getTheme()->getName();
                $filters['themes']['content'][] = $newsArticle->getTheme();
            }

        }

        return array(
            'articles' => $newsArticles,
            'filters' => $filters,
        );
    }

    /**
     * @Route("/photos")
     * @Template("FDCEventBundle:News/list:photo.html.twig")
     */
    public function getPhotosAction()
    {
        $dateTime = new DateTime();

        $em   = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null && $settings->getFestival() !== null) {
            throw new NotFoundHttpException();
        }

        //GET ALL PHOTOS ARTICLES
        $newsPhotos = $em->getRepository('BaseCoreBundle:News')->getNewsPhotos($locale,$settings->getFestival()->getId(),$dateTime);

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0] = 'all';

        foreach($newsPhotos as $key => $newsPhoto) {
            $newsPhoto->image = $newsPhoto->getHeader();
            $newsPhoto->theme = $newsPhoto->getTheme();

            //check if filters don't already exist
            if(!in_array($newsPhoto->getPublishedAt(),$filters['dates'])) {
                $date = $newsPhoto->getPublishedAt();
                $filters['dates'][] = ($date != null) ? $date->format('Y-m-d H:i:s') : null;
            }

            if(!in_array($newsPhoto->getTheme()->getName(),$filters['themes']['content'])) {
                $filters['themes']['slug'][] = $newsPhoto->getTheme()->getName();
                $filters['themes']['content'][] = $newsPhoto->getTheme();
            }

        }

        return array(
            'photos' => $newsPhotos,
            'filters' => $filters,
        );
    }

    /**
     * @Route("/videos")
     * @Template("FDCEventBundle:News/list:video.html.twig")
     */
    public function getVideosAction()
    {
        $dateTime = new DateTime();

        $em   = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null && $settings->getFestival() !== null) {
            throw new NotFoundHttpException();
        }

        //GET ALL VIDEOS ARTICLES
        $newsVideos = $em->getRepository('BaseCoreBundle:News')->getNewsVideos($locale,$settings->getFestival()->getId(),$dateTime);

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0] = 'all';

        foreach($newsVideos as $key => $newsVideo) {
            $newsVideo->image = $newsVideo->getHeader();
            $newsVideo->theme = $newsVideo->getTheme();

            //check if filters don't already exist
            if(!in_array($newsVideo->getPublishedAt(),$filters['dates'])) {
                $date = $newsVideo->getPublishedAt();
                $filters['dates'][] = ($date != null) ? $date->format('Y-m-d H:i:s') : null;
            }

            if(!in_array($newsVideo->getTheme()->getName(),$filters['themes']['content'])) {
                $filters['themes']['slug'][] = $newsVideo->getTheme()->getName();
                $filters['themes']['content'][] = $newsVideo->getTheme();
            }

        }

        return array(
            'videos' => $newsVideos,
            'filters' => $filters,
        );

    }

    /**
     * @Route("/audios")
     * @Template("FDCEventBundle:News/list:audio.html.twig")
     */
    public function getAudiosAction()
    {
        $dateTime = new DateTime();

        $em   = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null && $settings->getFestival() !== null) {
            throw new NotFoundHttpException();
        }

        //GET ALL AUDIOS ARTICLES
        $newsAudios = $em->getRepository('BaseCoreBundle:News')->getNewsAudios($locale,$settings->getFestival()->getId(),$dateTime);

        //set default filters
        $filters = array();
        $filters['dates'][0] = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0] = 'all';

        foreach($newsAudios as $key => $newsAudio) {
            $newsAudio->image = $newsAudio->getHeader();
            $newsAudio->theme = $newsAudio->getTheme();

            //check if filters don't already exist
            if(!in_array($newsAudio->getPublishedAt(),$filters['dates'])) {
                $date = $newsAudio->getPublishedAt();
                $filters['dates'][] = ($date != null) ? $date->format('Y-m-d H:i:s') : null;
            }

            if(!in_array($newsAudio->getTheme()->getName(),$filters['themes']['content'])) {
                $filters['themes']['slug'][] = $newsAudio->getTheme()->getName();
                $filters['themes']['content'][] = $newsAudio->getTheme();
            }

        }

        return array(
            'audios' => $newsAudios,
            'filters' => $filters,
        );
    }

}
