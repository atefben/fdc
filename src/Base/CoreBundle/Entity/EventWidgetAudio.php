<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * EventWidgetAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventWidgetAudio extends EventWidget
{
    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaAudio")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)
     * @Groups({"event_show"})
     */
    private $file;

    /**
     * Set file
     *
     * @param MediaAudio $file
     * @return EventWidgetAudio
     */
    public function setFile(MediaAudio $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return MediaAudio
     */
    public function getFile()
    {
        return $this->file;
    }
}
