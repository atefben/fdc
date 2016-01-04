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
     * @Template("FDCEventBundle:Movie:main.html.twig")
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
                    'path' => 'http://dummyimage.com/210x284/000/fff'
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
                    'path' => 'http://dummyimage.com/210x284/000/fff'
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
                    'path' => 'http://dummyimage.com/210x284/000/fff'
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
                    'path' => 'http://dummyimage.com/210x284/000/fff'
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
                    'path' => 'http://dummyimage.com/210x284/000/fff'
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
                    'path' => 'http://dummyimage.com/210x284/000/fff'
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
                    'path' => 'http://dummyimage.com/210x284/000/fff'
                ),
                'author' => array(
                    'fullName' => 'Paolo SORRENTINO',
                    'from' => 'Italie'
                )
            ),
            'prev' => array(
                'slug' => 'youth',
                'image' => array(
                    'path' => 'http://dummyimage.com/210x284/000/fff'
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
                    'path' => 'http://dummyimage.com/210x284/000/fff'
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
                'banner' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/002.jpg',
                'cover' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/006.jpg',
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
                array(
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/004.jpg',
                        'cover' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/005.jpg',
                        'copyright' => '© FDC / Jean-Luc GODARD'
                    ),
                    'credits' => array(
                        'slug' => 'LoremIpsum',
                        'fullName' => 'Lorem Ipsum',
                        'role' => 'Auteur'
                    ),
                    'casting' => array(
                        'slug' => 'LoremIpsum',
                        'fullName' => 'Lorem Ipsum',
                        'role' => 'Auteur'
                    ),
                ),
                array(
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/004.jpg',
                        'cover' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/005.jpg',
                        'copyright' => '© FDC / Jean-Luc GODARD'
                    ),
                    'credits' => array(
                        'slug' => 'LoremIpsum',
                        'fullName' => 'Lorem Ipsum',
                        'role' => 'Auteur'
                    ),
                    'casting' => array(
                        'slug' => 'LoremIpsum',
                        'fullName' => 'Lorem Ipsum',
                        'role' => 'Auteur'
                    ),
                ),
                array(
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/004.jpg',
                        'cover' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/005.jpg',
                        'copyright' => '© FDC / Jean-Luc GODARD'
                    ),
                    'credits' => array(
                        'slug' => 'LoremIpsum',
                        'fullName' => 'Lorem Ipsum',
                        'role' => 'Auteur'
                    ),
                    'casting' => array(
                        'slug' => 'LoremIpsum',
                        'fullName' => 'Lorem Ipsum',
                        'role' => 'Auteur'
                    ),
                )
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
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'caption' => '<a>Test</a>',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'copyright' => 'Lorem ipsum',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'caption' => '<a>Test</a>',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'copyright' => 'Lorem ipsum',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'caption' => '<a>Test</a>',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'copyright' => 'Lorem ipsum',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'caption' => '<a>Test</a>',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'copyright' => 'Lorem ipsum',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg',
                    ),
                ),
            ),
            'articles' => array(
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'type' => 'article',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'type' => 'article',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg',
                    ),
                ),
                array(
                    'id' => 0,
                    'title' => 'Lorem Ipsum',
                    'type' => 'article',
                    'theme' => 'En compétition',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg',
                    ),
                ),
            ),
            'audios' => array(
                array(
                    'title' => 'Lorem Ipsum',
                    'theme' => 'article',
                    'sound' => 'sound.mp3',
                    'createdAt' => new \DateTime(),
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
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
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/movie/003.jpg'
                ),
            ),
            array(
                'most_viewed' => false,
                'theme' => 'Photocall',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum dolor sit amet sit amet',
                'image' => array(
                    'path' => '//dummyimage.com/293x185/000/fff'
                ),
            ),
            array(
                'most_viewed' => false,
                'theme' => 'Photocall',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum dolor sit amet sit amet',
                'image' => array(
                    'path' => 'http://dummyimage.com/293x185/000/fff'
                ),
            ),
            array(
                'most_viewed' => false,
                'theme' => 'Photocall',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum dolor sit amet sit amet',
                'image' => array(
                    'path' => 'http://dummyimage.com/293x185/000/fff'
                ),
            ),
            array(
                'most_viewed' => false,
                'theme' => 'Photocall',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum dolor sit amet sit amet',
                'image' => array(
                    'path' => 'http://dummyimage.com/293x185/000/fff'
                ),
            ),
            array(
                'most_viewed' => false,
                'theme' => 'Photocall',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum dolor sit amet sit amet',
                'image' => array(
                    'path' => 'http://dummyimage.com/293x185/000/fff'
                ),
            ),
            array(
                'most_viewed' => false,
                'theme' => 'Photocall',
                'createdAt' => new \DateTime(),
                'title' => 'Lorem ipsum dolor sit amet sit amet',
                'image' => array(
                    'path' => 'http://dummyimage.com/293x185/000/fff'
                ),
            )

        );

        return array(
            'movies' => $movies,
            'movie' => $movie,
            'videos' => $videos,
        );
    }

    /**
     * @Route("/selection/{slug}")
     * @Template("FDCEventBundle:Movie:selection.html.twig")
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
