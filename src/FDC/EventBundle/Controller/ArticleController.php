<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/actualite")
 * Class ArticleController
 * @package FDC\EventBundle\Controller
 */
class ArticleController extends Controller
{

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/jours")
     * @Template("FDCEventBundle:Article:article.main.html.twig")
     */
    public function getAction()
    {

        $article = array(
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
                    'title' => 'The lobster',
                    'theme' => 'Cinéma de la plage',
                    'podcast' => 'sound2.mp3',
                    'createdAt' => new \DateTime(),
                    'img' => array(
                        'path' => 'img.jpg'
                    ),
                    'akamaiId' => 'DAaDo5fgcUc'
                ),
                array(
                    'type' => 'audio',
                    'title' => 'The lobster',
                    'theme' => 'Cinéma de la plage',
                    'podcast' => 'sound2.mp3',
                    'createdAt' => new \DateTime(),
                    'img' => array(
                        'path' => 'img.jpg'
                    ),
                    'akamaiId' => 'DAaDo5fgcUc'
                )
            )
        );
        return array('article' => $article);
    }

    /**
     * @Route("/articles")
     * @Template()
     */
    public function getArticlesAction()
    {
        return array();
    }

    /**
     * @Route("/photos")
     * @Template()
     */
    public function getPhotosAction()
    {
        return array();
    }

    /**
     * @Route("/videos")
     * @Template()
     */
    public function getVideosAction()
    {
        return array();
    }

    /**
     * @Route("/audios")
     * @Template()
     */
    public function getAudiosAction()
    {
        return array();
    }

}
