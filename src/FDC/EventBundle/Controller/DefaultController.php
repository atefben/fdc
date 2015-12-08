<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {

//        $mainNav = array(
//            array(
//                'href' => '/',
//                'title' => 'Festival 2016'
//            ),
//            array(
//                'href' => 'http://www.festival-cannes.com/fr.html',
//                'title' => 'Festival de Cannes'
//            ),
//            array(
//                'href' => 'http://www.cinefondation.com/fr/',
//                'title' => 'Cinéfondation'
//            ),
//            array(
//                'href' => 'http://www.cannescourtmetrage.com/fr/',
//                'title' => 'Cannes Court Métrage'
//            ),
//            array(
//                'href' => 'http://www.marchedufilm.com/fr/',
//                'title' => 'Marché du film'
//            )
//        );
//        $userNav = array(
//            array(
//                'href' => '#',
//                'title' => 'Ma Sélection'
//            ),
//            array(
//                'href' => 'http://sub.festival-cannes.fr/',
//                'title' => '>Mon compte'
//            )
//        );
        $langNav = array(
            array(
                'current' => true,
                'iso' => 'FR'
            ),
            array(
                'current' => false,
                'iso' => 'EN'
            ),
            array(
                'current' => false,
                'iso' => 'ES'
            ),
            array(
                'current' => false,
                'iso' => 'ZH'
            ),
        );

        return array(
            'langNav' => $langNav
            );

    }
}
