<?php

namespace Base\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressDownloadHasSection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownloadHasSection
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="PressDownloadSection", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $section;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var PressHomepage
     *
     * @ORM\ManyToOne(targetEntity="PressDownload", inversedBy="downloadSection")
     */
    protected $download;


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
     * @return PressDownloadHasSection
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
     * Set section
     *
     * @param \Base\CoreBundle\Entity\PressDownloadSection $section
     * @return PressDownloadHasSection
     */
    public function setSection(\Base\CoreBundle\Entity\PressDownloadSection $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Base\CoreBundle\Entity\PressDownloadSection 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set download
     *
     * @param \Base\CoreBundle\Entity\PressDownload $download
     * @return PressDownloadHasSection
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
