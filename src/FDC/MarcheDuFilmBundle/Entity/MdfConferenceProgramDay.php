<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceProgramDay
 * @ORM\Table(name="mdf_conference_program_day")
 * @ORM\Entity
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
}
