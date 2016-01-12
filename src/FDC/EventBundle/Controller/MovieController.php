<?php

namespace FDC\EventBundle\Controller;

use \DateTime;

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

    /**
     * @Route("/movie/cannes-classics/{slug}")
     * @Template("FDCEventBundle:Movie:classics.html.twig")
     * @param $slug
     * @return array
     */
    public function classicsAction($slug)
    {

        $filters = array(
            array(
                'name' => 'Invités d\'honneur',
                'slug' => 'invites-honneur',
            ),
            array(
                'name' => 'Hommages',
                'slug' => 'hommage',
            ),
            array(
                'name' => 'Copies restaurées',
                'slug' => 'copies-restaurees',
            ),
            array(
                'name' => 'World Cinema Project',
                'slug' => 'world-cinema-project',
            ),
            array(
                'name' => 'Documentaires',
                'slug' => 'documentaires',
            ),
        );

        $honnorContent = array(
            'title' => 'Lumière sur deux réalisateurs',
            'category' => array(
                'title' => 'Hommage',
                'slug' => 'hommage',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-bandeau-push.jpg'
                )
            ),
            'guest' => array(
                array(
                    'fullName' => 'Costa Gravas',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/image-invitespecial.jpg',
                        'copyright' => '© Lorem ipsum.'
                    ),
                    'description' => 'Cannes Classics 2015 est placé sous l\'égide de Costa-Gavras qui en sera l\'invité
                                     d\'honneur. Palme d\'or avec <a href="#">Missing</a> en 1982, membre du Jury en
                                     1976 (il récompensa <a href="#">Taxi Driver</a>), Prix de la mise en scène avec
                                     <a href="#">Section spéciale</a> en 1975, c\'est en sa présence que sera projeté Z,
                                      Prix du Jury en 1969.',
                    'widgets' => array(
                        array(
                            'type' => 'movie_widget_info',
                            'title' => 'Z',
                            'duration' => '1h58',
                            'date' => '1968'
                        ),
                        array(
                            'type' => 'movie_widget_text',
                            'content' => 'Présenté par KG Productions avec le soutien du CNC. Négatif original numérisé
                                          en 4K et restauré image par image en 2K par Eclair Group et par LE Diapason
                                          pour le son. Restauration et étalonnage supervisés par Costa-Gavras.'
                        ),
                        array(
                            'type' => 'movie_widget_trailer',
                            'description' => "Redécouvrez la bande-annonce du film lors de sa sortie en salles:",
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-invitespecial.jpg'
                            )
                        ),
                    ),
                ),
                array(
                    'fullName' => 'Woody Allen',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/image-invitespecial2.jpg',
                        'copyright' => '© Lorem ipsum.'
                    ),
                    'description' => 'A l\'âge de seize ans, Woody Allen envoie des histoires drôles à différents
                                      chroniqueurs de journaux. Après avoir écrit des sketches pour la télévision et
                                      d\'innombrables chroniques pour des magazines comme Playboy, il décide en 1961 de
                                      monter sur les planches. Il arpente ainsi les cabarets et les plateaux de
                                      télévision.',
                    'film' => array(
                        'title' => 'Minuits à Paris',
                        'duration' => '1h45',
                        'date' => '2011'
                    ),
                    'widgets' => array(
                        array(
                            'type' => 'movie_widget_text',
                            'content' => 'Présenté par KG Productions avec le soutien du CNC. Négatif original numérisé
                                          en 4K et restauré image par image en 2K par Eclair Group et par LE Diapason
                                          pour le son. Restauration et étalonnage supervisés par Costa-Gavras.'
                        ),
                        array(
                            'type' => 'movie_widget_info',
                            'title' => 'Z',
                            'duration' => '1h58',
                            'date' => '1968'
                        ),
                        array(
                            'type' => 'movie_widget_text',
                            'content' => 'Présenté par KG Productions avec le soutien du CNC. Négatif original numérisé
                                          en 4K et restauré image par image en 2K par Eclair Group et par LE Diapason
                                          pour le son. Restauration et étalonnage supervisés par Costa-Gavras.'
                        ),
                        array(
                            'type' => 'movie_widget_trailer',
                            'description' => "Redécouvrez la bande-annonce du film lors de sa sortie en salles:",
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-invitespecial2.jpg'
                            )
                        ),
                        array(
                            'type' => 'movie_widget_audio',
                            'title' => 'The lobster',
                            'sound' => 'mp3',
                            'createdAt' => new DateTime(),
                            'theme' => 'Cinéma de la plage',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg'
                            ),
                            'akamaiId' => 'DAaDo5fgcUc'
                        ),
                        array(
                            'type' => 'movie_widget_quote',
                            'content' => 'J’ai découvert que Lambert avait une passion pour le film de genre',

                        ),
                        array(
                            'type' => 'movie_widget_image',
                            'copyright' => "Équipe du film - Photocall - The Lobster",
                            'photos' => array(
                                array(
                                    'id' => 0,
                                    'image' => array(
                                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme' => 'Lorem Ipsum',
                                    'title' => 'lorem ipsum',
                                    'caption' => 'lorem ipsum',
                                    'alt' => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                ),
                                array(
                                    'id' => 0,
                                    'image' => array(
                                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme' => 'Lorem Ipsum',
                                    'title' => 'lorem ipsum',
                                    'caption' => 'lorem ipsum',
                                    'alt' => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                ),
                                array(
                                    'id' => 0,
                                    'image' => array(
                                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme' => 'Lorem Ipsum',
                                    'title' => 'lorem ipsum',
                                    'caption' => 'lorem ipsum',
                                    'alt' => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                ),
                                array(
                                    'id' => 0,
                                    'image' => array(
                                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme' => 'Lorem Ipsum',
                                    'title' => 'lorem ipsum',
                                    'caption' => 'lorem ipsum',
                                    'alt' => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                ),
                                array(
                                    'id' => 0,
                                    'image' => array(
                                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme' => 'Lorem Ipsum',
                                    'title' => 'lorem ipsum',
                                    'caption' => 'lorem ipsum',
                                    'alt' => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                )
                            )
                        ),
                        array(
                            'type' => 'image_dual_align',
                            'photos' => array(
                                array(
                                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/article/005.jpg',
                                    'title' => 'lorem ipsum',
                                    'alt' => 'lorem ipsum',
                                    'copyright' => 'VALERY HACHE / AFP'
                                ),
                                array(
                                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/article/005.jpg',
                                    'title' => 'lorem ipsum',
                                    'alt' => 'lorem ipsum',
                                    'copyright' => 'VALERY HACHE / AFP'
                                )
                            )
                        ),
                    )
                )
            ),
            'sections' => array(
                array(
                    'title' => 'Centenaire Orson Welles',
                    'description' => '',
                    'film' => array(
                        array(
                            'title' => 'Citizen Kane',
                            'date' => '1941',
                            'duration' => '1h59',
                            'author' => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.<br>
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title' => 'Citizen Kane',
                            'date' => '1941',
                            'duration' => '1h59',
                            'author' => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        )
                    )
                ),
                array(
                    'title' => 'Hommage a Manoel De Oliveira',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente voluptatibus
                                      magnam culpa, ut quam est repellendus aliquam ipsum eos debitis. Lorem ipsum
                                      dolor sit amet, consectetur adipisicing elit. Repellendus consequuntur esse
                                      doloremque qui sunt vel voluptatem repudiandae eaque aliquid architecto.',
                    'film' => array(
                        array(
                            'title' => 'Visita',
                            'date' => '1982',
                            'duration' => '1h08',
                            'author' => array(
                                'fullName' => 'Manoel De Oliveira'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        )
                    )
                )
            )
        );

        $hommageContent = array(
            'category' => array(
                'title' => 'Copies Restaurées',
                'slug' => 'copies-restaurees',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-bandeau-push.jpg'
                )
            ),
            'sections' => array(
                array(
                    'title' => 'Centenaire Orson Welles',
                    'description' => '',
                    'film' => array(
                        array(
                            'title' => 'Citizen Kane',
                            'date' => '1941',
                            'duration' => '1h59',
                            'author' => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.<br>
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title' => 'Citizen Kane',
                            'date' => '1941',
                            'duration' => '1h59',
                            'author' => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        )
                    )
                ),
                array(
                    'title' => 'Hommage a Manoel De Oliveira',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente voluptatibus
                                      magnam culpa, ut quam est repellendus aliquam ipsum eos debitis. Lorem ipsum
                                      dolor sit amet, consectetur adipisicing elit. Repellendus consequuntur esse
                                      doloremque qui sunt vel voluptatem repudiandae eaque aliquid architecto.',
                    'film' => array(
                        array(
                            'title' => 'Visita',
                            'date' => '1982',
                            'duration' => '1h08',
                            'author' => array(
                                'fullName' => 'Manoel De Oliveira'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        )
                    )
                )
            )
        );

        $copiesContent = array(
            'category' => array(
                'title' => 'World cinema project',
                'slug' => 'world-cinema',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-bandeau-push.jpg'
                )
            ),
            'sections' => array(
                array(
                    'film' => array(
                        array(
                            'title' => 'Citizen Kane',
                            'date' => '1941',
                            'duration' => '1h59',
                            'author' => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.<br>
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title' => 'Citizen Kane',
                            'date' => '1941',
                            'duration' => '1h59',
                            'author' => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title' => 'Citizen Kane',
                            'date' => '1941',
                            'duration' => '1h59',
                            'author' => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title' => 'Citizen Kane',
                            'date' => '1941',
                            'duration' => '1h59',
                            'author' => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        )
                    )
                ),
            )
        );


        $content = array();

        switch ($slug) {
            case "invites-honneur":
                $content = $honnorContent;
                break;
            case "hommage":
                $content = $hommageContent;
                break;
            case "copies-restaurees":
                $content = $copiesContent;
                break;
        }

        return array(
            'content' => $content,
            'filters' => $filters
        );
    }

    /**
     * @Route("/cinema-de-la-plage")
     * @Template("FDCEventBundle:Movie:cinema.html.twig")
     * @return array
     */
    public function cinemaAction()
    {
        $content = array(
            'description' => 'Les projections du Cinéma de la Plage, qui se jouent chaque soir sous les étoiles, sont ouvertes au public',
            'film' => array(
                array(
                    'title' => 'Le grand blond avec une chaussure noire',
                    'author' => array(
                        'fullName' => 'Yves ROBERT'
                    ),
                    'releaseDate' => new \DateTime(),
                    'projectionDate' => new \DateTime(),
                    'duration' => '1h30',
                    'description' => 'Restauration 2K présentée par Gaumont. Travaux image effectués par Eclair,
                                      son restauré par Diapason en partenariat avec Eclair.',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film_cdp1.jpg'
                    )
                ),
                array(
                    'title' => 'Le grand blond avec une chaussure noire',
                    'author' => array(
                        'fullName' => 'Yves ROBERT'
                    ),
                    'releaseDate' => new \DateTime(),
                    'projectionDate' => new \DateTime(),
                    'duration' => '1h30',
                    'description' => 'Restauration 2K présentée par Gaumont. Travaux image effectués par Eclair,
                                      son restauré par Diapason en partenariat avec Eclair.',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film_cdp1.jpg'
                    )
                ),
                array(
                    'title' => 'Le grand blond avec une chaussure noire',
                    'author' => array(
                        'fullName' => 'Yves ROBERT'
                    ),
                    'releaseDate' => new \DateTime(),
                    'projectionDate' => new \DateTime(),
                    'duration' => '1h30',
                    'description' => 'Restauration 2K présentée par Gaumont. Travaux image effectués par Eclair,
                                      son restauré par Diapason en partenariat avec Eclair.',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film_cdp1.jpg'
                    )
                )
            )
        );

        return array(
            'cinemaContent' => $content
        );
    }
}
