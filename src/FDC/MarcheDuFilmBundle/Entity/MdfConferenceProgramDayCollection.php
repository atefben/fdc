<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceProgramDayCollection
 * @ORM\Table(name="mdf_conference_program_day_collection")
 * @ORM\Entity
 */
class MdfConferenceProgramDayCollection
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
     * @ORM\ManyToOne(targetEntity="MdfConferenceProgramDay", cascade={"all"}, inversedBy="programDayCollection")
     * @ORM\JoinColumn(name="conference_program_day_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $conferenceProgramDay;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferenceProgram", cascade={"all"}, inversedBy="dayWidgetCollections")
     * @ORM\JoinColumn(name="conference_program_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $conferenceProgram;

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
     * @return mixed
     */
    public function getConferenceProgram()
    {
        return $this->conferenceProgram;
    }

    /**
     * @param $conferenceProgram
     *
     * @return $this
     */
    public function setConferenceProgram($conferenceProgram)
    {
        $this->conferenceProgram = $conferenceProgram;

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
