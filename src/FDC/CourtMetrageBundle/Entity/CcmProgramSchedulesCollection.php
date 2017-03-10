<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;

/**
 * CcmProgramSchedulesCollection
 *
 * @ORM\Table(name="ccm_program_schedules_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmProgramSchedulesCollection
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
     * @ORM\ManyToOne(targetEntity="CcmProgramSchedule", inversedBy="schedulesCollection")
     * @ORM\JoinColumn(name="schedule_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $schedule;

    /**
     * @ORM\ManyToOne(targetEntity="CcmProgramDay", inversedBy="schedulesCollection")
     * @ORM\JoinColumn(name="program_day_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $programDay;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

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
     * @return CcmProgramSchedule
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param mixed $schedule
     * 
     * @return $this
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
        
        return $this;
    }

    /**
     * @return CcmProgramDay
     */
    public function getProgramDay()
    {
        return $this->programDay;
    }

    /**
     * @param CcmProgramDay $programDay
     * 
     * @return $this
     */
    public function setProgramDay(CcmProgramDay $programDay)
    {
        $this->programDay = $programDay;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
