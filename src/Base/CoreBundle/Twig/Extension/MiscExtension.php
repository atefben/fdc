<?php

namespace Base\CoreBundle\Twig\Extension;

use Behat\Transliterator\Transliterator;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use \Twig_Extension;

/**
 * Class MiscExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class MiscExtension extends Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('urlize', array($this, 'urlize')),
        );
    }

    public function urlize($text)
    {
        return Transliterator::urlize($text);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'misc_extension';
    }
}