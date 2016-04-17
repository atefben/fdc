<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMediaInterface;
use Symfony\Component\HttpFoundation\RequestStack;
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

    /**
     * @var string
     */
    private $localeFallback;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * FilmMediaExtension constructor.
     * @param string $localeFallback
     * @param RequestStack $requestStack
     */
    public function __construct($localeFallback, $requestStack)
    {
        $this->localeFallback = $localeFallback;
        $this->requestStack = $requestStack;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('film_media', array($this, 'getMedias')),
            new \Twig_SimpleFilter('film_poster', array($this, 'getFilmPoster')),
        );
    }

    public function getMedias($film, $type, $parent = false)
    {
        $medias = array();
        if ($film && method_exists($film, 'getMedias') && count($film->getMedias()) > 0) {
            foreach ($film->getMedias() as $media) {
                if ($media->getMedia() !== null && $media->getType() == $type) {
                    if ($parent == true) {
                        $medias[] = $media->getMedia();
                    } else {
                        $medias[] = $media->getMedia()->getFile();
                    }
                }
            }
        }
        return $medias;
    }

    /**
     * @param FilmFilm $film
     */
    public function getFilmPoster(FilmFilm $film)
    {
        $locale = $this
            ->requestStack
            ->getCurrentRequest()
            ->getLocale()
        ;

        $hasImageMain = $film->getImageMain() && $film->getImageMain()->findTranslationByLocale($locale);
        $hasImageMain = $hasImageMain && $film->getImageMain()->findTranslationByLocale($locale)->getFile();
        if ($hasImageMain) {
            return $film->getImageMain()->findTranslationByLocale($locale)->getFile();
        }

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