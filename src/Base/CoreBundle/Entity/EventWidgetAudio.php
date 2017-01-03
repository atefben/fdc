<?php

namespace Base\CoreBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media as File;
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
     * @var File
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaAudio")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)
     * @Groups({"event_show"})
     */
    protected $file;

    /**
     * @param MediaAudio
     * @return $this
     */
    public function setFile(MediaAudio $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }
}
