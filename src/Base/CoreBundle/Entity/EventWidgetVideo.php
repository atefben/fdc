<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;


/**
 * EventWidgetVideo
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventWidgetVideo extends EventWidget
{
    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     * @Groups({"event_show"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param MediaVideo $file
     * @return $this
     */
    public function setFile(MediaVideo $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return MediaVideo
     */
    public function getFile()
    {
        return $this->file;
    }
}
