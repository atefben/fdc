<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmAward;
use Base\CoreBundle\Entity\FilmFilm;
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
            new \Twig_SimpleFunction('palmares_award_is_mutual_done', array($this, 'isMutualDone')),
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
     * @return array
     */
    public function isMutualDone(FilmAward $award, FilmFilm $movie = null)
    {
        if (!$award->getFilmMutual()) {
            return null;
        }
        if ($movie) {
            $value  = $award->getId() . '-' . $movie->getId();
            if (in_array($value, static::$mutuals)) {
                return true;
            }
        }
    }

    /**
     * @param FilmAward $award
     */
    public function setPalmaresAwardMutual(FilmAward $award, FilmFilm $movie = null)
    {
        if (!$award->getFilmMutual()) {
            return null;
        }

        if ($movie) {
            static::$mutuals[] = $award->getId() . '-' . $movie->getId();
        } else {
            static::$mutuals[] = $award->getId();
        }

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'palmares_award_mutual_extension';
    }
}