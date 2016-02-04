<?php

namespace Base\CoreBundle\Entity;

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
     * @var PressDownloadSectionWidget
     *
     * @ORM\OneToMany(targetEntity="PressDownloadSectionWidget", mappedBy="pressDownload", cascade={"persist"})
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $widgets;

    /**
     * @var PressDownload
     *
     * @ORM\ManyToOne(targetEntity="PressDownload", inversedBy="section")
     */
    protected $download;

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

        $widgets->setDownload($this);
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
     * Set download
     *
     * @param \Base\CoreBundle\Entity\PressDownload $download
     * @return PressDownloadSection
     */
    public function setDownload(\Base\CoreBundle\Entity\PressDownload $download = null)
    {
        $this->download = $download;

        return $this;
    }

    /**
     * Get download
     *
     * @return \Base\CoreBundle\Entity\PressDownload
     */
    public function getDownload()
    {
        return $this->download;
    }
    
}
