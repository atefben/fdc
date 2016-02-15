<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FDC\PressBundle\Form\Type\LockedContentType;

class MediaController extends Controller
{
    /**
     * @Route("/media")
     * @Template("FDCPressBundle:Media:main.html.twig")
     * @return array
     */
    public function mainAction( )
    {
        $headerInfo = array(
            'title' => 'Médiathèque films',
            'description' => 'Vous trouverez ci-dessous les dossiers de presse, photos, et bandes annonces pour
                              faciliter le traitement des films sur vos propres médias.'
        );

        $movieDownload = array(
            'description' => 'Le Festival de Cannes met à disposition de la presse accréditée les bandes-annonces et
                                  extraits de films fournis par les productions. Ces contenus sont mis à jour tout au
                                  long du Festival. Ce service est fourni pour faciliter le traitement des films sur
                                  vos propres médias. Nous vous prions instamment de ne pas les publier sur les réseaux
                                  sociaux ou les portails de partage de type Youtube ou Dailymotion sans l’accord des
                                  ayants-droits du film.<br><strong>Chaque fois que possible, les fichiers mis à disposition
                                  seront en HD 1080p. Le Festival reste tributaire de la qualité du matériel qui lui est
                                  adressé. 1 à 3 fichiers sont mis à disposition en fonction du fichier source reçu :</strong>',
            'movie' => array(
                'title' => 'Il racconto dei racconti',
                'author' => array(
                    'fullName' => 'Matteo GARRONE'
                ),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img6.jpg'
                ),
                'trailers' => array(
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    )
                )
            ),
        );

        $mediaSection = array(
            'section' => array(
                array(
                    'title' => 'Compétition longs métrages',
                    'slug' => 'long-metrage',
                    'film' => array(
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                    )
                ),
                array(
                    'title' => 'Compétition courts métrages',
                    'slug' => 'courts-metrage',
                    'film' => array(
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                    )
                ),
                array(
                    'title' => 'Hors compétition',
                    'slug' => 'hors-competition',
                    'film' => array(
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                    )
                ),
                array(
                    'title' => 'Séance de minuit',
                    'slug' => 'seance-minuit',
                    'film' => array(
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                    )
                ),
                array(
                    'title' => 'Cinéfondation',
                    'slug' => 'cinefondation',
                    'film' => array(
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                    )
                ),
                array(
                    'title' => 'Cannes Classics',
                    'slug' => 'cannes-classics',
                    'film' => array(
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                    )
                ),
                array(
                    'title' => 'Cinéma de la plage',
                    'slug' => 'cinema-plage',
                    'film' => array(
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                        array(
                            'title' => 'Carol',
                            'author' => array(
                                'fullName' => 'Todd HAYNES'
                            ),
                            'image' => array(
                                'path' => '//dummyimage.com/55x75/000/fff'
                            ),
                            'medias' => array(
                                'press' => array(
                                    array(
                                        'title' => 'En Francais',
                                        'link' => '#',
                                        'titleEN' => 'En Anglais',
                                        'linkEN' => '#'
                                    ),
                                ),
                                'trailer' => array(
                                    array(
                                        'title' => 'Extrait 1',
                                        'titleEN' => 'Extrait 1',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                    array(
                                        'title' => 'Extrait 2',
                                        'titleEN' => 'Extrait 2',
                                        'link' => '#',
                                        'linkEN' => '#',
                                    ),
                                ),
                                'photo' => array(
                                    'globalLink' => '#',
                                    'image' => array(
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        ),
                                        array(
                                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                                            'caption' => '<strong>Équipe du film - Photocall - The Lobster</strong> © FDC / Théophile Delange',
                                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima',
                                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img-large.jpg'
                                        )
                                    ),
                                )
                            )
                        ),
                    )
                ),
            )
        );

        return array(
            'headerInfo' => $headerInfo,
            'mediaSection' => $mediaSection,
            'pressMovieDownloads' => $movieDownload
        );
    }

    /**
     * @Route("/download")
     * @Template("FDCPressBundle:Media:download.html.twig")
     * @return array
     */
    public function downloadAction()
    {
        $headerInfo = array(
            'title' => 'À télécharger',
            'description' => 'Ces élements visuels sont à usage exclusif de la presse et des médias qui couvrent
                              le Festival de Cannes. Aucune utilisation commerciale ou promotionnelle de ces visuels
                              n’est autorisée.'
        );

        $movieDownload = array(
            'description' => 'Le Festival de Cannes met à disposition de la presse accréditée les bandes-annonces et
                                  extraits de films fournis par les productions. Ces contenus sont mis à jour tout au
                                  long du Festival. Ce service est fourni pour faciliter le traitement des films sur
                                  vos propres médias. Nous vous prions instamment de ne pas les publier sur les réseaux
                                  sociaux ou les portails de partage de type Youtube ou Dailymotion sans l’accord des
                                  ayants-droits du film.<br><strong>Chaque fois que possible, les fichiers mis à disposition
                                  seront en HD 1080p. Le Festival reste tributaire de la qualité du matériel qui lui est
                                  adressé. 1 à 3 fichiers sont mis à disposition en fonction du fichier source reçu :</strong>',
            'movie' => array(
                'title' => 'Il racconto dei racconti',
                'author' => array(
                    'fullName' => 'Matteo GARRONE'
                ),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img6.jpg'
                ),
                'trailers' => array(
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    )
                )
            ),
        );

        $download = array(
            'section' => array(
                array(
                    'title' => 'Affiche Officielle',
                    'slug'  => 'affiche-officielle',
                    'poster' => array(
                        array(
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/press-portrait.jpg',
                                'caption' => '© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of
                                              David Seymour - Magnum Photos',
                            ),
                            'format' => array(
                                'name' => 'Format Portrait',
                                'slug' => 'portrait',
                                'info' => array(
                                    array(
                                        'title' => 'JPG 72 DPI',
                                        'link'  => '#'
                                    ),
                                    array(
                                        'title' => 'JPG 300 DPI',
                                        'link'  => '#'
                                    )
                                )
                            )
                        ),
                        array(
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/press-landscape.jpg',
                                'caption' => '© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of
                                              David Seymour - Magnum Photos',
                            ),
                            'format' => array(
                                'name' => 'Format Paysage',
                                'slug' => 'landscape',
                                'info' => array(
                                    array(
                                        'title' => 'JPG 72 DPI',
                                        'link'  => '#'
                                    ),
                                    array(
                                        'title' => 'JPG 300 DPI',
                                        'link'  => '#'
                                    )
                                )
                            )
                        )
                    )
                ),
                array(
                    'title' => 'Signatures',
                    'slug'  => 'signature',
                    'signature' => array(
                        array(
                            'title' => 'Signature blanche',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/img1.png',
                                'caption' => '© FDC / Théophile Delange',
                            ),
                            'info' => array(
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                )
                            ),
                            'link' => '#'
                        ),
                        array(
                            'title' => 'Signature bleu',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/image2.png',
                                'caption' => '© FDC / Théophile Delange',
                            ),
                            'info' => array(
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                )
                            ),
                            'link' => '#'
                        ),
                        array(
                            'title' => 'Signature bleu #00427C',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/img3.png',
                                'caption' => '© FDC / Théophile Delange',
                            ),
                            'info' => array(
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                ),
                                array(
                                    'content' => 'Bannière carrée 400x400 px'
                                )
                            ),
                            'link' => '#'

                        ),
                    )
                ),
                array(
                    'title' => 'Animation',
                    'slug'  => 'animation',
                    'video' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/player.jpg',
                        'caption' => '© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of
                                      David Seymour - Magnum Photos<br>Film d\'animation avec la collaboration de Sonia
                                      Tout Court sur un remix du thème musical du Festival, Le Carnaval des animaux de
                                      Camille Saint-Saëns, avec un arrangement imaginé par deux musiciens suédois,
                                      Patrik Andersson et Andreas Söderström.',
                        'format' => array(
                            array(
                                'name' => '.MOV',
                                'slug' => 'mov',
                                'link' => '#',
                            ),
                            array(
                                'name' => '.GIF',
                                'slug' => 'gif',
                                'link' => '#',
                            ),
                        )
                    )
                ),
                array(
                    'title' => 'Photos Institutionnelles',
                    'slug' => 'photos-institutionnelles',
                    'link' => '#',
                    'photo' => array(
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/im-grid.jpg',
                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/img-large.jpg',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.',
                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/im-grid.jpg',
                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/img-large.jpg',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.',
                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/im-grid.jpg',
                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/img-large.jpg',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.',
                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/im-grid.jpg',
                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/img-large.jpg',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.',
                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/im-grid.jpg',
                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/img-large.jpg',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.',
                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                        ),
                        array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/im-grid.jpg',
                            'large' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/downloading/img-large.jpg',
                            'thumb' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img2.jpg',
                            'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, minima.',
                            'credit' => 'Crédit Image : VALERY HACHE / AFP',
                        ),
                    )
                ),
                array(
                    'title' => 'Dossier de presse',
                    'slug' => 'dossier-presse',
                    'category' => array(
                        array(
                            'updatedAt' => new \DateTime(),
                            'file' => array(
                                array(
                                'title' => 'Dossier de presse',
                                'link' => '#',
                                )
                            )
                        ),
                        array(
                            'updatedAt' => new \DateTime(),
                            'file' => array(
                                array(
                                    'title' => 'Liste des attachés de presse',
                                    'link' => '#',
                                )
                            )
                        ),
                        array(
                            'updatedAt' => new \DateTime(),
                            'file' => array(
                                array(
                                    'title' => 'Horaire des projections (presse)',
                                    'link' => '#',
                                ),
                                array(
                                    'title' => 'Horaire des projections (grand public)',
                                    'link' => '#',
                                ),
                            )
                        ),
                    )
                )
            )
        );

        return array(
            'headerInfo' => $headerInfo,
            'pressDownloads' => $download,
            'pressMovieDownloads' => $movieDownload
        );
    }


}
