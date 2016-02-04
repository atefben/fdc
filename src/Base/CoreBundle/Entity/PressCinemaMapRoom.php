<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressCinemaMapRoom
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressCinemaMapRoom
{
    use Time;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var PressCinemaRoom
     * @ORM\OneToOne(targetEntity="PressCinemaRoom")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $room;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var PressHomepage
     *
     * @ORM\ManyToOne(targetEntity="PressCinemaMap", inversedBy="mapRoom")
     */
    protected $roomMap;


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
     * Set position
     *
     * @param integer $position
     * @return PressCinemaMapRoom
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set room
     *
     * @param \Base\CoreBundle\Entity\PressCinemaRoom $room
     * @return PressCinemaMapRoom
     */
    public function setRoom(\Base\CoreBundle\Entity\PressCinemaRoom $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Base\CoreBundle\Entity\PressCinemaRoom 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set roomMap
     *
     * @param \Base\CoreBundle\Entity\PressCinemaMap $roomMap
     * @return PressCinemaMapRoom
     */
    public function setRoomMap(\Base\CoreBundle\Entity\PressCinemaMap $roomMap = null)
    {
        $this->roomMap = $roomMap;

        return $this;
    }

    /**
     * Get roomMap
     *
     * @return \Base\CoreBundle\Entity\PressCinemaMap 
     */
    public function getRoomMap()
    {
        return $this->roomMap;
    }
}
