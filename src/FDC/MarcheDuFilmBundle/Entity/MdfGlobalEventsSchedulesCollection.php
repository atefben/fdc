<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * MdfGlobalEventsSchedulesCollection
 *
 * @ORM\Table(name="mdf_global_events_schedules_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfGlobalEventsSchedulesCollection
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsSchedule", inversedBy="schedulesCollection")
     * @ORM\JoinColumn(name="schedule_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $schedule;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDay", inversedBy="schedulesCollection")
     * @ORM\JoinColumn(name="global_events_day_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $globalEventsDay;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param mixed $schedule
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return mixed
     */
    public function getGlobalEventsDay()
    {
        return $this->globalEventsDay;
    }

    /**
     * @param mixed $globalEventsDay
     */
    public function setGlobalEventsDay($globalEventsDay)
    {
        $this->globalEventsDay = $globalEventsDay;
    }
}
