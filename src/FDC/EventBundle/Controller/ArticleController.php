<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("")
 * Class ArticleController
 * @package FDC\EventBundle\Controller
 */
class ArticleController extends Controller
{

    /**
     * @Route("/")
     * @Template("FDCEventBundle:Article:article.home.html.twig")
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
     * @Route("/articles/{id}")
     * @Template("FDCEventBundle:Article:article.main.html.twig")
     * @param $id
     * @return array
     */
    public function getAction($id)
    {
        //$article = findBy($id)

        $article = array(
            'id'    => 0,
            'theme' => 'Cinéma de la plage',
            'createdAt' => new \Datetime(),
            'updatedAt' => new \Datetime(),
            'title' => "Enragés, polar hybride d'Eric Hannezo",
            'mainImg' => array(
                'path' => 'img.jpg',
                'copyright' => 'Maïwenn - Photocall © FDC / Théophile Delange'
            ),
            'author' => array(
                'fullName' => 'Morgane Urbain'
            ),
            'introduction' => "Ancien journaliste devenu producteur et cinéaste, Éric Hannezo s'aventure pour son
                               premier film sur les routes nord-américaines et signe un polar hybride à l'affiche duquel
                               on retrouve <a href=\"#\">Lambert Wilson</a> et Franck Gastambide",
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
                        )
                    )
                ),
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
                        )
                    )
                ),
                array(
                    'type' => 'image_dual_align',
                    'photos' => array(
                        array(
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'copyright' => 'VALERY HACHE / AFP'
                        ),
                        array(
                            'path' => 'img.jpg',
                            'title' => 'lorem ipsum',
                            'alt' => 'lorem ipsum',
                            'copyright' => 'VALERY HACHE / AFP'
                        )
                    )
                ),
                array(
                    'type' => 'text',
                    'content' => '<p><strong>Il y a différents statuts d’acteurs&nbsp;: Lambert Wilson, Virginie Ledoyen
                                         d’un côté et ensuite tu as Guillaume Gouix, jeune acteur, Franck Gastambile et
                                         le québécois François Arnaud … Vous êtes satisfait du rendu&nbsp;?</strong>
                                         </p>
                                  <p>Symboliquement, j’avais une famille&nbsp;: Lambert qui joue le père, Virginie la
                                  mère, Guillaume l’ainé, Franck le jeune un peu perdu et François le sale gosse. Et oui
                                  , j’en suis super content parce que je voulais une lecture nouvelle sur le film de
                                  genre .</p>'
                ),
                array(
                    'type' => 'quote',
                    'content' => 'J’ai découvert que Lambert avait une passion pour le film de genre',

                ),
                array(
                    'type' => 'video_youtube',
                    'title' => 'The lobster',
                    'theme' => 'Cinéma de la plage',
                    'createdAt' => new \Datetime(),
                    'img' => array(
                        'path' => 'img.jpg'
                    ),
                    'youtubeId' => 'DAaDo5fgcUc'
                ), array(
                    'type' => 'video_akamai',
                    'title' => 'The lobster',
                    'theme' => 'Cinéma de la plage',
                    'createdAt' => new \DateTime(),
                    'img' => array(
                        'path' => 'img.jpg'
                    ),
                    'akamaiId' => 'DAaDo5fgcUc'
                ),
                array(
                    'type' => 'audio',
                    'podcast' => array(
                        array(
                            'title' => 'The lobster',
                            'theme' => 'Cinéma de la plage',
                            'sound' => 'sound2.mp3',
                            'createdAt' => new \DateTime(),
                            'img' => array(
                                'path' => 'img.jpg'
                            ),
                            'akamaiId' => 'DAaDo5fgcUc'
                        ),
                        array(
                            'title' => 'The lobster',
                            'theme' => 'Cinéma de la plage',
                            'sound' => 'sound2.mp3',
                            'createdAt' => new \DateTime(),
                            'img' => array(
                                'path' => 'img.jpg'
                            ),
                            'akamaiId' => 'DAaDo5fgcUc'
                        ),
                    ),
                ),
            )
        );

        return array('article' => $article);
    }

    /**
     * @Route("/articles")
     * @Template("FDCEventBundle:Article:article.list-article.html.twig")
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
     * @Template("FDCEventBundle:Article:article.list-photo.html.twig")
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
     * @Template("FDCEventBundle:Article:article.list-video.html.twig")
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
     * @Template("FDCEventBundle:Article:article.list-audio.html.twig")
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
