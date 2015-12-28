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

        $home = array(
            'article' => array(
                array(
                    'id' => 0,
                    'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                    'double' => true,
                    'format' => 'article',
                    'theme' => 'cinema',
                    'category' => 'Cinéma de la plage',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => 'img.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'La Loi du Marché par Stéphane Brizé',
                    'double' => false,
                    'format' => 'audio',
                    'theme' => 'press',
                    'category' => 'Conférence de Presse',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => 'img.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                    'double' => false,
                    'format' => 'article',
                    'theme' => 'cinema',
                    'category' => 'Cinéma de la plage',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => 'img.jpg',
                    ),
                ),
            ),
            'bottomArticle' => array(
                array(
                    'id' => 0,
                    'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                    'double' => false,
                    'format' => 'article',
                    'theme' => 'cinema',
                    'category' => 'Cinéma de la plage',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => 'img.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'La Loi du Marché par Stéphane Brizé',
                    'double' => false,
                    'format' => 'audio',
                    'theme' => 'press',
                    'category' => 'Conférence de Presse',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => 'img.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                    'double' => false,
                    'format' => 'article',
                    'theme' => 'cinema',
                    'category' => 'Cinéma de la plage',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => 'img.jpg',
                    ),
                ),
            ),
            'widgets' => array(
                array(
                    'type' => 'image',
                    'copyright' => "Équipe du film - Photocall - The Lobster",
                    'photos' => array(
                        array(
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
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
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'thumb' => 'img.jpg',
                            'copyright' => 'Crédit Image : VALERY HACHE / AFP'
                        )
                    )
                ),
            ),
            'timeline' => array(
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
                array(
                    'date' => new \DateTime()
                ),
            )
        );

        $homeCategories = array(
            array(
                'title' => 'Lorem ipsum',
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
                ),
            ),
            array(
                'title' => 'Lorem ipsum',
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
                ),
            ),
            array(
                'title' => 'Lorem ipsum',
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
                ),
            )
        );
        $homeCategoriesFeatured = array(
            array(
                'title' => 'Lorem ipsum',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
                ),
            ),
            array(
                'title' => 'Lorem ipsum',
                'blank' => false,
                'bigger' => true,
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
                'title' => 'Lorem ipsum',
                'blank' => false,
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
                'title' => 'Lorem ipsum',
                'blank' => false,
                'bigger' => false,
                'href' => '/category',
                'image' => array(
                    'path' => 'img.jpg'
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
                'img' => array(
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
                'theme' => 'Conférence de presse',
                'most_viewed' => true,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'img' => array(
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
                'theme' => 'Conférence de presse',
                'most_viewed' => true,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'img' => array(
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
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'img' => array(
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
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'img' => array(
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
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'img' => array(
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
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'img' => array(
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
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'img' => array(
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
                'theme' => 'Conférence de presse',
                'most_viewed' => false,
                'title' => 'Sur le tournage de "Deephan" de Jacques Audiard',
                'createdAt' => new \DateTime(),
                'copyright' => 'Crédit Image : VALERY HACHE / AFP',
                'img' => array(
                    'path' => 'img.jpg',
                    'src'      => 'http://dummyimage.com/320x404/3498db/.png',
                    'large'    => 'http://dummyimage.com/640x808/000/fff.png',
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            )
        );

        return array(
            'homeSlider' => $homeSlider,
            'homeArticles' => $home,
            'filters' => $filters,
            'videos' => $videos,
            'homeCategories' => $homeCategories,
            'homeCategoriesFeatured' => $homeCategoriesFeatured,
        );
    }

    /**
     * @Route("/articles/{slug}")
     * @Template("FDCEventBundle:News:main.html.twig")
     * @param $slug
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
        $this->get('base.manager.seo')->setFDCEventPageNewsSeo($news, $locale);

        return array(
            'news' => $news,
          //  'article' => $article
        );
    }

    /**
     * @Route("/articles")
     * @Template("FDCEventBundle:News:list-article.html.twig")
     */
    public function getArticlesAction()
    {

        $articles = array(
            array(
                'id'    => 0,
                'theme' => 'Cinéma de la plage',
                'createdAt' => new \DateTime(),
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'image' => array(
                    'path' => 'img.jpg',
                ),
            ),
            array(
                'id'    => 0,
                'theme' => 'Cinéma de la plage',
                'createdAt' => new \DateTime(),
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'image' => array(
                    'path' => 'img.jpg',
                ),
            ),
            array(
                'id'    => 0,
                'theme' => 'Cinéma de la plage',
                'createdAt' => new \DateTime(),
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'image' => array(
                    'path' => 'img.jpg',
                ),
            ),
            array(
                'id'    => 0,
                'theme' => 'Cinéma de la plage',
                'createdAt' => new \DateTime(),
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'image' => array(
                    'path' => 'img.jpg',
                ),
            ),
            array(
                'id'    => 0,
                'theme' => 'Cinéma de la plage',
                'createdAt' => new \DateTime(),
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'image' => array(
                    'path' => 'img.jpg',
                ),
            ),
            array(
                'id'    => 0,
                'theme' => 'Cinéma de la plage',
                'createdAt' => new \DateTime(),
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'image' => array(
                    'path' => 'img.jpg',
                ),
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
            'articles' => $articles,
            'filters' => $filters,
        );
    }

    /**
     * @Route("/photos")
     * @Template("FDCEventBundle:News:article.list-photo.html.twig")
     */
    public function getPhotosAction()
    {
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
     * @Template("FDCEventBundle:News:list-video.html.twig")
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
