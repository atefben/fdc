<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * NewsWidgetAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsWidgetAudio extends NewsWidget
{
    /**
     * @var MediaAudio
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaAudio")
     */
    private $file;

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $file
     * @return NewsWidgetAudio
     */
    public function setFile(\Base\CoreBundle\Entity\MediaAudio $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Base\CoreBundle\Entity\MediaAudio 
     */
    public function getFile()
    {
        return $this->file;
    }
}
