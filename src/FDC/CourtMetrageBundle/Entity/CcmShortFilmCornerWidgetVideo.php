<?php

namespace FDC\CourtMetrageBundle\Entity;


use Base\CoreBundle\Entity\MediaVideo;
use Doctrine\ORM\Mapping as ORM;
/**
 * NewsWidgetVideo
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_video")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetVideo extends CcmShortFilmCornerWidget
{
    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaVideo")
     */
    protected $file;

    /**
     * Set file
     *
     * @param MediaVideo $file
     * @return CcmShortFilmCornerWidgetVideo
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
