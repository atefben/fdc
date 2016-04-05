<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmPerson;
use \Twig_Extension;

/**
 * PersonFunctionGenderExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class PersonFunctionGenderExtension extends Twig_Extension
{
    private $localeFallback;

    private $requestStack;

    public function __construct($localeFallback, $requestStack)
    {
        $this->localeFallback = $localeFallback;
        $this->requestStack = $requestStack;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('person_function_gender', array($this, 'getPersonFunctionGender')),
        );
    }

    /**
     * @param FilmPerson $person
     */
    public function getPersonFunctionGender(FilmPerson $person, $function, $property)
    {
        $functionName = $this->transFallbackFilter($function, $property);
        $transFr = $person->findTranslationByLocale('fr');

        if ($transFr) {
            // find a (
            if (strpos($functionName,'(') !== false) {
                $explode = explode('/', $this->transFallbackFilter($function, $property));
                // try to explode the function name
                if (count($explode) == 2) {
                    // explode on (
                    $explodeGender = explode('(', $explode[0]);
                    // if explode works
                    if (count($explodeGender) == 2) {
                        if ($transFr->getGender() == 'Monsieur') {
                            return $explodeGender[0] . $explodeGender[1];
                        } else if ($transFr->getGender() == 'Madame') {
                            return $explodeGender[0] . substr($explode[1], 0, -1);
                        }
                    }
                }
            }
        }

        return $functionName;
    }

    public function transFallbackFilter($object, $property)
    {
        if ($object) {
            $locale = $this->requestStack->getCurrentRequest()->getLocale();

            if (method_exists($object, 'findTranslationByLocale')) {
                $trans = $object->findTranslationByLocale($locale);
                $property = ucfirst($property);

                if ($trans && $trans->{'get' . $property}()) {
                    return $trans->{'get' . $property}();
                }

                $transEn = $object->findTranslationByLocale($this->localeFallback);

                if ($transEn && $transEn->{'get' . $property}()) {
                    return $transEn->{'get' . $property}();
                }
            }
        }

        return '';
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'person_function_gender_extension';
    }
}