<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MdfGlobalEventsDay
 * @ORM\Table(name="mdf_global_events_day")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfGlobalEventsDay
{
    use Time;
    use SeoMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_event", type="datetime", nullable=true)
     */
    protected $dateEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="date_string",  type="string", length=255)
     */
    protected $dateString;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsSchedulesCollection", mappedBy="globalEventsDay", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $schedulesCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="MdfGlobalEventsDaysCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="day")
     */
    protected $daysCollection;

    public function __construct()
    {
        $this->schedulesCollection = new ArrayCollection();
        $this->daysCollection = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->dateEvent->format('Y-m-d');
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add schedulesCollection
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsSchedulesCollection $schedulesCollection
     * @return ServiceWidget
     */
    public function addSchedulesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsSchedulesCollection $schedulesCollection)
    {
        $schedulesCollection->setGlobalEventsDay($this);
        $this->schedulesCollection[] = $schedulesCollection;

        return $this;
    }

    /**
     * Remove schedulesCollection
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsSchedulesCollection $schedulesCollection
     */
    public function removeSchedulesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsSchedulesCollection $schedulesCollection)
    {
        $this->schedulesCollection->removeElement($schedulesCollection);
    }

    /**
     * Get schedulesCollection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchedulesCollection()
    {
        return $this->schedulesCollection;
    }

    /**
     * @return \DateTime
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * @param \DateTime $dateEvent
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;
    }

    /**
     * @return string
     */
    public function getDateString()
    {
        return $this->dateString;
    }

    /**
     * @param string $dateString
     */
    public function setDateString($dateString)
    {
        $this->dateString = $dateString;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->dateString = $this->dateEvent->format('Y-m-d');
    }

    /**
     * @param MdfGlobalEventsDaysCollection $daysCollection
     * @return $this
     */
    public function addDaysCollection(\FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDaysCollection $daysCollection)
    {
        $daysCollection->setDay($this);
        $this->daysCollection[] = $daysCollection;

        return $this;
    }

    /**
     * @param MdfGlobalEventsDaysCollection $daysCollection
     */
    public function removeDaysCollection(\FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDaysCollection $daysCollection)
    {
        $this->daysCollection->removeElement($daysCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getDaysCollection()
    {
        return $this->daysCollection;
    }
}
