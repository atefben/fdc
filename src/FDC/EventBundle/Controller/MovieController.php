<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class MovieController extends Controller
{

    /**
     * @Route("/movie/{slug}")
     * @Template("FDCEventBundle:Movie:movie.main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction($slug)
    {

        $movies = array(
            array(
                'slug' => 'youth',
                'title' => 'Youth',
                'titleVO' => 'Youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            array(
                'slug' => 'youth',
                'title'=> 'Youth',
                'titleVO' => 'Youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            array(
                'slug' => 'youth',
                'title'=> 'Youth',
                'titleVO' => 'Youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            array(
                'slug' => 'youth',
                'title'=> 'Youth',
                'titleVO' => 'Youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            array(
                'slug' => 'youth',
                'title'=> 'Youth',
                'titleVO' => 'Youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            array(
                'slug' => 'youth',
                'title'=> 'Youth',
                'titleVO' => 'Youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            array(
                'slug' => 'youth',
                'title'=> 'Youth',
                'titleVO' => 'Youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            'prev' => array(
                'slug' => 'youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'title' => 'Youth',
                'titleVO' => 'Youth',
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            'next' => array(
                'slug' => 'youth',
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'title' => 'Youth',
                'titleVO' => 'Youth',
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
        );

        $movie = array(
            'title' => 'Adieu au language',
            'titleVO' => 'Adieu au language',
            'productionYear' => '2000',
            'releaseYear' => '2005',
            'duration' => '1h33',
            'synopsis' => 'Le propos est simple<br>
                           Une femme mariée et un homme libre se rencontrent<br>
                           Ils s’aiment, se disputent, les coups pleuvent<br>
                           Un chien erre entre ville et campagne<br>
                           Les saisons passent<br>
                           L’homme et la femme se retrouvent<br>
                           Le chien se trouve entre eux<br>
                           L’autre est dans l’un<br>
                           L’un est dans l’autre<br>
                           Et ce sont les trois personnes<br>
                           L’ancien mari fait tout exploser<br>
                           Un deuxième film commence<br>
                           Le même que le premier<br>
                           Et pourtant pas<br>
                           De l’espèce humaine on passe à la métaphore<br>
                           Ça finira par des aboiements<br>
                           Et des cris de bébé',
            'image' => array(
                'banner' => 'img.jpg',
                'cover' => 'img.jpg',
            ),
            'categories' => array(
                array(
                    'name' => 'En compétition',
                ),
                array(
                    'name' => 'Longs métrages',
                ),
                array(
                    'name' => 'films d\'ouverture',
                )
            ),
            'author' => array(
                'fullName' => 'Jean-Luc Godard',
                'from' => 'France',
                'slug' => 'jean-luc-godard'
            ),
            'persons' => array(
                'image' => array(
                    'path' => 'img.jpg',
                    'cover' => 'img.jpg',
                ),
            ),
            'press' => array(
                'links' => array(
                    array(
                        'name' => 'Site Web',
                        'href' => 'http://www.google.fr'
                    ),
                    array(
                        'name' => 'Site Web',
                        'href' => 'http://www.google.fr'
                    ),
                    array(
                        'name' => 'Site Web',
                        'href' => 'http://www.google.fr'
                    )
                ),
            ),
            'photos' => array(
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'caption' => '<a>Test</a>',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'copyright' => 'Lorem ipsum',
                    'image' => array(
                        'path' => 'img.jpg',
                        'thumb' => 'img.jpg',
                    ),
                ),
            ),
            'articles' => array(
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'type' => 'Lorem',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => 'img.jpg',
                        'thumb' => 'img.jpg',
                    ),
                ),
            ),
            'audios' => array(
                array(
                    'title' => 'Lorem Ipsum',
                    'theme' => 'Lorem',
                    'sound' => 'sound.mp3',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => 'img.jpg',
                        'thumb' => 'img.jpg',
                    ),
                ),
            ),
            'compete' => array(
                array(

                ),
            ),
        );

        $videos = array(
            array(
                'most_viewed' => true,
                'theme' => 'Bande-annonce',
                'createdAt' => new \DateTime(),
                'title' => 'The Lobster',
                'image' => array(
                    'path' => 'img.jpg'
                ),
            ),
            array(
                'most_viewed' => false,
                'theme' => 'Bande-annonce',
                'createdAt' => new \DateTime(),
                'title' => 'The Lobster',
                'image' => array(
                    'path' => 'img.jpg'
                ),
            ),

        );

        return array(
            'movies' => $movies,
            'movie' => $movie,
            'videos' => $videos,
        );
    }

    /**
     * @Route("/selection/{slug}")
     * @Template("FDCEventBundle:Movie:movie.selection.html.twig")
     * @param $slug
     * @return array
     */
    public function selectionAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        // find all selected movies
        $movies = $em->getRepository('BaseCoreBundle:FilmFilm')->findBy(array('selection' => 1));

        return array(
            'movies' => $movies
        );
    }
}
