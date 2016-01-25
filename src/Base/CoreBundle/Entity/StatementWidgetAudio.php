<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * StatementWidgetAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementWidgetAudio extends StatementWidget
{
    /**
     *
     * @ORM\ManyToOne(targetEntity="MediaAudio")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)
     */
    private $file;

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\Media $file
     * @return StatementWidgetAudio
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
