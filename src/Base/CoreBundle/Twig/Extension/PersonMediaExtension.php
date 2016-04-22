<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMediaInterface;
use Base\CoreBundle\Entity\FilmPerson;
use Symfony\Component\HttpFoundation\RequestStack;
use \Twig_Extension;

/**
 * FilmMediaExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class PersonMediaExtension extends Twig_Extension
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
            new \Twig_SimpleFilter('person_image', array($this, 'getPersonImage')),
            new \Twig_SimpleFilter('person_image_portait', array($this, 'getPersonImagePortrait')),
            new \Twig_SimpleFilter('person_image_landscape', array($this, 'getPersonImageLandscape')),
        );
    }

    /**
     * @param FilmPerson $person
     * @param $parentMedia
     * @return mixed
     */
    public function getPersonImage(FilmPerson $person, $parentMedia = false)
    {
        if ($person->getDisplayedImage()) {
            return $this->getPersonImageLandscape($person, $parentMedia);
        }
        else {
            return $this->getPersonImagePortrait($person, $parentMedia);
        }
    }

    /**
     * @param FilmPerson $person
     * @param bool $parentMedia
     * @return mixed
     */
    public function getPersonImagePortrait(FilmPerson $person, $parentMedia = false)
    {
        $locale = $this
            ->requestStack
            ->getCurrentRequest()
            ->getLocale()
        ;

        $hasImageMain = $person->getPortraitImage() && $person->getPortraitImage()->findTranslationByLocale($locale);
        $hasImageMain = $hasImageMain && $person->getPortraitImage()->findTranslationByLocale($locale)->getFile();
        if ($hasImageMain) {
            return $person->getPortraitImage()->findTranslationByLocale($locale)->getFile();
        }

        return $this->getDefaultMedia($person, $parentMedia);
    }

    /**
     * @param FilmPerson $person
     * @param bool $parentMedia
     * @return mixed
     */
    public function getPersonImageLandscape(FilmPerson $person, $parentMedia = false)
    {
        $locale = $this
            ->requestStack
            ->getCurrentRequest()
            ->getLocale()
        ;

        $hasImageMain = $person->getLandscapeImage() && $person->getLandscapeImage()->findTranslationByLocale($locale);
        $hasImageMain = $hasImageMain && $person->getLandscapeImage()->findTranslationByLocale($locale)->getFile();
        if ($hasImageMain) {
            return $person->getLandscapeImage()->findTranslationByLocale($locale)->getFile();
        }

        return $this->getDefaultMedia($person, $parentMedia);
    }

    protected function getDefaultMedia(FilmPerson $person, $parentMedia = false)
    {
        foreach ($person->getMedias() as $media) {
            if ($media->getMedia() && $media->getMedia()->getFile()) {
                if ($parentMedia) {
                    return $media->getMedia();
                }
                else {
                    return $media->getMedia()->getFile();
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
        return 'person_media_extension';
    }
}