<?php

namespace FDC\CourtMetrageBundle\Entity;


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
     * @var CcmMediaAudio
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaAudio", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param CcmMediaAudio $file
     * @return CcmNewsWidgetAudio
     */
    public function setFile(CcmMediaAudio $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return CcmMediaAudio 
     */
    public function getFile()
    {
        return $this->file;
    }
}
