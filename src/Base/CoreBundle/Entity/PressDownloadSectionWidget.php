<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * PressDownloadSectionWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "document" = "PressDownloadSectionWidgetDocument",
 *  "video" = "PressDownloadSectionWidgetVideo",
 *  "photo" = "PressDownloadSectionWidgetPhoto",
 *  "file" = "PressDownloadSectionWidgetFile",
 * })
 */
abstract class PressDownloadSectionWidget
{

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var PressDownloadSection
     *
     * @ORM\ManyToOne(targetEntity="PressDownloadSection", inversedBy="widgets")
     */
    protected $pressDownload;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     *
     */
    private $lockedContent;

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
     * Set lockedContent
     *
     * @param boolean $lockedContent
     * @return PressDownloadSectionWidget
     */
    public function setLockedContent($lockedContent)
    {
        $this->lockedContent = $lockedContent;

        return $this;
    }

    /**
     * Get lockedContent
     *
     * @return boolean 
     */
    public function getLockedContent()
    {
        return $this->lockedContent;
    }

    /**
     * Set pressDownload
     *
     * @param \Base\CoreBundle\Entity\PressDownloadSection $pressDownload
     * @return PressDownloadSectionWidget
     */
    public function setPressDownload(\Base\CoreBundle\Entity\PressDownloadSection $pressDownload = null)
    {
        $this->pressDownload = $pressDownload;

        return $this;
    }

    /**
     * Get pressDownload
     *
     * @return \Base\CoreBundle\Entity\PressDownloadSection 
     */
    public function getPressDownload()
    {
        return $this->pressDownload;
    }
}
