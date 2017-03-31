<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmProgramDay;
use FDC\CourtMetrageBundle\Entity\CcmProgramScheduleTypeTranslation;
use FDC\CourtMetrageBundle\Entity\CcmProgramTranslation;

class ProgramManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getAvailableListFilters($locale)
    {
        return $this->em
            ->getRepository(CcmProgramScheduleTypeTranslation::class)
            ->getAvailableTypes($locale);
    }

    public function getProgramPage($locale)
    {
        return $this->em
            ->getRepository(CcmProgramTranslation::class)
            ->findBy(
                array(
                    'locale' => $locale
                )
            )[0];
    }

    public function orderProgramDays($program)
    {
        $orderedDays = $program->getDaysCollection()->getValues();

        usort(
            $orderedDays,
            function ($day1, $day2) {
                $date1 = $day1->getDay()->getDateEvent();
                $date2 = $day2->getDay()->getDateEvent();

                if ($date1 == $date2) {
                    return 0;
                }

                return $date1 < $date2 ? -1 : 1;
            }
        );

        return $orderedDays;
    }
}
