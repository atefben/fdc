<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * NewsWidgetImageDualAlign
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsWidgetImageDualAlign extends NewsWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="GalleryDualAlign")
     */
    private $gallery;

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\GalleryDualAlign $gallery
     * @return NewsWidgetImageDualAlign
     */
    public function setGallery(\Base\CoreBundle\Entity\GalleryDualAlign $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\GalleryDualAlign 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
