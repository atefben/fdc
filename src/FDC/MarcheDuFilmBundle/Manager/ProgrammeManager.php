<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEvents;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDaysCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDay;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsSchedulesCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsSchedule;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsScheduleTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ProgrammeManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getGlobalEventsPage()
    {
        return $this->em
            ->getRepository(MdfGlobalEventsTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    /**
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfGlobalEvents $page
     *
     * @return MdfGlobalEventsDay
     */
    public function getGlobalEventsDays($page)
    {
        if ($page) {
            $globalEventsDaysCollectionRepo = $this->em->getRepository(MdfGlobalEventsDaysCollection::class);
            $globalEventsDayRepo = $this->em->getRepository(MdfGlobalEventsDay::class);

            $globalEventsDaysCollection = $globalEventsDaysCollectionRepo
                ->findBy(
                    array(
                        'globalEvent' => $page->getTranslatable()->getId()
                    )
                );

            if ($globalEventsDaysCollection) {
                $globalEventsDays = [];
                foreach ($globalEventsDaysCollection as $day) {
                    $globalEventsDay= $globalEventsDayRepo
                        ->find(
                            $day->getDay()
                        );

                    if ($globalEventsDay) {
                        $globalEventsDays[] = $globalEventsDay;
                    }
                }
                usort($globalEventsDays, function ($a, $b) {
                    return $a->getDateEvent() > $b->getDateEvent();
                });

                return $globalEventsDays;
            }
            return [];
        }
        return [];
    }

    /**
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDay $days
     *
     * @return MdfGlobalEventsSchedule
     */
    public function getGlobalEventsSchedulesSorted($days)
    {

        if ($days) {
            $globalEventsSchedules = [];
            $globalEventsSchedulesCollectionRepo = $this->em->getRepository(MdfGlobalEventsSchedulesCollection::class);
            $globalEventsScheduleRepo = $this->em->getRepository(MdfGlobalEventsScheduleTranslation::class);

            foreach ($days as $day) {
                $translatableId = $day->getId();
                $globalEventsSchedulesCollection = $globalEventsSchedulesCollectionRepo
                    ->findBy(
                        array(
                            'globalEventsDay' => $translatableId
                        )
                    );

                if ($globalEventsSchedulesCollection) {
                    $globalEventsSchedules[$translatableId] = [];

                    foreach ($globalEventsSchedulesCollection as $item) {
                        $product = $globalEventsScheduleRepo
                            ->getScheduleByLocaleAndScheduleId(
                                $this->requestStack->getMasterRequest()->get('_locale'),
                                $item->getSchedule()
                            );

                        if ($product) {
                            $globalEventsSchedules[$translatableId][] = $product;
                        }
                    }
                    usort($globalEventsSchedules[$translatableId], function ($a, $b) {
                        return $a->getTranslatable()->getStartTimeEvent() > $b->getTranslatable()->getStartTimeEvent();
                    });
                }
            }
            return $globalEventsSchedules;
        }
        return [];
    }
}
