<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * FestivalDateExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class FestivalDateExtension extends Twig_Extension
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('festival_date', array($this, 'getFestivalDate')),
        );
    }

    public function getFestivalDate()
    {
        $settings = $this->em->getRepository('BaseCoreBundle:Settings')->getFestivalDate();

        if (count($settings) == 1) {
            $settings = $settings[0];
        }

        return $settings;
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'festival_date_extension';
    }
}