<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * CcmShortFilmCornerWidgetAudio
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_audio")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetAudio extends CcmShortFilmCornerWidget
{
    /**
     * @var CcmMediaAudio
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaAudio", cascade={"persist"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param CcmMediaAudio $file
     * @return CcmShortFilmCornerWidgetAudio
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
