<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;

/**
 * PressCinemaMap
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressCinemaMap implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;
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

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

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
     * @param \Base\CoreBundle\Entity\MediaImageSimple $zoneImage
     * @return PressCinemaMap
     */
    public function setZoneImage(\Base\CoreBundle\Entity\MediaImageSimple $zoneImage = null)
    {
        $this->zoneImage = $zoneImage;

        return $this;
    }

    /**
     * Get zoneImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getZoneImage()
    {
        return $this->zoneImage;
    }
}
