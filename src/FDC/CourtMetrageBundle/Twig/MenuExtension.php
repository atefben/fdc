<?php

namespace FDC\CourtMetrageBundle\Twig;


use Symfony\Component\Routing\Router;

class MenuExtension extends \Twig_Extension
{
    private $participateRoutes = array(
        'fdc_court_metrage_register_movie' => 'Register movie page',
        'fdc_court_metrage_participer_page' => 'Participer page',
    );

    /**
     * @var Router
     */
    private $router;

    private $ccmDomain;

    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function setCcmDomain($domain)
    {
        $this->ccmDomain = $domain;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('isParticipate', array($this, 'isParticipate')),
            new \Twig_SimpleFunction('isValidMenuElement', array($this, 'isValidMenuElement')),
        );
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('routeFromURL', array($this, 'getRouteNameFromURL'))
        ];
    }

    public function isParticipate($route)
    {
        if (isset($this->participateRoutes[$route])) {

            return true;
        }

        return false;
    }

    public function isValidMenuElement($route)
    {
        //check if external link
        if (!(false === filter_var($route, FILTER_VALIDATE_URL))) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getRouteNameFromURL($url)
    {
        $routeName = null;

        if (parse_url($url, PHP_URL_HOST) == $this->ccmDomain) {
            try {
                $routeData = $this->router->match(parse_url($url, PHP_URL_PATH));
                if (isset($routeData['_route'])) {
                    $routeName = $routeData['_route'];
                }
            } catch (\Exception $e) {
            }
        }

        
        return $routeName;
    }

    public function getName()
    {
        return 'menu_extension';
    }
}