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
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GalleryDualAlign")
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\GalleryDualAlign $gallery
     * @return CcmShortFilmCornerWidgetImageDualAlign
     */
    public function setGallery(\Base\CoreBundle\Entity\GalleryDualAlign $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\GalleryDualAlign 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
