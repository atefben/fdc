<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakers;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoices;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetails;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfThemeTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class SpeakersManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * @return mixed
     */
    public function getSpeakersPageByLocale($slug)
    {
        return $this->em
            ->getRepository(MdfSpeakersTranslation::class)
            ->getSpeakersPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);
    }
    
    
    public function getSpeakersTabOnPage($speakersPage)
    {
        if ($speakersPage) {
            $speakersChoicesCollectionRepo = $this->em->getRepository(MdfSpeakersChoicesCollection::class);
            $speakersChoicesRepo = $this->em->getRepository(MdfSpeakersChoicesTranslation::class);

            $speakersChoicesCollection = $speakersChoicesCollectionRepo
                ->findBy(
                    array(
                        'speakersPage' => $speakersPage->getTranslatable()->getId()
                    )
                );


            if ($speakersChoicesCollection) {
                $speakersChoices = [];
                foreach ($speakersChoicesCollection as $widget) {
                    $speakersChoice = $speakersChoicesRepo
                        ->getSpeakersChoiceWidgetByLocaleAndWidgetId(
                            $this->requestStack->getMasterRequest()->get('_locale'), $widget->getSpeakersChoice()
                        );

                    if ($speakersChoice) {
                        $speakersChoices[] = $speakersChoice;
                    }
                }
                return $speakersChoices;
            }
            return [];
        }
        return [];
    }

    public function getSpeakersList($widgets)
    {
        if ($widgets) {
            $speakersList = [];
            $speakersDetailsCollectionRepo = $this->em->getRepository(MdfSpeakersDetailsCollection::class);
            $speakersDetailsRepo = $this->em->getRepository(MdfSpeakersDetailsTranslation::class);

            foreach ($widgets as $widget) {
                $translatableId = $widget->getTranslatable()->getId();
                $speakersDetailsCollection = $speakersDetailsCollectionRepo
                    ->findBy(
                        array(
                            'speakersChoiceTab' => $translatableId
                        )
                    );

                if ($speakersDetailsCollection) {
                    $speakersList[$translatableId] = [];

                    foreach ($speakersDetailsCollection as $speakersDetailsCollectionItem) {
                        $speaker = $speakersDetailsRepo
                            ->getSpeakerByLocaleAndSpeakerId(
                                $this->requestStack->getMasterRequest()->get('_locale'),
                                $speakersDetailsCollectionItem->getSpeakersDetails()
                            );

                        if ($speaker) {
                            $speakersList[$translatableId][] = $speaker;
                        }
                    }
                }
            }
            return $speakersList;
        }
        return [];
    }
}
