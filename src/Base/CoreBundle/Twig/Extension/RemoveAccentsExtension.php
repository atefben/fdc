<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * Class RemoveAccentsExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class RemoveAccentsExtension extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('remove_accents', array($this, 'removeAccents')),
        );
    }

    public function removeAccents($str)
    {
        $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');

        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

        return $str;
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'remove_accent_extension';
    }
}