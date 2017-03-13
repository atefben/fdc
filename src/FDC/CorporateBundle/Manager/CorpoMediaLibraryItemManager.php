<?php

namespace FDC\CorporateBundle\Manager;

use Base\CoreBundle\Entity\FilmFestivalPoster;
use Base\CoreBundle\Entity\FilmFestivalPosterTranslation;
use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmFilmTranslation;
use Base\CoreBundle\Entity\FilmMedia;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Base\CoreBundle\Entity\FilmPersonTranslation;
use Base\CoreBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaTag;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\TagTranslation;
use Base\CoreBundle\Entity\ThemeTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FDC\CorporateBundle\Entity\CorpoMediaLibraryItem;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CorpoMediaLibraryItemManager
{
    /**
     * @var ContainerInterface
     */
    private $container;

    private $locales = ['fr', 'en', 'es', 'zh'];

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function sync($object)
    {
        if ($object instanceof MediaImage) {
            $this->syncMediaImage($object);
        } elseif ($object instanceof MediaAudio) {
            $this->syncMediaAudio($object);
        } elseif ($object instanceof MediaVideo) {
            $this->syncMediaVideo($object);
        } elseif ($object instanceof FilmFestivalPoster) {
            $this->syncFilmFestivalPoster($object);
        } elseif ($object instanceof FilmFilmMedia) {
            $this->syncFilmFilmMedia($object);
        } elseif ($object instanceof FilmPersonMedia) {
            $this->syncFilmPersonMedia($object);
        }
    }

    private function syncMediaImage(MediaImage $object)
    {
        foreach ($this->locales as $locale) {
            if ($this->isAvailableMedia($object, $locale)) {
                $trans = $object->findTranslationByLocale($locale);
                if ($trans instanceof MediaImageTranslation) {
                    $item = $this->getCorpoMediaLibraryItem($object, MediaImage::class, $locale);

                    $search = $trans->getLegend();
                    $search .= ' ' . $trans->getAlt();
                    $search .= ' ' . $trans->getCopyright();

                    if (
                        $object->getTheme()
                        && ($themeTrans = $object->getTheme()->findTranslationByLocale($locale))
                        && $themeTrans instanceof ThemeTranslation
                    ) {
                        $search .= ' ' . $themeTrans->getName();
                    }

                    foreach ($object->getTags() as $tag) {
                        if (
                            $tag instanceof MediaTag && $tag->getTag()
                            && ($tagTrans = $tag->getTag()->findTranslationByLocale($locale))
                            && ($tagTrans instanceof TagTranslation)
                        ) {
                            $search .= $tagTrans->getName();
                        }
                    }

                    $films = [];
                    if ($object->getAssociatedFilm()) {
                        $films[$object->getAssociatedFilm()->getId()] = $object->getAssociatedFilm();
                    }
                    foreach ($films as $film) {
                        $filmTranslation = $film->findTranslationByLocale($locale);
                        if ($filmTranslation instanceof FilmFilmTranslation) {
                            $item = $this->getCorpoMediaLibraryItem($object, FilmFilmMedia::class, $locale);

                            $search .= ' ' . $film->getTitleVO();
                            $search .= ' ' . $filmTranslation->getTitle();
                            $search .= ' ' . $filmTranslation->getSynopsis();
                            $search .= ' ' . $filmTranslation->getInfoRestauration();
                        }
                    }


                    $item
                        ->setType('image')
                        ->setSorted($object->getPublishedAt())
                        ->setFestivalYear($object->getFestival()->getYear())
                        ->setSearch($search)
                    ;
                    $this->getDoctrineManager()->flush();
                } else {
                    $this->removeCorpoMediaLibraryItem($object, MediaImage::class, $locale);
                }
            } else {
                $this->removeCorpoMediaLibraryItem($object, MediaImage::class, $locale);
            }
        }
    }

    private function syncMediaAudio(MediaAudio $object)
    {
        foreach ($this->locales as $locale) {
            if ($this->isAvailableMedia($object, $locale)) {
                $trans = $object->findTranslationByLocale($locale);
                if ($trans instanceof MediaAudioTranslation) {
                    $item = $this->getCorpoMediaLibraryItem($object, MediaAudio::class, $locale);

                    $search = $trans->getTitle();

                    if (
                        $object->getTheme()
                        && ($themeTrans = $object->getTheme()->findTranslationByLocale($locale))
                        && $themeTrans instanceof ThemeTranslation
                    ) {
                        $search .= ' ' . $themeTrans->getName();
                    }

                    foreach ($object->getTags() as $tag) {
                        if (
                            $tag instanceof MediaTag && $tag->getTag()
                            && ($tagTrans = $tag->getTag()->findTranslationByLocale($locale))
                            && ($tagTrans instanceof TagTranslation)
                        ) {
                            $search .= $tagTrans->getName();
                        }
                    }

                    $films = [];
                    if ($object->getAssociatedFilm()) {
                        $films[$object->getAssociatedFilm()->getId()] = $object->getAssociatedFilm();
                    }
                    foreach ($this->getDoctrineManager()->getRepository('BaseCoreBundle:FilmFilm')->getFilmsByMediaAudio($object) as $film) {
                        $films[$film->getId()] = $film;
                    }
                    foreach ($films as $film) {
                        $filmTranslation = $film->findTranslationByLocale($locale);
                        if ($filmTranslation instanceof FilmFilmTranslation) {

                            $search .= ' ' . $film->getTitleVO();
                            $search .= ' ' . $filmTranslation->getTitle();
                            $search .= ' ' . $filmTranslation->getSynopsis();
                            $search .= ' ' . $filmTranslation->getInfoRestauration();
                        }
                    }

                    $item
                        ->setType('audio')
                        ->setSorted($object->getPublishedAt())
                        ->setFestivalYear($object->getFestival()->getYear())
                        ->setSearch($search)
                    ;
                    $this->getDoctrineManager()->flush();
                } else {
                    $this->removeCorpoMediaLibraryItem($object, MediaAudio::class, $locale);
                }
            } else {
                $this->removeCorpoMediaLibraryItem($object, MediaAudio::class, $locale);
            }
        }
    }

    private function syncMediaVideo(MediaVideo $object)
    {
        foreach ($this->locales as $locale) {
            if ($this->isAvailableMedia($object, $locale)) {
                $trans = $object->findTranslationByLocale($locale);
                if ($trans instanceof MediaVideoTranslation) {
                    $item = $this->getCorpoMediaLibraryItem($object, MediaVideo::class, $locale);

                    $search = $trans->getTitle();

                    if (
                        $object->getTheme()
                        && ($themeTrans = $object->getTheme()->findTranslationByLocale($locale))
                        && $themeTrans instanceof ThemeTranslation
                    ) {
                        $search .= ' ' . $themeTrans->getName();
                    }

                    foreach ($object->getTags() as $tag) {
                        if (
                            $tag instanceof MediaTag && $tag->getTag()
                            && ($tagTrans = $tag->getTag()->findTranslationByLocale($locale))
                            && ($tagTrans instanceof TagTranslation)
                        ) {
                            $search .= $tagTrans->getName();
                        }
                    }

                    $films = [];
                    if ($object->getAssociatedFilm()) {
                        $films[$object->getAssociatedFilm()->getId()] = $object->getAssociatedFilm();
                    }
                    foreach ($this->getDoctrineManager()->getRepository('BaseCoreBundle:FilmFilm')->getFilmsByMainVideo($object) as $film) {
                        $films[$film->getId()] = $film;
                    }
                    foreach ($this->getDoctrineManager()->getRepository('BaseCoreBundle:FilmFilm')->getFilmsByMediaVideo($object) as $film) {
                        $films[$film->getId()] = $film;
                    }
                    foreach ($films as $film) {
                        $filmTranslation = $film->findTranslationByLocale($locale);
                        if ($filmTranslation instanceof FilmFilmTranslation) {

                            $search .= ' ' . $film->getTitleVO();
                            $search .= ' ' . $filmTranslation->getTitle();
                            $search .= ' ' . $filmTranslation->getSynopsis();
                            $search .= ' ' . $filmTranslation->getInfoRestauration();
                        }
                    }

                    $item
                        ->setType('video')
                        ->setSorted($object->getPublishedAt())
                        ->setFestivalYear($object->getFestival()->getYear())
                        ->setSearch($search)
                    ;
                    $this->getDoctrineManager()->flush();
                } else {
                    $this->removeCorpoMediaLibraryItem($object, MediaVideo::class, $locale);
                }
            } else {
                $this->removeCorpoMediaLibraryItem($object, MediaVideo::class, $locale);
            }
        }
    }

    private function syncFilmFestivalPoster(FilmFestivalPoster $object)
    {
        foreach ($this->locales as $locale) {
            $translation = $object->findTranslationByLocale($locale);
            if ($translation instanceof FilmFestivalPosterTranslation) {
                $item = $this->getCorpoMediaLibraryItem($object, FilmFestivalPoster::class, $translation->getLocale());

                $sorted = $object->getFestival()->getFestivalStartsAt();
                $search = $object->getCopyright();
                $search .= ' ' . $translation->getTitle();
                $search .= ' ' . $translation->getDescription();

                $item
                    ->setType('image')
                    ->setSorted($sorted)
                    ->setFestivalYear($object->getFestival()->getYear())
                    ->setSearch($search)
                ;
                $upperTitle = strtoupper($translation->getTitle());
                if (strpos($upperTitle, 'UN CERTAIN REGARD')) {
                    $item->setWeight(10);
                } else {
                    $item->setWeight(20);
                }
                $this->getDoctrineManager()->flush();
            }
        }
    }

    private function syncFilmFilmMedia(FilmFilmMedia $object)
    {
        foreach ($this->locales as $locale) {
            if (!$object->getMedia() || !$object->getMedia()->getFile()) {
                $this->removeCorpoMediaLibraryItem($object, FilmFilmMedia::class, $locale);
            } else {
                $filmTranslation = $object->getFilm()->findTranslationByLocale($locale);
                if ($filmTranslation instanceof FilmFilmTranslation) {
                    $item = $this->getCorpoMediaLibraryItem($object, FilmFilmMedia::class, $locale);

                    $sorted = $object->getFilm()->getFestival()->getFestivalStartsAt();
                    $search = $object->getFilm()->getTitleVO();
                    $search .= ' ' . $filmTranslation->getTitle();
                    $search .= ' ' . $object->getMedia()->getCopyright();
                    $search .= ' ' . $object->getMedia()->getCredits();
                    $search .= ' ' . $object->getMedia()->getTitleVf();
                    $search .= ' ' . $object->getMedia()->getTitleVa();

                    $item
                        ->setType('image')
                        ->setSorted($sorted)
                        ->setFestivalYear($object->getFilm()->getFestival()->getYear())
                        ->setSearch($search)
                    ;
                    $this->getDoctrineManager()->flush();
                }
            }
        }
    }

    private function syncFilmPersonMedia(FilmPersonMedia $object)
    {
        foreach ($this->locales as $locale) {

            $item = $this->getCorpoMediaLibraryItem($object, FilmPersonMedia::class, $locale);
            if (!$object->getMedia() || !$object->getMedia()->getFestival()) {
                return null;
            }
            $text = $object->getPerson()->getFullName();
            $text .= ' ' . $object->getPerson()->getCredits();
            $text .= ' ' . $object->getPerson()->getPresidentJuryCredits();
            $personTrans = $object->getPerson()->findTranslationByLocale($locale);
            if ($personTrans instanceof FilmPersonTranslation) {
                $text .= ' ' . $personTrans->getBiography();
                $text .= ' ' . $personTrans->getProfession();
            }
            foreach ($object->getMedia()->getFilmMedias() as $filmMedia) {
                if ($filmMedia instanceof FilmFilmMedia) {
                    $movie = $filmMedia->getFilm();
                    $text .= ' ' . $movie->getTitleVO();
                    $movieTrans = $movie->findTranslationByLocale($locale);
                    if ($movieTrans instanceof FilmFilmTranslation) {
                        $text .= ' ' . $movieTrans->getTitle();
                        $text .= ' ' . $movieTrans->getSynopsis();
                        $text .= ' ' . $movieTrans->getDialog();
                        $text .= ' ' . $movieTrans->getInfoRestauration();
                    }
                }
            }

            $item
                ->setType('image')
                ->setSorted($object->getMedia()->getFestival()->getFestivalStartsAt())
                ->setFestivalYear($object->getMedia()->getFestival()->getYear())
                ->setSearch($text)
            ;

            $this->getDoctrineManager()->flush();
        }
    }

    private function syncFilmMedia(FilmMedia $object)
    {
        foreach ($this->locales as $locale) {
            $item = $this->getCorpoMediaLibraryItem($object, FilmMedia::class, $locale);

            if (!$object->getFestival()) {
                return null;
            }
            $text = $object->getCopyright();
            $text .= ' ' . $object->getCredits();
            $text .= ' ' . $object->getTitleVf();
            $text .= ' ' . $object->getTitleVa();
            $text .= ' ' . $object->getTitleVa();
            $text .= ' ' . $object->getNoteVf();
            $text .= ' ' . $object->getNoteVa();

            foreach ($object->getPersonMedias() as $personMedia) {
                if ($personMedia instanceof FilmPersonMedia) {
                    $text = $personMedia->getPerson()->getFullName();
                    $text .= ' ' . $object->getPerson()->getCredits();
                    $text .= ' ' . $object->getPerson()->getPresidentJuryCredits();
                    $personTrans = $object->getPerson()->findTranslationByLocale($locale);
                    if ($personTrans instanceof FilmPersonTranslation) {
                        $text .= ' ' . $personTrans->getBiography();
                        $text .= ' ' . $personTrans->getProfession();
                    }
                }
            }
            foreach ($object->getFilmMedias() as $filmMedia) {
                if ($filmMedia instanceof FilmFilmMedia) {
                    $movie = $filmMedia->getFilm();
                    $text .= ' ' . $movie->getTitleVO();
                    $movieTrans = $movie->findTranslationByLocale($locale);
                    if ($movieTrans instanceof FilmFilmTranslation) {
                        $text .= ' ' . $movieTrans->getTitle();
                        $text .= ' ' . $movieTrans->getSynopsis();
                        $text .= ' ' . $movieTrans->getDialog();
                        $text .= ' ' . $movieTrans->getInfoRestauration();
                    }
                }
            }

            $item
                ->setType('image')
                ->setSorted($object->getFestival()->getFestivalStartsAt())
                ->setFestivalYear($object->getFestival()->getYear())
                ->setSearch($text)
            ;
            $this->getDoctrineManager()->flush();
        }
    }


    /**
     * @return ObjectManager
     */
    private function getDoctrineManager()
    {
        return $this->container->get('doctrine')->getManager();
    }

    private function getCorpoMediaLibraryItem($object, $class, $locale)
    {
        $item = $this
            ->getDoctrineManager()
            ->getRepository('FDCCorporateBundle:CorpoMediaLibraryItem')
            ->findOneBy([
                'entityClass' => $class,
                'entityId'    => $object->getId(),
                'locale'      => $locale,
            ])
        ;

        if (!$item) {
            $item = new CorpoMediaLibraryItem();
            $item
                ->setEntityClass($class)
                ->setEntityId($object->getId())
                ->setLocale($locale)
            ;
            $this->getDoctrineManager()->persist($item);
        }
        return $item;
    }

    private function removeCorpoMediaLibraryItem($object, $class, $locale)
    {
        $item = $this
            ->getDoctrineManager()
            ->getRepository('FDCCorporateBundle:CorpoMediaLibraryItem')
            ->findOneBy([
                'entityClass' => $class,
                'entityId'    => $object->getId(),
                'locale'      => $locale,
            ])
        ;

        if ($item) {
            $this->getDoctrineManager()->remove($item);
            $this->getDoctrineManager()->flush();
        }
    }

    private function isAvailableMedia(Media $media, $locale)
    {
        $fr = $media->findTranslationByLocale('fr');
        $trans = $media->findTranslationByLocale($locale);
        if (!$fr) {
            return false;
        }
        if ($fr->getStatus() !== TranslateChildInterface::STATUS_PUBLISHED) {
            return false;
        }
        if ($locale != 'fr') {
            if (!$trans) {
                return false;
            }
            if ($trans->getStatus() !== TranslateChildInterface::STATUS_TRANSLATED) {
                return false;
            }
        }
        if (!$media->getPublishedAt()) {
            return false;
        }
        return true;
    }
}