<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * InfoWidgetAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class InfoWidgetAudio extends InfoWidget
{
    /**
     *
     * @ORM\ManyToOne(targetEntity="MediaAudio")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)
     * @Groups({"news_show"})
     */
    private $file;

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\Media $file
     * @return InfoWidgetAudio
     */
    public function setFile(\Base\CoreBundle\Entity\Media $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Base\CoreBundle\Entity\Media
     */
    public function getFile()
    {
        return $this->file;
    }
}
