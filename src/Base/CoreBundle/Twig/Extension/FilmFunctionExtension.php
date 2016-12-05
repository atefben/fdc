<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * FallbackTranslationExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class FilmFunctionExtension extends Twig_Extension
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('film_function', array($this, 'getPersonFunctionByFilm')),
        );
    }

    public function getPersonFunctionByFilm($film, $functionId)
    {
        $tmp = array();
        if (method_exists($film, 'getPersons')) {
            foreach ($film->getPersons() as $person) {
                if (!$person || !$person->getPerson() || $person->getPerson()->getDuplicate()) {
                    continue;
                }
                foreach ($person->getFunctions() as $function) {
                    if ($function->getFunction() != null && $function->getFunction()->getId() == $functionId) {
                        $tmp[] = $person->getPerson();
                    }
                }
            }
        }
        return $tmp;
    }


    /**
     * getName function.
     *
     * @access public
     */
    public function getName()
    {
        return 'film_function_extension';
    }
}