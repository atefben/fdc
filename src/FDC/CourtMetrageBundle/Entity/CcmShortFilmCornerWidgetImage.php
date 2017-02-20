<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Entity\Gallery;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
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
     * @var Gallery
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\Gallery", cascade={"all"})
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param Gallery $gallery
     * @return CcmShortFilmCornerWidgetImage
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
