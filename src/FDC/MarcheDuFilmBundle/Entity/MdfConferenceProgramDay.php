<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceProgramDay
 * @ORM\Table(name="mdf_conference_program_day")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfConferenceProgramDayRepository")
 */
class MdfConferenceProgramDay
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    protected $date;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventCollection", mappedBy="conferenceProgramDay", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $eventWidgetCollections;

    /**
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramDayCollection", mappedBy="conferenceProgramDay")
     */
    protected $programDayCollection;

    public function __construct()
    {
        $this->programDayCollection = new ArrayCollection();
        $this->eventWidgetCollections = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param MdfConferenceProgramEventCollection $widgets
     *
     * @return $this
     */
    public function addEventWidgetCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventCollection $widgets)
    {
        $widgets->setConferenceProgramDay($this);
        $this->eventWidgetCollections[] = $widgets;

        return $this;
    }

    /**
     * @param MdfConferenceProgramEventCollection $widgets
     */
    public function removeEventWidgetCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventCollection $widgets)
    {
        $this->eventWidgetCollections->removeElement($widgets);
    }

    /**
     * @return ArrayCollection
     */
    public function getEventWidgetCollections()
    {
        return $this->eventWidgetCollections;
    }

    public function __toString()
    {
        return (string) $this->date->format('Y-m-d');
    }

    /**
     * @param MdfConferenceProgramDayCollection $programDayCollection
     * @return $this
     */
    public function addProgramDayCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramDayCollection $programDayCollection)
    {
        $programDayCollection->setConferenceProgramDay($this);
        $this->programDayCollection[] = $programDayCollection;

        return $this;
    }

    /**
     * @param MdfConferenceProgramDayCollection $programDayCollection
     */
    public function removeProgramDayCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramDayCollection $programDayCollection)
    {
        $this->programDayCollection->removeElement($programDayCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getProgramDayCollection()
    {
        return $this->programDayCollection;
    }
}
