<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * EventWidgetImage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventWidgetImage extends EventWidget
{
    /**
     * @var Gallery
     * @ORM\ManyToOne(targetEntity="Gallery")
     * @Groups({"event_show"})
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
