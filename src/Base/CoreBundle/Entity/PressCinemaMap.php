<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressCinemaMap
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressCinemaMap
{
    use Translatable;
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
     * @var PressCinemaMapRoom
     * @ORM\OneToMany(targetEntity="PressCinemaMapRoom", mappedBy="roomMap", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $mapRoom;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="MediaImage", cascade={"persist"})
     */
    protected $zoneImage;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->mapRoom = new ArrayCollection();
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
     * Add mapRoom
     *
     * @param \Base\CoreBundle\Entity\PressCinemaMapRoom $mapRoom
     * @return PressCinemaMap
     */
    public function addMapRoom(\Base\CoreBundle\Entity\PressCinemaMapRoom $mapRoom)
    {
        $mapRoom->setRoomMap($this);
        $this->mapRoom->add($mapRoom);

        return $this;
    }

    /**
     * Remove mapRoom
     *
     * @param \Base\CoreBundle\Entity\PressCinemaRoom $mapRoom
     */
    public function removeMapRoom(\Base\CoreBundle\Entity\PressCinemaRoom $mapRoom)
    {
        $this->mapRoom->removeElement($mapRoom);
    }

    /**
     * Get mapRoom
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMapRoom()
    {
        return $this->mapRoom;
    }

    /**
     * Set zoneImage
     *
     * @param \Base\CoreBundle\Entity\MediaImage $zoneImage
     * @return PressCinemaMap
     */
    public function setZoneImage(\Base\CoreBundle\Entity\MediaImage $zoneImage = null)
    {
        $this->zoneImage = $zoneImage;

        return $this;
    }

    /**
     * Get zoneImage
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getZoneImage()
    {
        return $this->zoneImage;
    }
}
