<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * CcmShortFilmCornerWidgetImageDualAlign
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_image_dual_align")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetImageDualAlign extends CcmShortFilmCornerWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmGalleryDualAlign")
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param CcmGalleryDualAlign $gallery
     * @return CcmShortFilmCornerWidgetImageDualAlign
     */
    public function setGallery(CcmGalleryDualAlign $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return CcmGalleryDualAlign 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
