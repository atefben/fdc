<?php

namespace Base\CoreBundle\Twig\Extension;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmFilmPerson;
use Base\CoreBundle\Entity\FilmJury;
use Base\CoreBundle\Entity\FilmPerson;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig_Extension;

/**
 * FilmMediaExtension class.
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
            new \Twig_SimpleFilter('artist_page_media', array($this, 'getArtistPageMedia')),
            new \Twig_SimpleFilter('artist_page_credits', array($this, 'getArtistPageCredits')),
            new \Twig_SimpleFilter('jury_page_media', array($this, 'getJuryPageMedia')),
            new \Twig_SimpleFilter('director_film_media', array($this, 'getDirectorFilmMedia')),
            new \Twig_SimpleFilter('director_film_media_all', array($this, 'getDirectorFilmCreditsAll')),
        );
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('person_image', array($this, 'getPersonImage')),
            new \Twig_SimpleFunction('person_image_portait', array($this, 'getPersonImagePortrait')),
            new \Twig_SimpleFunction('person_image_landscape', array($this, 'getPersonImageLandscape')),
            new \Twig_SimpleFunction('artist_page_media', array($this, 'getArtistPageMedia')),
            new \Twig_SimpleFunction('artist_page_credits', array($this, 'getArtistPageCredits')),
            new \Twig_SimpleFunction('jury_page_media', array($this, 'getJuryPageMedia')),
            new \Twig_SimpleFunction('director_film_media', array($this, 'getDirectorFilmMedia')),
            new \Twig_SimpleFunction('director_film_media_all', array($this, 'getDirectorFilmMediaAll')),
        ];
    }

    /**
     * @param FilmPerson $person
     * @param bool $parentMedia
     * @param null $type
     * @return mixed
     */
    public function getPersonImage(FilmPerson $person, $parentMedia = false, $type = null)
    {
        if ($person->getDisplayedImage()) {
            return $this->getPersonImageLandscape($person, $parentMedia, $type);
        } else {
            return $this->getPersonImagePortrait($person, $parentMedia, $type);
        }
    }

    /**
     * @param FilmPerson $person
     * @param bool $parentMedia
     * @param null $type
     * @return mixed
     */
    public function getPersonImagePortrait(FilmPerson $person, $parentMedia = false, $type = null)
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

        return $this->getDefaultMedia($person, $parentMedia, $type);
    }

    /**
     * @param FilmPerson $person
     * @param bool $parentMedia
     * @param null $type
     * @return mixed
     */
    public function getPersonImageLandscape(FilmPerson $person, $parentMedia = false, $type = null)
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

        return $this->getDefaultMedia($person, $parentMedia, $type);
    }

    protected function getDefaultMedia(FilmPerson $person, $parentMedia = false, $type = null)
    {
        foreach ($person->getMedias() as $media) {
            if ($media->getMedia() && $media->getMedia()->getFile()) {
                if ($type === null || $media->getType() === $type) {
                    if ($parentMedia) {
                        return $media->getMedia();
                    } else {
                        return $media->getMedia()->getFile();
                    }
                }
            }
        }
        foreach ($person->getMedias() as $media) {
            if ($media->getMedia() && $media->getMedia()->getFile()) {
                if ($parentMedia) {
                    return $media->getMedia();
                } else {
                    return $media->getMedia()->getFile();
                }
            }
        }
    }


    /**
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @param $locale
     * @return array
     */
    public function getDirectorFilmMediaAll(FilmFilm $film, $locale)
    {
        $medias = [];
        foreach ($film->getDirectors() as $filmFilmPerson) {
            if ($filmFilmPerson instanceof FilmFilmPerson) {
                $subMedias = $this->getDirectorFilmMedia($filmFilmPerson->getPerson(), $film, $locale);
                if ($subMedias) {
                    $medias = array_merge($medias, $subMedias);
                }
            }
        }
        return $medias;
    }

    /**
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @param $locale
     * @return array
     */
    public function getDirectorFilmCreditsAll(FilmFilm $film, $locale)
    {
        $credits = [];
        foreach ($film->getDirectors() as $filmFilmPerson) {
            if ($filmFilmPerson instanceof FilmFilmPerson) {
                $subCredits = $this->getDirectorFilmCredits($filmFilmPerson->getPerson(), $film, $locale);
                if ($subCredits) {
                    $credits = array_merge($credits, $subCredits);
                }
            }
        }
        return $credits;
    }

    /**
     * @param FilmPerson $person
     * @param FilmFilm $film
     * @param string $locale
     * @return Media[]
     */
    public function getDirectorFilmMedia(FilmPerson $person, FilmFilm $film, $locale)
    {
        $image = $this->getLandscapeImage($person, $locale);
        if (!$image) {
            $image = $this->getPortraitImage($person, $locale);
        }
        if ($image) {
            $image = [
                'file'      => $image,
                'copyright' => $person->getCredits(),
                'titleVa'   => '',
                'titleVf'   => '',
            ];
        } else {
            $image = [];
        }

        if (!$image) {
            foreach ($film->getMedias() as $filmFilmMedia) {
                if ($filmFilmMedia instanceof FilmFilmMedia) {
                    $isCurrent = $filmFilmMedia->getType() == FilmFilmMedia::TYPE_DIRECTOR && $filmFilmMedia->getMedia();
                    $isCurrent = $isCurrent && $filmFilmMedia->getMedia()->getPerson();
                    $isCurrent = $isCurrent && $filmFilmMedia->getMedia()->getPerson()->getId() == $person->getId();
                    if ($isCurrent) {
                        $image[] = $filmFilmMedia->getMedia();
                    }
                }
            }
            if (!$image) {
                foreach ($film->getSelfkitImages() as $selfkitImage) {
                    if ($selfkitImage instanceof Media) {
                        $condition = $selfkitImage->getOldMediaPhotoType() == FilmFilmMedia::TYPE_DIRECTOR;
                        $condition = $condition && $person->getSelfkitImages()->contains($selfkitImage);
                        if ($condition) {
                            $image[] = [
                                'file'      => $selfkitImage,
                                'copyright' => $selfkitImage->getCopyright(),
                                'titleVa'   => '',
                                'titleVf'   => '',
                            ];
                        }
                    }
                }
            }
        }

        if (!$image) {
            $medias = [];
            $types = [
                FilmFilmMedia::TYPE_JURY,
                FilmFilmMedia::TYPE_DIRECTOR,
                FilmFilmMedia::TYPE_PERSON,
            ];

            foreach ($person->getMedias() as $filmPersonMedia) {
                if ($filmPersonMedia instanceof FilmPersonMedia) {
                    if ($filmPersonMedia->getMedia() && $filmPersonMedia->getMedia()->getFile()) {
                        if (in_array($filmPersonMedia->getType(), $types)) {
                            $key = $filmPersonMedia->getMedia()->getCreatedAt()->getTimestamp() . '-1-'
                                . $filmPersonMedia->getMedia()->getId();
                            $medias[$filmPersonMedia->getType()][$key] = $filmPersonMedia->getMedia();
                        }
                    }
                }
            }

            foreach ($person->getSelfkitImages() as $selfkitImage) {
                $key = $selfkitImage->getCreatedAt()->getTimestamp() . '-0-' . $selfkitImage->getId();
                $medias[$selfkitImage->getOldMediaPhotoType()][$key] = [
                    'file'      => $selfkitImage,
                    'copyright' => $selfkitImage->getCopyright(),
                    'titleVa'   => '',
                    'titleVf'   => '',
                ];
            }

            if ($medias) {
                ksort($medias);
                foreach ($medias as $subMedias) {
                    if ($image) {
                        continue;
                    }
                    krsort($subMedias);
                    $image = array_values($subMedias);
                }
            }
        }

        return $image;
    }

    /**
     * @param FilmJury $jury
     * @param string $locale
     * @param FilmFestival $festival
     * @return Media
     */
    public function getJuryPageMedia(FilmJury $jury, $locale, FilmFestival $festival)
    {
        $person = $jury->getPerson();

        $image = $this->getLandscapeImage($person, $locale);
        if (!$image) {
            $image = $this->getPortraitImage($person, $locale);
        }

        if (!$image) {
            foreach ($jury->getMedias() as $media) {
                if ($media) {
                    return $media;
                }
            }
        }

        if (!$image) {
            $medias = [];

            foreach ($person->getMedias() as $filmPersonMedia) {
                if ($filmPersonMedia instanceof FilmPersonMedia) {
                    if ($filmPersonMedia->getMedia() && $filmPersonMedia->getMedia()->getFile()) {
                        $cond = $filmPersonMedia->getType() == FilmFilmMedia::TYPE_JURY;
                        $cond = $cond && $filmPersonMedia->getMedia()->getFestival()->getId() == $festival->getId();
                        if ($cond) {
                            $key = $filmPersonMedia->getMedia()->getCreatedAt()->getTimestamp() . '-9-'
                                . $filmPersonMedia->getMedia()->getId();
                            $medias[$key] = $filmPersonMedia->getMedia()->getFile();
                        }
                    }
                }
            }

            if ($medias) {
                krsort($medias);
                $image = array_values($medias)[0];
            }

            if (!$image) {
                $medias = [];
                foreach ($person->getSelfkitImages() as $selfkitImage) {
                    if ($selfkitImage instanceof Media && $selfkitImage->getOldMediaPhotoType() == FilmFilmMedia::TYPE_JURY) {
                        if ($selfkitImage->getOldMediaPhotoJury() == $jury->getId()) {
                            $key = $selfkitImage->getCreatedAt()->getTimestamp() . '-5-' . $selfkitImage->getId();
                            $medias[$key] = $selfkitImage;
                        }
                    }
                }
                if ($medias) {
                    krsort($medias);
                    $image = array_values($medias)[0];
                }
            }

        }

        if (!$image) {
            $medias = [];
            $types = [
                FilmFilmMedia::TYPE_DIRECTOR,
            ];

            foreach ($person->getMedias() as $filmPersonMedia) {
                if ($filmPersonMedia instanceof FilmPersonMedia) {
                    if ($filmPersonMedia->getMedia() && $filmPersonMedia->getMedia()->getFile()) {
                        if (in_array($filmPersonMedia->getType(), $types)) {
                            $key = $filmPersonMedia->getMedia()->getCreatedAt()->getTimestamp() . '-9-'
                                . $filmPersonMedia->getMedia()->getId();
                            $medias[$key] = $filmPersonMedia->getMedia()->getFile();
                        }
                    }
                }
            }

            foreach ($person->getSelfkitImages() as $selfkitImage) {
                if ($selfkitImage instanceof Media && $selfkitImage->getOldMediaPhotoType() == FilmFilmMedia::TYPE_DIRECTOR) {
                    $key = $selfkitImage->getCreatedAt()->getTimestamp() . '-5-' . $selfkitImage->getId();
                    $medias[$key] = $selfkitImage;
                }
            }
            if ($medias) {
                krsort($medias);
                $image = array_values($medias)[0];
            }
        }
        dump($image);
        return $image;
    }

    /**
     * @param FilmPerson $person
     * @param string $locale
     * @return Media
     */
    public function getArtistPageMedia(FilmPerson $person, $locale)
    {

        $image = $this->getLandscapeImage($person, $locale);
        if (!$image) {
            $image = $this->getPortraitImage($person, $locale);
        }

        if (!$image) {
            $medias = [];
            $types = [
                FilmFilmMedia::TYPE_JURY,
                FilmFilmMedia::TYPE_DIRECTOR,
                FilmFilmMedia::TYPE_PERSON,
            ];

            foreach ($person->getMedias() as $filmPersonMedia) {
                if ($filmPersonMedia instanceof FilmPersonMedia) {
                    if ($filmPersonMedia->getMedia() && $filmPersonMedia->getMedia()->getFile()) {
                        if (in_array($filmPersonMedia->getType(), $types)) {
                            $key = $filmPersonMedia->getMedia()->getCreatedAt()->getTimestamp() . '-9-'
                                . $filmPersonMedia->getMedia()->getId();
                            $medias[$key] = $filmPersonMedia->getMedia()->getFile();
                        }
                    }
                }
            }

            foreach ($person->getSelfkitImages() as $selfkitImage) {
                $key = $selfkitImage->getCreatedAt()->getTimestamp() . '-5-' . $selfkitImage->getId();
                $medias[$key] = $selfkitImage;
            }
            if ($medias) {
                krsort($medias);
                $image = array_values($medias)[0];
            }
        }

        return $image;
    }

    /**
     * @param FilmPerson $person
     * @return string
     */
    public function getArtistPageCredits(FilmPerson $person, $locale)
    {

        $credits = '';
        $image = $this->getLandscapeImage($person, $locale);
        if (!$image) {
            $image = $this->getPortraitImage($person, $locale);
        }
        if ($image) {
            $credits = $person->getCredits();
        }

        if (!$image) {
            $creditsArray = [];
            $types = [
                FilmFilmMedia::TYPE_JURY,
                FilmFilmMedia::TYPE_DIRECTOR,
                FilmFilmMedia::TYPE_PERSON,
            ];

            foreach ($person->getMedias() as $filmPersonMedia) {
                if ($filmPersonMedia instanceof FilmPersonMedia) {
                    if ($filmPersonMedia->getMedia() && $filmPersonMedia->getMedia()->getFile()) {
                        if (in_array($filmPersonMedia->getType(), $types)) {
                            $key = $filmPersonMedia->getMedia()->getCreatedAt()->getTimestamp() . '-9-'
                                . $filmPersonMedia->getMedia()->getId();
                            $creditsArray[$key] = $filmPersonMedia->getMedia()->getCopyright();
                        }
                    }
                }
            }

            foreach ($person->getSelfkitImages() as $selfkitImage) {
                if ($selfkitImage instanceof Media) {
                    $key = $selfkitImage->getCreatedAt()->getTimestamp() . '-5-' . $selfkitImage->getId();
                    $creditsArray[$key] = $selfkitImage->getCopyright();
                }
            }
            if ($creditsArray) {
                krsort($creditsArray);
                $credits = array_values($creditsArray)[0];
            }
        }

        return $credits;
    }

    /**
     * @param FilmPerson $person
     * @param $locale
     * @return Media
     */
    protected function getLandscapeImage(FilmPerson $person, $locale)
    {
        $landscape = $person->getDisplayedImage() && $person->getLandscapeImage();
        $landscape = $landscape && $person->getLandscapeImage()->findTranslationByLocale($locale);
        if ($landscape && $person->getLandscapeImage()->findTranslationByLocale($locale)->getFile()) {
            return $person->getLandscapeImage()->findTranslationByLocale($locale)->getFile();
        } else if ($landscape && $person->getLandscapeImage()->findTranslationByLocale($this->localeFallback)->getFile()) {
            return $person->getLandscapeImage()->findTranslationByLocale($this->localeFallback)->getFile();
        }
    }

    /**
     * @param FilmPerson $person
     * @param $locale
     * @return Media
     */
    protected function getPortraitImage(FilmPerson $person, $locale)
    {
        $portrait = $person->getDisplayedImage() && $person->getPortraitImage();
        $portrait = $portrait && $person->getPortraitImage()->findTranslationByLocale($locale);
        if ($portrait && $person->getPortraitImage()->findTranslationByLocale($locale)->getFile()) {
            return $person->getPortraitImage()->findTranslationByLocale($locale)->getFile();
        } else if ($portrait && $person->getPortraitImage()->findTranslationByLocale($this->localeFallback)->getFile()) {
            return $person->getPortraitImage()->findTranslationByLocale($this->localeFallback)->getFile();
        }
    }


    /**
     * getName function.
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'person_media_extension';
    }
}