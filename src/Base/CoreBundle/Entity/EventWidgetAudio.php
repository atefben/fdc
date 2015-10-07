<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

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
     * @var Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="newsWidgetAudios")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)
     */
    private $file;

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return NewsWidgetAudio
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFile()
    {
        return $this->file;
    }
}
