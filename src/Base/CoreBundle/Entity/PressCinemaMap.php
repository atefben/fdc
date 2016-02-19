<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

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
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

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
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return PressCinemaMap
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }
}
