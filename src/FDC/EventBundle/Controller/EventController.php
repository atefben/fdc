<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class EventController extends Controller
{

    /**
     * @Route("/event/{slug}")
     * @Template("FDCEventBundle:Event:page.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction($slug)
    {

        $event = array(
            'id'    => 0,
            'theme' => 'Leçon de cinéma',
            'createdAt' => new \Datetime(),
            'updatedAt' => new \Datetime(),
            'title' => "Marco Bellocchio",
            'prev' => array(
                'slug' => 'test'
            ),
            'next' => array(
                'slug' => 'test'
            ),
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
                    'title' => 'Revivez la Leçon de Cinéma de Marco Bellochio en photos',
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
                    'content' => '<p class="text-quote">“…Une leçon de cinéma n’a de sens, à mes yeux, que si elle est
                                  pratique, le travail sur le plateau, les prises, diriger l’équipe, les acteurs,
                                  commander, fais ceci, fais cela... Sur le plateau, la démocratie, l’égalité n’existent
                                  pas, il faut de la rigueur, de l’intérêt, de l’affection, du respect... Je ne crois pas
                                  en ces réalisateurs qui, pour faire pleurer, pensent être en droit de gifler une belle
                                  fille ou de l’insulter, etc. (on raconte souvent l’histoire de ce réalisateur de la fin
                                  du néo-réalisme qui, pour faire pleurer une toute jeune actrice, la frappait sur les
                                  jambes avec une cravache tandis qu’il la filmait en gros plan.)… Mais dans la mesure
                                  où je ne peux ici apporter qu’un témoignage oral, je dis que la chose la plus précieuse
                                  qu’un réalisateur puisse enseigner à ceux qui veulent faire ce métier (un métier, entre
                                  autres, extrêmement compliqué et je suis toujours étonné qu’il séduise tant de jeunes)
                                  c’est le travail avec les acteurs et les actrices… Parce que ce n’est pas la même chose
                                  de diriger un acteur ou une actrice lorsqu’il y a nécessité de convaincre, de “séduire”
                                  (et la “séduction” uniquement “artistique” d’une actrice est totalement différente de la
                                  “séduction” d’un acteur), voire d’être “séduits”, ce qui ne signifie pas nécessairement
                                  être fragiles ou passifs… Tout le monde peut enseigner la technique mais la manière de
                                  faire interpréter un personnage que vous avez imaginé par un être humain vivant est un
                                  don de la nature. On peut toutefois l’apprendre, en partie, d’un metteur en scène qui ne
                                  se soustrait pas au risque d’un échec… Il est impossible de garantir une jolie fin à
                                  toute relation humaine…”</p>
                                  <p class="paragraph">Marco Bellocchio, après des études d’art dramatique et de cinéma,
                                  réalise en 1965 un premier long métrage remarqué par la critique. Ses oeuvres engagées
                                  dénoncent les symboles du conformisme italien : après le film culte <a href="#"
                                  title="les poings dans les poches">Les Poings dans les poches </a>( 1966),
                                  manifeste d’une jeunesse en révolte, il dénonce la religion dans <a href="#"
                                  title="au nom du père">Au nom du père</a> (1971) ou l’armée dans <a href="#"
                                  alt="La marche trimphale">La Marche triomphale </a>(1976). Avec Michel Piccoli et
                                  Anouk Aimée, il remporte à Cannes deux prix d’interprétation pour <a href="#"
                                  title="Le saut dans le vide">Le Saut dans le vide</a> (1980).</p><p class="paragraph">
                                  Il réalise aussi des adaptations littéraires, comme Diable au corps qui fait scandale
                                  à Cannes en 1986, ou <a href="#" title="La nourrice">La Nourrice</a> (1990) d’après
                                  Pirandello. Marco Bellocchio dérange à nouveau le Vatican avec <a href="#"
                                  title="Le Sourire de ma mère">Le Sourire de ma mère</a> (Compétition Festival de
                                  Cannes - 2002). Il sera le premier à évoquer l’activisme des brigades rouges dans
                                  Buongiorno, notte présenté à la Mostra en 2004. En 2009, il présente Vincere en
                                  Compétition à Cannes, salué par la critique internationale.</p>'
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
                    'title' => 'Revivez la Leçon de Cinéma de Marco Bellocchio en audio',
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
                    ),
                ),
            )
        );

        return array(
            'article' => $event
        );
    }


    /**
     * @Route("/events")
     * @Template("FDCEventBundle:Event:list.html.twig")
     * @return array
     */
    public function getEventsAction()
    {
        $filters = array(
            'dates' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Toutes',
                ),
                array(
                    'slug' => 'date1',
                    'content' => 'Date 1',
                ),
                array(
                    'slug' => 'date2',
                    'content' => 'Date 2',
                ),
                array(
                    'slug' => 'date3',
                    'content' => 'Date 3',
                ),
                array(
                    'slug' => 'date4',
                    'content' => 'Date 4',
                ),
                array(
                    'slug' => 'date5',
                    'content' => 'Date 5',
                ),
                array(
                    'slug' => 'date6',
                    'content' => 'Date 6',
                ),
            ),
            'themes' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Tous',
                ),
                array(
                    'slug' => 'theme1',
                    'content' => 'Conférence de presse',
                ),
                array(
                    'slug' => 'theme2',
                    'content' => 'Montée des marches',
                ),
            )
        );

        $events = array(
            array(
                'slug' => 'rendez-vous-europeens',
                'theme' => 'Rendez-Vous Européen',
                'title' => 'Rendez-vous Européen',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'slug' => 'rendez-vous-europeens',
                'theme' => 'Rendez-Vous Européen',
                'title' => 'Rendez-vous Européen',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'filter' => array(
                    'date' => 'date3',
                    'theme' => 'theme',
                )
            ),
            array(
                'slug' => 'enrages-polar',
                'theme' => 'Expositions',
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'filter' => array(
                    'date' => 'date4',
                    'theme' => 'theme2',
                )
            ),
            array(
                'slug' => 'enrages-polar',
                'theme' => 'Expositions',
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'all',
                )
            ),
            array(
                'slug' => 'enrages-polar',
                'theme' => 'Expositions',
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'filter' => array(
                    'date' => 'date2',
                    'theme' => 'theme1',
                )
            ),
            array(
                'slug' => 'enrages-polar',
                'theme' => 'Expositions',
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'filter' => array(
                    'date' => 'date1',
                    'theme' => 'theme1',
                )
            ),
            array(
                'slug' => 'enrages-polar',
                'theme' => 'Expositions',
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => 'img.jpg'
                ),
                'filter' => array(
                    'date' => 'date5',
                    'theme' => 'theme2',
                )
            )
        );

        return array(
            'events' => $events,
            'filters' => $filters,
        );
    }
}
