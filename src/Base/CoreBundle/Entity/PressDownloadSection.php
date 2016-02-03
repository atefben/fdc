<?php

namespace Base\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PressDownloadSection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownloadSection implements TranslateMainInterface
{
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
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var PressDownloadSectionWidget
     *
     * @ORM\OneToMany(targetEntity="PressDownloadSectionWidget", mappedBy="pressDownload", cascade={"persist"})
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
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\PressDownloadSectionWidget $widgets
     * @return PressDownloadSection
     */
    public function addWidget(\Base\CoreBundle\Entity\PressDownloadSectionWidget $widgets)
    {

        $widgets->setPressDownload($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\PressDownloadSectionWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\PressDownloadSectionWidget $widgets)
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

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
