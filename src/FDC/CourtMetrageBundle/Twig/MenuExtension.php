<?php

namespace FDC\CourtMetrageBundle\Twig;

class MenuExtension extends \Twig_Extension
{
    private $participateRoutes = array(
        'fdc_court_metrage_register_movie' => 'Register movie page',
        'fdc_court_metrage_participer_page' => 'Participer page',
    );
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('isParticipate', array($this, 'isParticipate')),
        );
    }

    public function isParticipate($route)
    {
        if (isset($this->participateRoutes[$route])) {

            return true;
        }

        return false;
    }

    public function getName()
    {
        return 'menu_extension';
    }
}