<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Entity\MediaAudio;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * CcmNewsWidgetAudio
 *
 * @ORM\Table(name="ccm_news_widget_audio")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetAudio extends CcmNewsWidget
{
    /**
     * @var MediaAudio
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaAudio", cascade={"all"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $file
     * @return CcmNewsWidgetAudio
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
