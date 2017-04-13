<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * GetClassExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class GetClassExtension extends \Twig_Extension
{

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'class' => new \Twig_SimpleFunction('class', array($this, 'getClassFilter'))
        );
    }

    
    /**
     * @param $object
     * @return string
     */
    public function getClassFilter($object)
    {
        return (new \ReflectionClass($object))->getShortName();
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'get_class_extension';
    }
}