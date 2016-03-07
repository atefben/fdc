<?php

namespace FDC\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class PalmaresController extends Controller
{
    /**
     * @Route("/palmares/{section}")
     * @Template("")
     * @param section
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Request $request, $section)
    {
        $this->isPageEnabled($request->get('_route'));
        $movies = array();
        $locale   = $request->getLocale();
        $em = $this->getDoctrine()->getManager();

        // check if waiting page is enabled
        $waitingPage = $em->getRepository('BaseCoreBundle:FDCPageWaiting')->findBy(array('enabled' => true));
        foreach($waitingPage as $waiting) {
            if($waiting->getPage()->getRoute() == $request->get('_route')){
                return $this->render('FDCEventBundle:Global:waiting-page.html.twig',array(
                    'waitingPage' => $waiting
                ));
            }
        }

        //Exemple de films pour les différentes section (sauf cameré d'or)
        $allMovies = array(
            array(
                'type' => 0,//Longs métrages
                'title' => 'DHEEPAN',
                'author' => 'Jacques Audiard',
                'price' => 'Palme d\'or',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            ),
            array(
                'type' => 0,
                'title' => 'DHEEPAN',
                'author' => 'Jacques Audiard',
                'price' => 'Grand prix',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            ),
            array(
                'type' => 1,//Courts métrages
                'title' => 'DHEEPAN',
                'author' => 'Jacques Audiard',
                'price' => 'Prix de la mise en scène',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            ),
            array(
                'type' => 1,
                'title' => 'DHEEPAN',
                'author' => 'Jacques Audiard',
                'price' => 'Palme d\'or',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            ),
            array(
                'type' => 2,//UN CERTAIN REGARD
                'title' => 'DHEEPAN',
                'author' => 'Jacques Audiard',
                'price' => 'Palme d\'or métrage',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            ),
            array(
                'type' => 2,
                'title' => 'DHEEPAN',
                'author' => 'Jacques Audiard',
                'price' => 'Prix un certain regard',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            )

        );

        // Exemple de films pour camera d'or
        $advancedMovie = array(
            array(
                'type' => 0, //Camera d'or
                'title' => 'DHEEPAN',
                'status' => 'En compétition',
                'author' => 'Jacques Audiard',
                'price' => 'Palme d\'or',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            ),
            array(
                'type' => 1, //EN COMPÉTITION
                'title' => 'DHEEPAN',
                'author' => 'Jacques Audiard',
                'price' => 'Palme d\'or',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            ),
            array(
                'type' => 2, //UN CERTAIN REGARD
                'title' => 'DHEEPAN',
                'author' => 'Jacques Audiard',
                'price' => 'Palme d\'or',
                'thumbnail' => 'img.jpg',
                'img' => 'img.jpg'
            ),
        );


        switch ($section) {
            case 'competition':
                $section = array(
                    'type' => 'classic',
                    'banner' => 'img.jpg',
                    'bottom_img' => 'img.jpg',
                    'bottom_title' => 'Cannes Classic',
                    'bottom_link' => '/test',
                    'bottom_btn'  => 'Découvrir la rubrique'
                );
                $movies = $allMovies;
                break;
            case 'certain-regard':
                $section = array(
                    'type' => 'simple',
                    'banner' => 'img.jpg',
                    'bottom_img' => 'img.jpg',
                    'bottom_title' => 'Cannes Classic',
                    'bottom_link' => '/test',
                    'bottom_btn'  => 'Découvrir la rubrique'
                );
                $movies = $allMovies;
                break;
            case 'cinefondation':
                $section = array(
                    'type' => 'simple',
                    'banner' => 'img.jpg',
                    'bottom_img' => 'img.jpg',
                    'bottom_title' => 'Cannes Classic',
                    'bottom_link' => '/test',
                    'bottom_btn'  => 'Découvrir la rubrique'
                );
                $movies = $allMovies;
                break;
            case 'camera-dor':
                $section = array(
                    'type' => 'advanced',
                    'banner' => 'img.jpg',
                    'description' => 'Fondée en 1978, la Caméra d\'or consacre chaque année le meilleur premier film
                                      issu de la Sélection officielle, de La <strong>Semaine de la Critique</strong> et
                                      de la <strong>Quinzaine des Réalisateurs</strong>. En 2015, ils sont 26 à
                                      concourir pour cette récompense qui sera remise lors de la soirée du Palmarès le
                                      dimanche 24 mai. La Présidente est l\'actrice française Sabine Azéma.',
                    'bottom_img' => 'img.jpg',
                    'bottom_title' => 'Cannes Classic',
                    'bottom_link' => '/test',
                    'bottom_btn'  => 'Découvrir la rubrique'
                );
                $movies = $advancedMovie;
                break;
            case 'tout-palmares':
                $section = array(
                    'type' => 'all',
                    'banner' => 'img.jpg',
                    'bottom_img' => 'img.jpg',
                    'bottom_title' => 'Cannes Classic',
                    'bottom_link' => '/test',
                    'bottom_btn'  => 'Découvrir la rubrique'
                );
                $movies = $allMovies;
                break;
        }

        return $this->render(
            'FDCEventBundle:Palmares:'.$section["type"].'.html.twig',
            array(
                'section' => $section,
                'movies' => $movies
        ));

    }
}
