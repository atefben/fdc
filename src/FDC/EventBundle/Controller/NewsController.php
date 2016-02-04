<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use \DateTime;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Base\CoreBundle\Entity\NewsArticleTranslation;

/**
 * @Route("")
 * Class NewsController
 * @package FDC\EventBundle\Controller
 */
class NewsController extends Controller {

    /**
     * @Route("/")
     * @Template("FDCEventBundle:News:home.html.twig")
     */
    public function indexAction() {

        $em = $this->get('doctrine')->getManager();
        $dateTime = new DateTime();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

          ////////////////////////////////////////////////////////////////////////////////////
         /////////////////////////      SOCIAL GRAPH          ///////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        $timeline = $em->getRepository('BaseCoreBundle:SocialGraph')->findBy(array(
            'festival' => $settings->getFestival()
        ), array(
            'date' => 'ASC'
        ), 12, null);

        $socialGraphTimeline      = array();
        $socialGraphTimelineCount = array();
        $socialGraph              = array();

        foreach ($timeline as $key => $timelineDate) {
            $socialGraphTimeline[]['date'] = $timelineDate->getDate();
            $socialGraphTimelineCount[]    = $timelineDate->getCount();
        }

        $socialGraph['timeline']      = $socialGraphTimeline;
        $socialGraph['timelineCount'] = json_encode($socialGraphTimelineCount);

        // Homepage
        $homepage = $em->getRepository('BaseCoreBundle:Homepage')->findOneBy(array(
            'festival' => $settings->getFestival()
        ));
        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

          ////////////////////////////////////////////////////////////////////////////////////
         /////////////////////////       ARTICLE HOME         ///////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////

        //get articles of the day, if no article today : get article from the day before

