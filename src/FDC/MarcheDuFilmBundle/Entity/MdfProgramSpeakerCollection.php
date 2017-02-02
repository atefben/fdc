<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfProgramSpeakersCollection
 * @ORM\Table(name="mdf_program_speakers_collection")
 * @ORM\Entity
 */
class MdfProgramSpeakerCollection
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
     * @ORM\ManyToOne(targetEntity="MdfProgramSpeaker", inversedBy="programSpeakerCollection")
     * @Assert\Count(
     *      max = "8",
     *      maxMessage = "validation.speakers_max"
     * )
     * @ORM\JoinColumn(name="program_speakers_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $programSpeakers;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferenceProgramEvent", inversedBy="speakersCollections")
     * @ORM\JoinColumn(name="program_event_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $programEvent;

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
    public function getProgramSpeakers()
    {
        return $this->programSpeakers;
    }

    /**
     * @param $programSpeakers
     *
     * @return $this
     */
    public function setProgramSpeakers($programSpeakers)
    {
        $this->programSpeakers = $programSpeakers;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProgramEvent()
    {
        return $this->programEvent;
    }

    /**
     * @param $programEvent
     *
     * @return $this
     */
    public function setProgramEvent($programEvent)
    {
        $this->programEvent = $programEvent;

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
