<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventWidgetImageDualAlign
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventWidgetImageDualAlign extends EventWidget
{
    /**
     * @var Gallery
     * @ORM\ManyToOne(targetEntity="Gallery")
     */
    private $gallery;

    /**
     * Set gallery
     *
     * @param Gallery $gallery
     * @return EventWidgetImage
     */
    public function setGallery(Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
