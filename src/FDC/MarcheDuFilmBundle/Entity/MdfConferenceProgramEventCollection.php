<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceProgramEventCollection
 * @ORM\Table(name="mdf_conference_program_event_collection")
 * @ORM\Entity
 */
class MdfConferenceProgramEventCollection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferenceProgramEvent", inversedBy="programEventCollection")
     * @ORM\JoinColumn(name="conference_program_event_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $conferenceProgramEvent;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferenceProgramDay", inversedBy="eventWidgetCollections")
     * @ORM\JoinColumn(name="conference_program_day_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $conferenceProgramDay;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getConferenceProgramEvent()
    {
        return $this->conferenceProgramEvent;
    }

    /**
     * @param $conferenceProgramEvent
     *
     * @return $this
     */
    public function setConferenceProgramEvent($conferenceProgramEvent)
    {
        $this->conferenceProgramEvent = $conferenceProgramEvent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConferenceProgramDay()
    {
        return $this->conferenceProgramDay;
    }

    /**
     * @param $conferenceProgramDay
     *
     * @return $this
     */
    public function setConferenceProgramDay($conferenceProgramDay)
    {
        $this->conferenceProgramDay = $conferenceProgramDay;

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
     * @param $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}