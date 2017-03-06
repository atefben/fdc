<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Util\Time;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CcmProgramDay
 * 
 * @ORM\Table(name="ccm_program_day")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmProgramDay
{
    use Time;

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
     * @ORM\Column(name="date_string",  type="string", length=255, nullable=true)
     */
    protected $dateString;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CcmProgramSchedulesCollection", mappedBy="programDay", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $schedulesCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CcmProgramDaysCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="day")
     */
    protected $daysCollection;

    public function __construct()
    {
        $this->schedulesCollection = new ArrayCollection();
        $this->daysCollection = new ArrayCollection();
    }

    public function __toString()
    {
        $string = '';

        if ($this->dateEvent) {
            $string = $this->dateEvent->format('Y-m-d');
        }

        return $string;
    }

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
     * Add schedulesCollection
     *
     * @param CcmProgramSchedulesCollection $schedulesCollection
     * 
     * @return $this
     */
    public function addSchedulesCollection(CcmProgramSchedulesCollection $schedulesCollection)
    {
        $schedulesCollection->setProgramDay($this);
        $this->schedulesCollection[] = $schedulesCollection;

        return $this;
    }

    /**
     * Remove schedulesCollection
     *
     * @param CcmProgramSchedulesCollection $schedulesCollection
     */
    public function removeSchedulesCollection(CcmProgramSchedulesCollection $schedulesCollection)
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
     * @param $dateEvent
     * 
     * @return $this
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;
        
        return $this;
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
     * 
     * @return $this
     */
    public function setDateString($dateString)
    {
        $this->dateString = $dateString;
        
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->dateString = $this->dateEvent->format('Y-m-d');
    }

    /**
     * @param CcmProgramDaysCollection $daysCollection
     * 
     * @return $this
     */
    public function addDaysCollection(CcmProgramDaysCollection $daysCollection)
    {
        $daysCollection->setDay($this);
        $this->daysCollection[] = $daysCollection;

        return $this;
    }

    /**
     * @param CcmProgramDaysCollection $daysCollection
     */
    public function removeDaysCollection(CcmProgramDaysCollection $daysCollection)
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
