<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * NewsWidgetImage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsWidgetImage extends NewsWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="newsWidgetImages")
     */
    private $gallery;

    /**
     * Set gallery
     *
     * @param \FDC\CoreBundle\Entity\Gallery $gallery
     * @return NewsWidgetImage
     */
    public function setGallery(\FDC\CoreBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \FDC\CoreBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
