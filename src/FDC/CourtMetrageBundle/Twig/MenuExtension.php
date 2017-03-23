<?php

namespace FDC\CourtMetrageBundle\Twig;


use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;

class MenuExtension extends \Twig_Extension
{
    private $participateRoutes = array(
        'fdc_court_metrage_register_movie' => 'Register movie page',
        'fdc_court_metrage_participer_page' => 'Participer page',
    );
    
    private $sfcRoutes = array(
        'fdc_court_metrage_sfc_who_are_we' => 'Qui Sommes-Nous page',
        'fdc_court_metrage_sfc_our_events' => 'Nos évènements page',
        'fdc_court_metrage_sfc_relive_edition' => 'Revivez l’édition page',
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
            new \Twig_SimpleFunction('isSFC', array($this, 'isSFC')),
            new \Twig_SimpleFunction('isValidMenuElement', array($this, 'isValidMenuElement')),
            new \Twig_SimpleFunction('hasEqualURI', array($this, 'hasEqualURI')),
        );
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('routeFromURL', array($this, 'getRouteNameFromURL')),
            new \Twig_SimpleFilter('equalRouteParams', array($this, 'equalRouteParams'))
        ];
    }

    public function isParticipate($route)
    {
        if (isset($this->participateRoutes[$route])) {

            return true;
        }

        return false;
    }

    public function isSFC($route)
    {
        if (isset($this->sfcRoutes[$route])) {

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
    
    public function getRouteNameFromURL($relativePath)
    {
        /** @var RequestContext $context */
        $context = $this->router->getContext();
        if (strpos($relativePath, $context->getScheme()) === false) {
            $url = $context->getScheme() . '://' . $context->getHost() . $relativePath;
        } else {
            $url = $relativePath;
        }

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
    
    public function equalRouteParams($relativePath, $routeParams)
    {
        /** @var RequestContext $context */
        $context = $this->router->getContext();
        $sameParams = false;

        if (strpos($relativePath, $context->getScheme()) === false) {
            $url = $context->getScheme() . '://' . $context->getHost() . $relativePath;
        } else {
            $url = $relativePath;
        }

        try {
            $routeData = $this->router->match(parse_url($url, PHP_URL_PATH));
            unset($routeData['_controller']);
            unset($routeData['_route']);

            return $routeData == $routeParams;
        } catch (\Exception $e) {
        }

        return $sameParams;
    }

    public function getName()
    {
        return 'menu_extension';
    }
}