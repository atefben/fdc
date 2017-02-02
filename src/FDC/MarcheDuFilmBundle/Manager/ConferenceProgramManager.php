<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramDay;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramDayCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetImage;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetTextTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetVideoTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfProgramFile;
use FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfThemeTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ConferenceProgramManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getContentTemplateConferenceProgramePageData($conferenceProgramPage)
    {
        $textWidgets = $this->getContentTemplateTextWidgets($conferenceProgramPage);
        $imageWidgets = $this->getContentTemplateImageWidgets($conferenceProgramPage);
        $galleryWidgets = $this->getContentTemplateGalleryWidgets($conferenceProgramPage);
        $youtubeWidgets = $this->getContentTemplateYoutubeWidgets($conferenceProgramPage);

        $widgets = [];
        $widgets = array_merge($widgets, $textWidgets, $imageWidgets, $galleryWidgets, $youtubeWidgets);

        usort($widgets, function($a, $b)
        {
            if (property_exists($a, 'translatable') && property_exists($b, 'translatable')) {
                return strcmp($a->getTranslatable()->getPosition(), $b->getTranslatable()->getPosition());
            } else if (property_exists($a, 'translatable') && !property_exists($b, 'translatable')) {
                return strcmp($a->getTranslatable()->getPosition(), $b->getPosition());
            } else if (!property_exists($a, 'translatable') && property_exists($b, 'translatable')) {
                return strcmp($a->getPosition(), $b->getTranslatable()->getPosition());
            } else if (!property_exists($a, 'translatable') && !property_exists($b, 'translatable')) {
                return strcmp($a->getPosition(), $b->getPosition());
            }
        });

        return $widgets;
    }

    public function getConferenceProgramPageBySlug($slug)
    {
        return $this->em
            ->getRepository(MdfConferenceProgramTranslation::class)
            ->getConferenceProgramPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);
    }

    public function getFiles($conferenceProgramId)
    {
        return $this->em
            ->getRepository(MdfProgramFile::class)
            ->findBy(
                array(
                    'conferenceProgram' => $conferenceProgramId
                )
            );
    }

    public function getConferenceProgramDaysWidgets($page)
    {
        if ($page) {
            $programDayCollectionRepo = $this->em->getRepository(MdfConferenceProgramDayCollection::class);
            $programDayRepo = $this->em->getRepository(MdfConferenceProgramDay::class);

            $programDayCollection = $programDayCollectionRepo
                ->findBy(
                    array(
                        'conferenceProgram' => $page->getTranslatable()->getId()
                    )
                );

            if ($programDayCollection) {
                $programDays = [];
                foreach ($programDayCollection as $widget) {
                    $dayWidget = $programDayRepo
                        ->findOneBy(
                            array(
                                'id' => $widget->getConferenceProgramDay()
                            )
                        );

                    if ($dayWidget) {
                        $programDays[] = $dayWidget;
                    }
                }

                usort($programDays, function($a, $b)
                {
                    return $a->getDate() > $b->getDate();
                });

                return $programDays;
            }
            return [];
        }
        return [];
    }

    public function getEventsPerDays($days)
    {
        if ($days) {
            $eventsCollection = [];
            $eventCollectionRepo = $this->em->getRepository(MdfConferenceProgramEventCollection::class);
            $eventRepo = $this->em->getRepository(MdfConferenceProgramEventTranslation::class);

            foreach ($days as $widget) {
                $dayId = $widget->getId();
                $eventCollection = $eventCollectionRepo
                    ->findBy(
                        array(
                            'conferenceProgramDay' => $dayId
                        )
                    );

                if ($eventCollection) {
                    $eventsCollection[$dayId] = [];

                    foreach ($eventCollection as $eventCollectionItem) {
                        $event = $eventRepo
                            ->getEventByLocaleAndEventId(
                                $this->requestStack->getMasterRequest()->get('_locale'),
                                $eventCollectionItem->getConferenceProgramEvent()
                            );

                        if ($event) {
                            $eventsCollection[$dayId][] = $event;
                        }
                    }
                    usort($eventsCollection[$dayId], function ($a, $b) {
                        return $a->getTranslatable()->getStartTimeEvent() > $b->getTranslatable()->getStartTimeEvent();
                    });
                }
            }
            return $eventsCollection;
        }
        return [];
    }

    public function getSpeakersPerEvent($events)
    {
        if ($events) {
            $speakersCollection = [];
            $speakerCollectionRepo = $this->em->getRepository(MdfProgramSpeakerCollection::class);
            $speakerRepo = $this->em->getRepository(MdfProgramSpeakerTranslation::class);

            foreach ($events as $widget) {
                foreach ($widget as $item)
                {
                    $eventId = $item->getTranslatable()->getId();
                    $speakerCollection = $speakerCollectionRepo
                        ->findBy(
                            array(
                                'programEvent' => $eventId
                            )
                        );

                    if ($speakerCollection) {
                        $speakersCollection[$eventId] = [];

                        foreach ($speakerCollection as $speakerCollectionItem) {
                            $speaker = $speakerRepo
                                ->getSpeakerByLocaleAndSpeakerId(
                                    $this->requestStack->getMasterRequest()->get('_locale'),
                                    $speakerCollectionItem->getProgramSpeakers()
                                );

                            if ($speaker) {
                                $speakersCollection[$eventId][] = $speaker;
                            }
                        }
                    }
                }
            }
            return $speakersCollection;
        }
        return [];
    }

    public function getContentTemplateTextWidgets($page) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetTextTranslation::class)
            ->getConferenceProgramTextWidgetsByLocaleAndPageId($this->requestStack->getMasterRequest()->get('_locale'), $page->getTranslatable()->getId());
    }

    public function getContentTemplateImageWidgets($page) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetImage::class)
            ->getConferenceProgramImageWidgetsByPageId($page->getTranslatable()->getId());
    }

    public function getContentTemplateGalleryWidgets($page) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetGallery::class)
            ->getConferenceProgramGalleryWidgetsByPageId($page->getTranslatable()->getId());
    }

    public function getContentTemplateYoutubeWidgets($page) {
        return $this->em
            ->getRepository(MdfContentTemplateWidgetVideoTranslation::class)
            ->getConferenceProgramYoutubeWidgetsByLocaleAndPageId($this->requestStack->getMasterRequest()->get('_locale'), $page->getTranslatable()->getId());
    }
    
    public function getAllConferenceTypes()
    {
        return MdfConferenceProgram::getConferences();
    }
}
