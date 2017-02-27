<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Entity\MediaVideo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * NewsWidgetVideo
 *
 * @ORM\Table(name="ccm_news_widget_video")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetVideo extends CcmNewsWidget
{
    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaVideo", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param MediaVideo $file
     * @return CcmNewsWidgetVideo
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
