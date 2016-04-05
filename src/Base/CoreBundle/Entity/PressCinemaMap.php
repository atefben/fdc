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
     * @ORM\OneToMany(targetEntity="PressCinemaMapRoom", mappedBy="roomMap", cascade={"persist"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $mapRoom;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple", cascade={"persist"})
     */
    protected $defaultRoomImage;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple", cascade={"persist"})
     */
    protected $defaultZoneImage;

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
     * @param \Base\CoreBundle\Entity\PressCinemaMapRoom $mapRoom
     */
    public function removeMapRoom(\Base\CoreBundle\Entity\PressCinemaMapRoom $mapRoom)
    {
        $mapRoom->setRoomMap(null);
        $mapRoom->setRoom(null);
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
     * Set defaultRoomImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $defaultRoomImage
     * @return PressCinemaMap
     */
    public function setDefaultRoomImage(\Base\CoreBundle\Entity\MediaImageSimple $defaultRoomImage = null)
    {
        $this->defaultRoomImage = $defaultRoomImage;

        return $this;
    }

    /**
     * Get defaultRoomImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getDefaultRoomImage()
    {
        return $this->defaultRoomImage;
    }

    /**
     * Set defaultZoneImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $defaultZoneImage
     * @return PressCinemaMap
     */
    public function setDefaultZoneImage(\Base\CoreBundle\Entity\MediaImageSimple $defaultZoneImage = null)
    {
        $this->defaultZoneImage = $defaultZoneImage;

        return $this;
    }

    /**
     * Get defaultZoneImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getDefaultZoneImage()
    {
        return $this->defaultZoneImage;
    }
}
