<?php

namespace FDC\CourtMetrageBundle\Entity;


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
     * @var CcmMediaVideo
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaVideo")
     */
    protected $file;

    /**
     * Set file
     *
     * @param CcmMediaVideo $file
     * @return CcmShortFilmCornerWidgetVideo
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
