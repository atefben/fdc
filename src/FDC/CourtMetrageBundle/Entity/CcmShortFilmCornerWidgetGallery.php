<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmGallery")
     * @ORM\JoinColumn(name="gallery_id", onDelete="SET NULL")
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param CcmGallery $gallery
     * @return CcmShortFilmCornerWidgetGallery
     */
    public function setGallery(CcmGallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return CcmGallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
