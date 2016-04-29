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
            new \Twig_SimpleFilter('profession_gender', array($this, 'getProfessionGender')),
        );
    }

    /**
     * @param FilmPerson $person
     * @param $function
     * @param $property
     * @return string
     */
    public function getPersonFunctionGender(FilmPerson $person, $function, $property)
    {
        $translated = $this->transFallbackFilter($function, $property);
        $transFr = $person->findTranslationByLocale('fr');

        if ($transFr) {
            return $this->professionReplace($translated, $transFr->getGender());
        }

        return $translated;
    }

    protected function professionReplace($profession, $gender)
    {
        $default = array(
            '(e)',
            '(ne)',
            '(teur/trice)',
            '(eur/euse)',
            '(er/ière)',
        );
        $male = array(
            '',
            '',
            'teur',
            'eur',
            'er',
        );
        $female = array(
            '',
            'ne',
            'trice',
            'euse',
            'ière',
        );
        $gender = strtoupper($gender);
        if ($gender == 'MONSIEUR') {
            return str_replace($default, $male, $profession);
        } elseif ($gender == 'MADAME') {
            return str_replace($default, $female, $profession);
        } else {
            return $profession;
        }
    }

    public function getProfessionGender(FilmPerson $person, $locale)
    {
        $translated = $this->transFallbackFilter($person, 'profession');
        $fr = $person->findTranslationByLocale('fr');
        if ($fr) {
            return $this->professionReplace($translated, $fr->getGender());
        }
        return $translated;
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