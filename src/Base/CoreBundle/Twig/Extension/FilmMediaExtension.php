<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMediaInterface;
use \Twig_Extension;

/**
 * FilmMediaExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class FilmMediaExtension extends Twig_Extension
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('film_media', array($this, 'getMedias')),
            new \Twig_SimpleFilter('film_poster', array($this, 'getFilmPoster')),
        );
    }

    public function getMedias($film, $type)
    {
        $medias = array();
        foreach ($film->getMedias() as $media) {
            if ($media->getMedia() !== null && $media->getType() == $type) {
                $medias[] = $media->getMedia()->getFile();
            }
        }
        return $medias;
    }

    /**
     * @param FilmFilm $film
     */
    public function getFilmPoster(FilmFilm $film)
    {
        foreach ($film->getMedias() as $media) {
            if ($media->getType() === FilmFilmMediaInterface::TYPE_POSTER && $media->getMedia() && $media->getMedia()->getFile()) {
                return $media->getMedia()->getFile();
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
        return 'film_media_extension';
    }
}