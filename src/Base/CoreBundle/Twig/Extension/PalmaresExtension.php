<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmAward;
use Base\CoreBundle\Entity\FilmAwardAssociation;
use Base\CoreBundle\Entity\FilmPrize;
use Twig_Extension;

/**
 * Class PalmaresExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class PalmaresExtension extends Twig_Extension
{

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('award_done', array($this, 'getAwardDone')),
        );
    }
    public function getFilters()
    {
        return array(
            new \Twig_Filter_Function('award_done', array($this, 'getAwardDone')),
        );
    }

    /**
     * @param FilmAwardAssociation $association
     * @return bool
     */
    public function getAwardDone(FilmAwardAssociation $association)
    {
        static $done = [];
        if ($association->getAward()->getPrize()->getType() === FilmPrize::TYPE_FILM) {
            $key = $association->getAward()->getId() . '-' . $association->getFilm()->getId();
            if (in_array($key, $done)) {
                return true;
            }
            $done[] = $key;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'palmares_extension';
    }
}