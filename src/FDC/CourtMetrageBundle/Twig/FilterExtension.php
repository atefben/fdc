<?php

namespace FDC\CourtMetrageBundle\Twig;

class FilterExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('shorten', array($this, 'shorten')),
        );
    }

    /**
     * Replaces strings end with the given characters($end)
     *
     * @param $string
     * @param $maxLength
     * @param $end
     * @return string
     */
    public function shorten($string, $maxLength, $end = '...')
    {
        if (strlen($string) > $maxLength) {
            $text = substr($string, 0, $maxLength - strlen($end));
            
            return $text . $end;
        }

        return $string;
    }

    public function getName()
    {
        return 'filter_extension';
    }
}