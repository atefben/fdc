<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmFilm;
use \Twig_Extension;

/**
 * Class FilmPrizeExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class FilmPrizeExtension extends Twig_Extension
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('film_prize', array($this, 'getFilmPrizeByCategory')),
        );
    }

    public function getFilmPrizeByCategory(FilmFilm $film, $festivalId, $category)
    {
        foreach ($film->getAwards() as $awardAssociation) {
            if ($awardAssociation->getAward()) {
                $award = $awardAssociation->getAward();
                if ($award->getFestival() && $award->getFestival()->getId() == $festivalId && $award->getPrize()) {
                    $prize = $award->getPrize();
                    if ($prize->findTranslationByLocale('fr') && $prize->findTranslationByLocale('fr')->getCategory() == $category) {
                        return $prize;
                    }
                }
            }
        }
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'film_prize_extension';
    }
}