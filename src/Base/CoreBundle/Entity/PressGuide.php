<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressGuide
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressGuide
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
     * @var string
     *
     * @ORM\Column(name="guide_icon", type="string", length=122)
     */
    protected $guideIcon;

    /**
     * @var PressGuideWidget
     *
     * @ORM\OneToMany(targetEntity="PressGuideWidget", mappedBy="PressGuide", cascade={"persist"})
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $widgets;


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
        $this->widgets = new ArrayCollection();
    }

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
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
     * Set guideIcon
     *
     * @param string $guideIcon
     * @return PressGuide
     */
    public function setGuideIcon($guideIcon)
    {
        $this->guideIcon = $guideIcon;

        return $this;
    }

    /**
     * Get guideIcon
     *
     * @return string 
     */
    public function getGuideIcon()
    {
        return $this->guideIcon;
    }

    /**
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $widgets
     * @return PressGuide
     */
    public function addWidget(\Base\CoreBundle\Entity\PressGuideWidget $widgets)
    {
        $widgets->setPressGuide($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\PressGuideWidget $widgets)
    {
        $this->widgets->removeElement($widgets);
    }

    /**
     * Get widgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWidgets()
    {
        return $this->widgets;
    }
}
