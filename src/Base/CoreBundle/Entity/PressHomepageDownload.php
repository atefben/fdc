<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressHomepageDownload
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressHomepageDownload
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
     * @ORM\OneToOne(targetEntity="PressDownloadSection", cascade={"persist"})
     */
    protected $download;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var PressHomepage
     *
     * @ORM\ManyToOne(targetEntity="PressHomepage", inversedBy="homeDownload")
     */
    protected $homepage;


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
     * @return PressHomepageDownload
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
     * Set download
     *
     * @param \Base\CoreBundle\Entity\PressDownloadSection $download
     * @return PressHomepageDownload
     */
    public function setDownload(\Base\CoreBundle\Entity\PressDownloadSection $download = null)
    {
        $this->download = $download;

        return $this;
    }

    /**
     * Get download
     *
     * @return \Base\CoreBundle\Entity\PressDownloadSection 
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\PressHomepage $homepage
     * @return PressHomepageDownload
     */
    public function setHomepage(\Base\CoreBundle\Entity\PressHomepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\PressHomepage 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }
}
