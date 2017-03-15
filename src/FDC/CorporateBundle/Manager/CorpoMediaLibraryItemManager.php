<?php

namespace FDC\CorporateBundle\Manager;

use Application\Sonata\MediaBundle\Entity\Media as SonataMedia;
use Base\CoreBundle\Entity\FilmFestivalPoster;
use Base\CoreBundle\Entity\FilmFestivalPosterTranslation;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmFilmTranslation;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Base\CoreBundle\Entity\FilmPersonTranslation;
use Base\CoreBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageSimple;
use Base\CoreBundle\Entity\MediaImageSimpleTranslation;
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
        } elseif ($object instanceof SonataMedia && $object->getOldMediaPhoto()) {
            $this->syncSonataMedia($object);
        } elseif ($object instanceof MediaImageSimple) {
            $this->syncMediaImageSimple($object);
        }
    }

    private function syncMediaImageSimple(MediaImageSimple $object)
    {
        $films = $this->getFilmsByMediaImageSimple($object);
        foreach ($this->locales as $locale) {
            if ($films) {
                $trans = $object->findTranslationByLocale($locale);
                if ($trans instanceof MediaImageSimpleTranslation) {
                    $item = $this->getCorpoMediaLibraryItem($object, MediaImageSimple::class, $locale);

                    $search = $trans->getAlt();
                    $festival = null;
                    foreach ($films as $film) {
                        $filmTranslation = $film->findTranslationByLocale($locale);
                        $festival = $film->getFestival();
                        if ($filmTranslation instanceof FilmFilmTranslation) {
                            $search .= ' ' . $film->getTitleVO();
                            $search .= ' ' . $filmTranslation->getTitle();
                            $search .= ' ' . $filmTranslation->getSynopsis();
                            $search .= ' ' . $filmTranslation->getInfoRestauration();
                        }
                    }
                    if (!$festival) {
                        $this->getDoctrineManager()->remove($item);
                        return null;
                    }


                    $item
                        ->setType('image')
                        ->setSorted($festival->getFestivalStartsAt())
                        ->setFestivalYear($festival->getYear())
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

    /**
     * @param MediaImageSimple $media
     * @return FilmFilm[]
     */
    private function getFilmsByMediaImageSimple(MediaImageSimple $media)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->createQueryBuilder('f')
            ->distinct()
            ->andWhere('f.imageCover = :mediaId or f.imageMain = :mediaId')
            ->setParameter(':mediaId', $media->getId())
            ->getQuery()
            ->getResult()
        ;
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
                            $search .= ' ' .$tagTrans->getName();
                        }
                    }

                    $films = [];
                    if ($object->getAssociatedFilm()) {
                        $films[$object->getAssociatedFilm()->getId()] = $object->getAssociatedFilm();
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
            if ($object->getMedia() && $object->getMedia()->getFilmMedias()) {
                foreach ($object->getMedia()->getFilmMedias() as $filmMedia) {
                    if ($filmMedia instanceof FilmFilmMedia) {
                        if ($this->getCorpoMediaLibraryItem($filmMedia, FilmFilmMedia::class, $locale)) {
                            $this->removeCorpoMediaLibraryItem($object, FilmPersonMedia::class, $locale);
                            return;
                        }
                    }
                }
            }
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

    public function syncSonataMedia(SonataMedia $sonataMedia)
    {
        foreach ($this->locales as $locale) {
            if (!$sonataMedia->getSelfkitFilms()->count() && !$sonataMedia->getOldMediaFestivalYear()) {
                return;
            }
            $item = $this->getCorpoMediaLibraryItem($sonataMedia, SonataMedia::class, $locale);
            $search = '';
            $search .= ' ' . $sonataMedia->getName();
            $search .= ' ' . $sonataMedia->getCopyright();
            $sorted = null;
            $festivalYear = null;
            if ($sonataMedia->getSelfkitFilms()->count() && $sonataMedia->getSelfkitFilms()->first()) {
                $film = $sonataMedia->getSelfkitFilms()->first();
                if ($film instanceof FilmFilm) {
                    $sorted = $film->getFestival()->getFestivalStartsAt();
                    $festivalYear = $film->getFestival()->getYear();
                    $filmTranslation = $film->findTranslationByLocale($locale);
                    if ($filmTranslation instanceof FilmFilmTranslation) {
                        $search .= ' ' . $film->getTitleVO();
                        $search .= ' ' . $filmTranslation->getTitle();
                        $search .= ' ' . $filmTranslation->getSynopsis();
                        $search .= ' ' . $filmTranslation->getDialog();
                        $search .= ' ' . $filmTranslation->getInfoRestauration();
                    }
                }

            }
            foreach ($sonataMedia->getSelfkitPersons() as $person) {
                $search .= '' . $person->getFullName();
                $search .= ' ' . $person->getCredits();
                $search .= ' ' . $person->getPresidentJuryCredits();
                $personTrans = $person->findTranslationByLocale($locale);
                if ($personTrans instanceof FilmPersonTranslation) {
                    $search .= ' ' . $personTrans->getBiography();
                    $search .= ' ' . $personTrans->getProfession();
                }
            }
            $item
                ->setType('image')
                ->setSorted($sorted)
                ->setFestivalYear($festivalYear)
                ->setSearch($search)
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