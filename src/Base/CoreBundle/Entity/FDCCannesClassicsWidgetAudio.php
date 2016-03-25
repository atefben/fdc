<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FDCCannesClassicsWidgetAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCCannesClassicsWidgetAudio extends FDCCannesClassicsWidget
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
     * @return FDCCannesClassicsWidgetAudio
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
