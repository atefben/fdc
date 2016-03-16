<?php

namespace FDC\EventBundle\Controller;

use \DateTime;

use Base\CoreBundle\Entity\FDCPageLaSelection;

use FDC\EventBundle\Component\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function getAction(Request $request, $slug)
    {
        $em = $this->get('doctrine')->getManager();
        $locale = $request->getLocale();
        $festival = $this->getFestival()->getId();
        $isAdmin  = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

        // GET MOVIE
        if ($isAdmin) {
            $movie = $em->getRepository('BaseCoreBundle:FilmFilm')->findOneBy(array(
                'slug' => $slug
            ));
        } else {
            $movie = $em->getRepository('BaseCoreBundle:FilmFilm')->findOneBy(array(
                'slug' => $slug,
                'festival' => $this->getFestival()
            ));

        }

        if ($movie === null) {
            throw new NotFoundHttpException('Movie not found');
        }

        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($festival, $locale, $movie->getSelectionSection()->getId())
        ;

        return array(
            'movies' => $movies,
            'movie'  => $movie
        );
    }

    /**
     * @Route("/selection/{slug}")
     * @Template("FDCEventBundle:Movie:selection.html.twig")
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function selectionAction(Request $request, $slug = null)
    {
        $this->isPageEnabled($request->get('_route'));
        $locale = $request->getLocale();
        $festival = $this->getFestival()->getId();

        $waitingPage = $this->isWaitingPage($request);
        if ($waitingPage) {
            return $waitingPage;
        }

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;
        if ($slug === null) {
            foreach ($pages as $page) {
                if ($page instanceof FDCPageLaSelection) {
                    if ($page->findTranslationByLocale($locale)) {
                        $slug = $page->findTranslationByLocale($locale)->getSlug();
                    }
                    if (!$slug) {
                        $page->getSelectionSection()->findTranslationByLocale($locale)->getSlug();
                    }
                    if ($slug) {
                        return $this->redirectToRoute('fdc_event_movie_selection', array('slug' => $slug));
                    }
                }
            }
            throw $this->createNotFoundException('There is not available selection.');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPageBySlug($locale, $slug)
        ;

        if (!$page || !$page->getSelectionSection()) {
            throw  $this->createNotFoundException('Page Selection not found');
        }

        $next = false;
        foreach ($pages as $item) {
            if ($next) {
                $next = $item;
                break;
            }
            if ($item->getId() == $page->getId()) {
                $next = true;
            }
        }
        if (!$next) {
            $next = reset($pages);
        }

        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($festival, $locale, $page->getSelectionSection()->getId())
        ;

        $this->get('base.manager.seo')->setFDCEventPageFDCPageLaSelectionSeo($page, $locale);

        return array(
            'selectionTabs' => $pages,
            'page'          => $page,
            'movies'        => $movies,
            'next'          => is_object($next) ? $next : false,
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
            'title'    => 'Lumière sur deux réalisateurs',
            'category' => array(
                'title' => 'Hommage',
                'slug'  => 'hommage',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-bandeau-push.jpg'
                )
            ),
            'guest'    => array(
                array(
                    'fullName'    => 'Costa Gravas',
                    'image'       => array(
                        'path'      => '//html.festival-cannes-2016.com.ohwee.fr/img/films/image-invitespecial.jpg',
                        'copyright' => '© Lorem ipsum.'
                    ),
                    'description' => 'Cannes Classics 2015 est placé sous l\'égide de Costa-Gavras qui en sera l\'invité
                                     d\'honneur. Palme d\'or avec <a href="#">Missing</a> en 1982, membre du Jury en
                                     1976 (il récompensa <a href="#">Taxi Driver</a>), Prix de la mise en scène avec
                                     <a href="#">Section spéciale</a> en 1975, c\'est en sa présence que sera projeté Z,
                                      Prix du Jury en 1969.',
                    'widgets'     => array(
                        array(
                            'type'     => 'movie_widget_info',
                            'title'    => 'Z',
                            'duration' => '1h58',
                            'date'     => '1968'
                        ),
                        array(
                            'type'    => 'movie_widget_text',
                            'content' => 'Présenté par KG Productions avec le soutien du CNC. Négatif original numérisé
                                          en 4K et restauré image par image en 2K par Eclair Group et par LE Diapason
                                          pour le son. Restauration et étalonnage supervisés par Costa-Gavras.'
                        ),
                        array(
                            'type'        => 'movie_widget_trailer',
                            'description' => "Redécouvrez la bande-annonce du film lors de sa sortie en salles:",
                            'image'       => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-invitespecial.jpg'
                            )
                        ),
                    ),
                ),
                array(
                    'fullName'    => 'Woody Allen',
                    'image'       => array(
                        'path'      => '//html.festival-cannes-2016.com.ohwee.fr/img/films/image-invitespecial2.jpg',
                        'copyright' => '© Lorem ipsum.'
                    ),
                    'description' => 'A l\'âge de seize ans, Woody Allen envoie des histoires drôles à différents
                                      chroniqueurs de journaux. Après avoir écrit des sketches pour la télévision et
                                      d\'innombrables chroniques pour des magazines comme Playboy, il décide en 1961 de
                                      monter sur les planches. Il arpente ainsi les cabarets et les plateaux de
                                      télévision.',
                    'film'        => array(
                        'title'    => 'Minuits à Paris',
                        'duration' => '1h45',
                        'date'     => '2011'
                    ),
                    'widgets'     => array(
                        array(
                            'type'    => 'movie_widget_text',
                            'content' => 'Présenté par KG Productions avec le soutien du CNC. Négatif original numérisé
                                          en 4K et restauré image par image en 2K par Eclair Group et par LE Diapason
                                          pour le son. Restauration et étalonnage supervisés par Costa-Gavras.'
                        ),
                        array(
                            'type'     => 'movie_widget_info',
                            'title'    => 'Z',
                            'duration' => '1h58',
                            'date'     => '1968'
                        ),
                        array(
                            'type'    => 'movie_widget_text',
                            'content' => 'Présenté par KG Productions avec le soutien du CNC. Négatif original numérisé
                                          en 4K et restauré image par image en 2K par Eclair Group et par LE Diapason
                                          pour le son. Restauration et étalonnage supervisés par Costa-Gavras.'
                        ),
                        array(
                            'type'        => 'movie_widget_trailer',
                            'description' => "Redécouvrez la bande-annonce du film lors de sa sortie en salles:",
                            'image'       => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-invitespecial2.jpg'
                            )
                        ),
                        array(
                            'type'      => 'movie_widget_audio',
                            'title'     => 'The lobster',
                            'sound'     => 'mp3',
                            'createdAt' => new DateTime(),
                            'theme'     => 'Cinéma de la plage',
                            'image'     => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg'
                            ),
                            'akamaiId'  => 'DAaDo5fgcUc'
                        ),
                        array(
                            'type'    => 'movie_widget_quote',
                            'content' => 'J’ai découvert que Lambert avait une passion pour le film de genre',

                        ),
                        array(
                            'type'      => 'movie_widget_image',
                            'copyright' => "Équipe du film - Photocall - The Lobster",
                            'photos'    => array(
                                array(
                                    'id'        => 0,
                                    'image'     => array(
                                        'path'  => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme'     => 'Lorem Ipsum',
                                    'title'     => 'lorem ipsum',
                                    'caption'   => 'lorem ipsum',
                                    'alt'       => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                ),
                                array(
                                    'id'        => 0,
                                    'image'     => array(
                                        'path'  => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme'     => 'Lorem Ipsum',
                                    'title'     => 'lorem ipsum',
                                    'caption'   => 'lorem ipsum',
                                    'alt'       => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                ),
                                array(
                                    'id'        => 0,
                                    'image'     => array(
                                        'path'  => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme'     => 'Lorem Ipsum',
                                    'title'     => 'lorem ipsum',
                                    'caption'   => 'lorem ipsum',
                                    'alt'       => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                ),
                                array(
                                    'id'        => 0,
                                    'image'     => array(
                                        'path'  => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme'     => 'Lorem Ipsum',
                                    'title'     => 'lorem ipsum',
                                    'caption'   => 'lorem ipsum',
                                    'alt'       => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                ),
                                array(
                                    'id'        => 0,
                                    'image'     => array(
                                        'path'  => '//html.festival-cannes-2016.com.ohwee.fr/img/slide001.jpg',
                                        'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/thumb01.jpg'
                                    ),
                                    'createdAt' => new DateTime(),
                                    'theme'     => 'Lorem Ipsum',
                                    'title'     => 'lorem ipsum',
                                    'caption'   => 'lorem ipsum',
                                    'alt'       => 'lorem ipsum',
                                    'copyright' => 'Copyright'
                                )
                            )
                        ),
                        array(
                            'type'   => 'image_dual_align',
                            'photos' => array(
                                array(
                                    'path'      => '//html.festival-cannes-2016.com.ohwee.fr/img/article/005.jpg',
                                    'title'     => 'lorem ipsum',
                                    'alt'       => 'lorem ipsum',
                                    'copyright' => 'VALERY HACHE / AFP'
                                ),
                                array(
                                    'path'      => '//html.festival-cannes-2016.com.ohwee.fr/img/article/005.jpg',
                                    'title'     => 'lorem ipsum',
                                    'alt'       => 'lorem ipsum',
                                    'copyright' => 'VALERY HACHE / AFP'
                                )
                            )
                        ),
                    )
                )
            ),
            'sections' => array(
                array(
                    'title'       => 'Centenaire Orson Welles',
                    'description' => '',
                    'film'        => array(
                        array(
                            'title'       => 'Citizen Kane',
                            'date'        => '1941',
                            'duration'    => '1h59',
                            'author'      => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image'       => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.<br>
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title'       => 'Citizen Kane',
                            'date'        => '1941',
                            'duration'    => '1h59',
                            'author'      => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image'       => array(
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
                    'title'       => 'Hommage a Manoel De Oliveira',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente voluptatibus
                                      magnam culpa, ut quam est repellendus aliquam ipsum eos debitis. Lorem ipsum
                                      dolor sit amet, consectetur adipisicing elit. Repellendus consequuntur esse
                                      doloremque qui sunt vel voluptatem repudiandae eaque aliquid architecto.',
                    'film'        => array(
                        array(
                            'title'       => 'Visita',
                            'date'        => '1982',
                            'duration'    => '1h08',
                            'author'      => array(
                                'fullName' => 'Manoel De Oliveira'
                            ),
                            'image'       => array(
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
                'slug'  => 'copies-restaurees',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-bandeau-push.jpg'
                )
            ),
            'sections' => array(
                array(
                    'title'       => 'Centenaire Orson Welles',
                    'description' => '',
                    'film'        => array(
                        array(
                            'title'       => 'Citizen Kane',
                            'date'        => '1941',
                            'duration'    => '1h59',
                            'author'      => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image'       => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.<br>
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title'       => 'Citizen Kane',
                            'date'        => '1941',
                            'duration'    => '1h59',
                            'author'      => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image'       => array(
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
                    'title'       => 'Hommage a Manoel De Oliveira',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente voluptatibus
                                      magnam culpa, ut quam est repellendus aliquam ipsum eos debitis. Lorem ipsum
                                      dolor sit amet, consectetur adipisicing elit. Repellendus consequuntur esse
                                      doloremque qui sunt vel voluptatem repudiandae eaque aliquid architecto.',
                    'film'        => array(
                        array(
                            'title'       => 'Visita',
                            'date'        => '1982',
                            'duration'    => '1h08',
                            'author'      => array(
                                'fullName' => 'Manoel De Oliveira'
                            ),
                            'image'       => array(
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
                'slug'  => 'world-cinema',
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-bandeau-push.jpg'
                )
            ),
            'sections' => array(
                array(
                    'film' => array(
                        array(
                            'title'       => 'Citizen Kane',
                            'date'        => '1941',
                            'duration'    => '1h59',
                            'author'      => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image'       => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.<br>
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title'       => 'Citizen Kane',
                            'date'        => '1941',
                            'duration'    => '1h59',
                            'author'      => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image'       => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title'       => 'Citizen Kane',
                            'date'        => '1941',
                            'duration'    => '1h59',
                            'author'      => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image'       => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film1.jpg'
                            ),
                            'description' => 'Une présentation de Warner Bros. Restauration 4k réalisé chez Warner Bros.
                                          Motion Picture Imagery par l\'étalonneuse Janet Wilson, sous la supervision
                                          de Ned Price. Le négatif original n\'existant plus, image reconstituée
                                          d\'après trois interpositifs noirs et blancs à grain fin support nitrate.
                                          Son optique " RCA squeeze duplex format. "'
                        ),
                        array(
                            'title'       => 'Citizen Kane',
                            'date'        => '1941',
                            'duration'    => '1h59',
                            'author'      => array(
                                'fullName' => 'Orson Welles'
                            ),
                            'image'       => array(
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
            'film'        => array(
                array(
                    'title'          => 'Le grand blond avec une chaussure noire',
                    'author'         => array(
                        'fullName' => 'Yves ROBERT'
                    ),
                    'releaseDate'    => new \DateTime(),
                    'projectionDate' => new \DateTime(),
                    'duration'       => '1h30',
                    'description'    => 'Restauration 2K présentée par Gaumont. Travaux image effectués par Eclair,
                                      son restauré par Diapason en partenariat avec Eclair.',
                    'image'          => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film_cdp1.jpg'
                    )
                ),
                array(
                    'title'          => 'Le grand blond avec une chaussure noire',
                    'author'         => array(
                        'fullName' => 'Yves ROBERT'
                    ),
                    'releaseDate'    => new \DateTime(),
                    'projectionDate' => new \DateTime(),
                    'duration'       => '1h30',
                    'description'    => 'Restauration 2K présentée par Gaumont. Travaux image effectués par Eclair,
                                      son restauré par Diapason en partenariat avec Eclair.',
                    'image'          => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/films/cover-film_cdp1.jpg'
                    )
                ),
                array(
                    'title'          => 'Le grand blond avec une chaussure noire',
                    'author'         => array(
                        'fullName' => 'Yves ROBERT'
                    ),
                    'releaseDate'    => new \DateTime(),
                    'projectionDate' => new \DateTime(),
                    'duration'       => '1h30',
                    'description'    => 'Restauration 2K présentée par Gaumont. Travaux image effectués par Eclair,
                                      son restauré par Diapason en partenariat avec Eclair.',
                    'image'          => array(
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
