<?php

namespace FDC\CourtMetrageBundle\Twig;

use JMS\I18nRoutingBundle\Router\I18nLoader;

class MenuExtension extends \Twig_Extension
{
    private $participateRoutes = array(
        'fdc_court_metrage_register_movie' => 'Register movie page',
        'fdc_court_metrage_participer_page' => 'Participer page',
    );

    private $router;

    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('isParticipate', array($this, 'isParticipate')),
            new \Twig_SimpleFunction('isValidMenuElement', array($this, 'isValidMenuElement')),
        );
    }

    public function isParticipate($route)
    {
        if (isset($this->participateRoutes[$route])) {

            return true;
        }

        return false;
    }

    public function isValidMenuElement($route, $locale)
    {
        //check if external link
        if (!(false === filter_var($route, FILTER_VALIDATE_URL))) {
            return true;
        }

        //check if localized route name exists in project's route collection
        return (null === $this->router->getRouteCollection()->get($locale . I18nLoader::ROUTING_PREFIX . $route)) ? false : true;
    }

    public function getName()
    {
        return 'menu_extension';
    }
}