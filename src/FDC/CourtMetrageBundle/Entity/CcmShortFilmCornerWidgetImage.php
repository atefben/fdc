<?php

namespace FDC\CourtMetrageBundle\Entity;


use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;
/**
 * CcmShortFilmCornerWidgetImage
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_image")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetImage extends CcmShortFilmCornerWidget
{
    /**
     * @var MediaImage
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage", cascade={"persist"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param MediaImage $file
     * @return CcmShortFilmCornerWidgetImage
     */
    public function setFile(MediaImage $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return MediaImage
     */
    public function getFile()
    {
        return $this->file;
    }
}
