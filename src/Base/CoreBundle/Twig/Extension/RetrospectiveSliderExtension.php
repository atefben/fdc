<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * PublicationDateExtension class.
 *
 * @extends Twig_Extension
 * @author  Stevens-Son ONEPHANDARA
 * @company Ohwee
 */
class RetrospectiveSliderExtension extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('change_year', array($this, 'changeYear')),
        );
    }

    public function changeYear($routeParams, $value)
    {
        $routeParams['year'] = $routeParams['year'] + $value;

        return $routeParams;
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'retrospective_slider_extension';
    }
}