//        $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $settings->getFestival()->getId(), $dateTime);
//        if($homeArticles == null) {
//            $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsByDate($locale, $settings->getFestival()->getId(), $dateTime->modify('-1 day'));
//        }
        $count = 6;
        $homeArticles = $em->getRepository('BaseCoreBundle:News')->getNewsArticles($locale, $settings->getFestival()->getId(), $dateTime, $count); ///juste pour test

        //set default filters
        $filters                         = array();
        $filters['format'][0]            = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0]      = 'all';

        foreach ($homeArticles as $key => $homeArticle) {
            $homeArticle->image = $homeArticle->getHeader();
            $homeArticle->theme = $homeArticle->getTheme();

            if(($key % 3) == 0){
                $homeArticle->double = true;
            }

            //check if filters don't already exist
            if (!in_array($homeArticle->getTheme()->getId(), $filters['themes']['id'])) {
                $filters['themes']['id'][]    = $homeArticle->getTheme()->getId();
                $filters['themes']['content'][] = $homeArticle->getTheme();
            }

        }
        $format = $homeArticles[0]->getTypes();
        $filters['format'] = array_merge($filters['format'], array_values($format));

        //split articles in two array
        $homeArticles = $this->partition($homeArticles, 2);
        $homeArticlesBottom = $homeArticles[1];
        foreach($homeArticlesBottom as $bottom) {
            $bottom->double = false;
        }

        $homeArticles = $homeArticles[0];

        //get images for slider articles
        $homeArticlesSlider = $em->getRepository('BaseCoreBundle:Media')->getImageMediaByDay($locale, $settings->getFestival()->getId(), $dateTime);

        // TODO: clean this
        $homeSlider = array(
            array(
                'id' => 0,
                'image' => array(
                    'path' => '/bundles/fdcevent/img/slider/slider01.jpg'
                ),
                'theme' => 'Rencontre',
                'title' => 'Xavier DOLAN : « Tant qu’il y a encore un peu de spontanéité, il y a de l’art »'
            ),
            array(
                'id' => 0,
                'image' => array(
                    'path' => '/bundles/fdcevent/img/slider/slider01.jpg'
                ),
                'theme' => 'Rencontre',
                'title' => 'Xavier DOLAN : « Tant qu’il y a encore un peu de spontanéité, il y a de l’art »'
            ),
            array(
                'id' => 0,
                'image' => array(
                    'path' => '/bundles/fdcevent/img/slider/slider01.jpg'
                ),
                'theme' => 'Rencontre',
                'title' => 'Xavier DOLAN : « Tant qu’il y a encore un peu de spontanéité, il y a de l’art »'
            )
        );

        $featuredMovies         = array(
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
        $homeCategories         = array(
            array(
                'title' => 'Le jury',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push01.jpg'
                )
            ),
            array(
                'title' => 'Le palmares',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push02.jpg'
                )
            ),
            array(
                'title' => 'La programmation',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push03.jpg'
                )
            )
        );
        $homeCategoriesFeatured = array(
            array(
                'title' => 'Espace presse',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push04.jpg'
                )
            ),
            array(
                'title' => '',
                'blank' => true,
                'bigger' => true,
                'href' => '',
                'image' => array(
                    'path' => ''
                )
            ),
            array(
                'title' => 'Participer <br> au festival',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push05.jpg'
                )
            ),
            array(
                'title' => 'L\'oeil du photographe',
                'blank' => false,
                'bigger' => true,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push06.jpg'
                )
            ),
            array(
                'title' => 'Lorem ipsum',
                'blank' => true,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
                )
            ),
            array(
                'title' => 'Lorem ipsum',
                'blank' => true,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
                )
            ),
            array(
                'title' => 'Les évènements',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push07.jpg'
                )
            ),
            array(
                'title' => '69 ans d\'archives',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/push/push08.jpg'
                )
            )
        );
        $videos                 = array(
            array(
                'theme' => 'Conférence de presse',
                'most_viewed' => true,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'nbVideos' => 125,
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slider-videos/001.jpg',
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
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
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
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
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
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
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
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
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
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
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
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
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
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
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
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
                    'src' => 'http://dummyimage.com/320x404/3498db/.png',
                    'large' => 'http://dummyimage.com/640x808/000/fff.png'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1'
                )
            )
        );
        $videoSlider            = array(
            array(
                'title' => 'Lorem Ipsum',
                'source' => array(
                    'mp4' => 'https://broken-links.com/tests/media/BigBuck.m4v',
                    'webm' => 'https://broken-links.com/tests/media/BigBuck.webm'
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
                    'webm' => 'https://broken-links.com/tests/media/BigBuck.webm'
                ),
                'image' => array(
                    'path' => 'http://html.festival-cannes-2016.com.ohwee.fr/img/slider/slider01.jpg'
                ),
                'category' => 'Lorem ipsum',
                'author' => array(
                    'fullName' => 'Lorem Ipsum'
                )
            )
        );
        $wallPosts              = array(
            array(
                'big' => true
            ),
            array(
                'big' => true
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            ),
            array(
                'big' => false
            )
        );

        return array(
            'homepage' => $homepage,
            'socialGraph' => $socialGraph,
            'homeArticles' => $homeArticles,
            'homeArticlesBottom' => $homeArticlesBottom,
            'homeArticlesSlider' => $homeArticlesSlider,
            // TODO: clean this
            'homeSlider' => $homeSlider,
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
    public function getAction($slug) {
        $em       = $this->getDoctrine()->getManager();
        $locale   = $this->getRequest()->getLocale();
        //$token = $this->get('security.token_storage')->getToken();
        //$isAdmin = ($token) ? true : false;
        $isAdmin  = true;
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // GET NEWS
        $news = $em->getRepository('BaseCoreBundle:News')->getNewsBySlug($slug, $settings->getFestival()->getId(), $locale, $dateTime->format('Y-m-d H:i:s'), $isAdmin);
        $isPublished = ($news->findTranslationByLocale('fr')->getStatus() === NewsArticleTranslation::STATUS_PUBLISHED);

        if ($news === null || (!$isAdmin && !$isPublished)) {
            throw new NotFoundHttpException();
        }

        // SEO
        //$this->get('base.manager.seo')->setFDCEventPageNewsSeo($news, $locale);

        //get associated film to the news
        $associatedFilm = null;
        $associatedProgrammation = null;
        $associatedFilmDuration = null;
        $type = null;
        if ($news->getAssociatedFilm() != null) {
            $associatedFilm = $news->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $type = 'film';
        } elseif ($news->getAssociatedEvent() != null) {
            $associatedFilm = $news->getAssociatedEvent()->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $type = 'film';
        } elseif ($news->getAssociatedProjections() != null) {
            $associatedProgrammation = $news->getAssociatedProjections();
            $type = 'event';
        }

        //get film projection
        $programmations = array();
        if ($associatedProgrammation != null) {
            foreach ($associatedProgrammation as $projection) {
                if($type == 'event') {
                    $programmations[] = $projection->getAssociation();
                } else {
                    $programmations[] = $projection->getProjection();
                }

            }
        }

        //get focus articles
        $associatedNews = $news->getAssociatedNews();
        $focusArticles  = array();
        foreach ($associatedNews as $associatedNew) {
            if($associatedNew->getAssociation() != null) {
                $focusArticles[] = $associatedNew->getAssociation();
            }
        }

        //get day articles
        $count           = 3;
        $newsDate        = $news->getPublishedAt();
        $sameDayArticles = $em->getRepository('BaseCoreBundle:News')->getSameDayNews($settings->getFestival()->getId(), $locale, $newsDate, $count, $news->getId());

        return array(
            'focusArticles' => $focusArticles,
            'programmations' => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news' => $news,
            'associatedFilm' => $associatedFilm,
            'sameDayArticles' => $sameDayArticles
        );
    }

    /**
     * @Route("/articles")
     *
     * @Template("FDCEventBundle:News/list:article.html.twig")
     */
    public function getArticlesAction() {
        //$offset = 30;
        $dateTime = new DateTime();

        $em     = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL NEWS ARTICLES
        $newsArticles = $em->getRepository('BaseCoreBundle:News')->getNewsArticles($locale, $settings->getFestival()->getId(), $dateTime);
        if ($newsArticles === null) {
            throw new NotFoundHttpException();
        }

        //set default filters
        $filters                         = array();
        $filters['dates'][0]             = 'all';
        $filters['dateFormated'][0]      = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0]      = 'all';


        foreach ($newsArticles as $key => $newsArticle) {
            $isPublished = ($newsArticles !== null) ? ($newsArticle->findTranslationByLocale('fr')->getStatus() === NewsArticleTranslation::STATUS_PUBLISHED) : false;
            if($isPublished) {
                $newsArticle->image = $newsArticle->getHeader();
                $newsArticle->theme = $newsArticle->getTheme();

                if(($key % 3) == 0){
                    $newsArticle->double = true;
                }

                //check if filters don't already exist
                $date = $newsArticle->getPublishedAt();
                if (!in_array($date->format('d-m-Y'), $filters['dateFormated'])) {
                    $filters['dates'][] = ($date != null) ? $date : null;
                    $filters['dateFormated'][] = $date->format('d-m-Y');
                }

                if (!in_array($newsArticle->getTheme()->getId(), $filters['themes']['id'])) {
                    $filters['themes']['id'][]    = $newsArticle->getTheme()->getId();
                    $filters['themes']['content'][] = $newsArticle->getTheme();
                }
            } else {
                unset($newsArticles[$key]);
            }
        }

        return array(
            'articles' => $newsArticles,
            'filters' => $filters
        );
    }

    /**
     * @Route("/photos")
     * @Template("FDCEventBundle:News/list:photo.html.twig")
     */
    public function getPhotosAction() {

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL MEDIA PHOTOS
        $photos = $em->getRepository('BaseCoreBundle:Media')->getImageMedia($locale, $settings->getFestival()->getId(), $dateTime);

        //set default filters
        $filters                         = array();
        $filters['dates'][0]             = 'all';
        $filters['dateFormated'][0]      = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['id'][0]      = 'all';

        foreach ($photos as $key => $photo) {
            $isPublished = ($photo !== null) ? ($photo->findTranslationByLocale('fr')->getStatus() === MediaImageTranslation::STATUS_PUBLISHED) : false;

            if($isPublished == true) {
                $photo->theme = $photo->getTheme();

                if(($key % 3) == 0){
                    $photo->double = true;
                }

                //check if filters don't already exist
                $date = $photo->getPublishedAt();
                if (!in_array($date->format('d-m-Y'), $filters['dateFormated'])) {
                    $filters['dates'][] = ($date != null) ? $date : null;
                    $filters['dateFormated'][] = $date->format('d-m-Y');
                }

                if (!in_array($photo->getTheme()->getId(), $filters['themes']['id'])) {
                    $filters['themes']['id'][] = $photo->getTheme()->getId();
                    $filters['themes']['content'][] = $photo->getTheme();
                }

            } else {
                unset($photos[$key]);
            }

        }

        return array(
            'photos' => $photos,
            'filters' => $filters
        );
    }

    /**
     * @Route("/videos")
     * @Template("FDCEventBundle:News/list:video.html.twig")
     */
    public function getVideosAction() {

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL MEDIA AUDIOS
        $videos = $em->getRepository('BaseCoreBundle:Media')->getVideoMedia($locale, $settings->getFestival()->getId(), $dateTime);

        //set default filters
        $filters                         = array();
        $filters['dates'][0]             = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0]    = 'all';

        foreach ($videos as $key => $video) {
            $isPublished = ($video !== null) ? ($video->findTranslationByLocale('fr')->getStatus() === MediaVideoTranslation::STATUS_PUBLISHED) : false;

            if($isPublished == true) {
                $video->theme = $video->getTheme();

                if(($key % 3) == 0){
                    $video->double = true;
                }

                //check if filters don't already exist
                if (!in_array($video->getPublishedAt(), $filters['dates'])) {
                    $date               = $video->getPublishedAt();
                    $filters['dates'][] = ($date != null) ? $date->format('Y-m-d H:i:s') : null;
                }

                if (!in_array($video->getTheme()->getName(), $filters['themes']['content'])) {
                    $filters['themes']['slug'][]    = $video->getTheme()->getName();
                    $filters['themes']['content'][] = $video->getTheme();
                }

            } else {
                unset($videos[$key]);
            }
        }

        return array(
            'videos' => $videos,
            'filters' => $filters
        );

    }

    /**
     * @Route("/audios")
     * @Template("FDCEventBundle:News/list:audio.html.twig")
     */
    public function getAudiosAction() {

        $em = $this->getDoctrine()->getManager();
        $dateTime = new DateTime();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL MEDIA AUDIOS
        $audios = $em->getRepository('BaseCoreBundle:Media')->getAudioMedia($locale, $settings->getFestival()->getId(), $dateTime);

        //set default filters
        $filters                         = array();
        $filters['dates'][0]             = 'all';
        $filters['themes']['content'][0] = 'all';
        $filters['themes']['slug'][0]    = 'all';

        foreach ($audios as $key => $audio) {
            $isPublished = ($audio !== null) ? ($audio->findTranslationByLocale('fr')->getStatus() === MediaAudioTranslation::STATUS_PUBLISHED) : false;

            if($isPublished == true) {

                $audio->theme = $audio->getTheme();

                if(($key % 3) == 0){
                    $audio->double = true;
                }

                //check if filters don't already exist
                if (!in_array($audio->getPublishedAt(), $filters['dates'])) {
                    $date = $audio->getPublishedAt();
                    $filters['dates'][] = ($date != null) ? $date->format('Y-m-d H:i:s') : null;
                }

                if (!in_array($audio->getTheme()->getName(), $filters['themes']['content'])) {
                    $filters['themes']['slug'][] = $audio->getTheme()->getName();
                    $filters['themes']['content'][] = $audio->getTheme();
                }

            } else {
                unset($audios[$key]);
            }

        }

        return array(
            'audios' => $audios,
            'filters' => $filters
        );
    }


    /**
     * split array
     *
     * @param $list
     * @param $p
     * @return array
     */
    private function partition($list, $p ) {
        $listlen = count( $list );
        $partlen = floor( $listlen / $p );
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice( $list, $mark, $incr );
            $mark += $incr;
        }
        return $partition;
    }

}
