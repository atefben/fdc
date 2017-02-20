<?php

namespace FDC\CourtMetrageBundle\Entity;


use Base\CoreBundle\Entity\MediaAudio;
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
     * @var MediaAudio
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaAudio", cascade={"all"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $file
     * @return CcmShortFilmCornerWidgetAudio
     */
    public function setFile(MediaAudio $file = null)
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
