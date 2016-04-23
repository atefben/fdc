<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmAward;
use Twig_Extension;

/**
 * FallbackTranslationExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class PalmaresAwardMutualExtension extends Twig_Extension
{
    static $mutuals = array();

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('palmares_award_mutual_get', array($this, 'getPalmaresAwardMutual')),
            new \Twig_SimpleFunction('palmares_award_mutual_set', array($this, 'setPalmaresAwardMutual')),
        );
    }

    /**
     * @return array
     */
    public function getPalmaresAwardMutual()
    {
        return static::$mutuals;
    }

    /**
     * @param FilmAward $award
     */
    public function setPalmaresAwardMutual(FilmAward $award)
    {
        static::$mutuals[] = $award->getId();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'palmares_award_mutual_extension';
    }
}