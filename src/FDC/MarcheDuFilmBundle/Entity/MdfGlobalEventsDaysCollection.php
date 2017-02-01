<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfGlobalEventsDaysCollection
 *
 * @ORM\Table(name="mdf_global_events_days_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfGlobalEventsDaysCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDay", inversedBy="daysCollection")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfGlobalEvents", inversedBy="daysCollection")
     * * @Assert\Count(
     *      min = "1",
     *      minMessage = "validation.schedule_min"
     * )
     */
    private $globalEvent;

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
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getGlobalEvent()
    {
        return $this->globalEvent;
    }

    /**
     * @param mixed $globalEvent
     */
    public function setGlobalEvent($globalEvent)
    {
        $this->globalEvent = $globalEvent;
    }
}
