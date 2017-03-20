<?php

namespace FDC\CourtMetrageBundle\Entity;


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
     * @var CcmMediaImage
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage", cascade={"persist"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param CcmMediaImage $file
     * @return CcmShortFilmCornerWidgetImage
     */
    public function setFile(CcmMediaImage $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return CcmMediaImage
     */
    public function getFile()
    {
        return $this->file;
    }
}
