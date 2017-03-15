<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Entity\Gallery;
/**
 * CcmShortFilmCornerWidgetGallery
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_gallery")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetGallery extends CcmShortFilmCornerWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\Gallery")
     * @ORM\JoinColumn(name="gallery_id", onDelete="SET NULL")
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\Gallery $gallery
     * @return CcmShortFilmCornerWidgetGallery
     */
    public function setGallery(Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
