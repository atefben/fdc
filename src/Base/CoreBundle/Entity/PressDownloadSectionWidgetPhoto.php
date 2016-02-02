<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use Base\CoreBundle\Util\Time;

/**
 * PressDownloadSectionWidgetPhoto
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownloadSectionWidgetPhoto extends PressDownloadSectionWidget
{

    /**
     * @ORM\ManyToOne(targetEntity="Gallery")
     */
    private $gallery;

    /**
     * Constructor
     */
    public function __construct()
    {
    }


    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\Gallery $gallery
     * @return PressDownloadSectionWidgetPhoto
     */
    public function setGallery(\Base\CoreBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
