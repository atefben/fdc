<?php

namespace FDC\CourtMetrageBundle\Entity;


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
     * @var CcmMediaVideo
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaVideo", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param CcmMediaVideo $file
     * @return CcmNewsWidgetVideo
     */
    public function setFile(CcmMediaVideo $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return CcmMediaVideo
     */
    public function getFile()
    {
        return $this->file;
    }
}
