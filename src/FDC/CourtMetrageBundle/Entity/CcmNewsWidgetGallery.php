<?php

namespace FDC\CourtMetrageBundle\Entity;


use Base\CoreBundle\Entity\Gallery;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
/**
 * CcmNewsWidgetGallery
 *
 * @ORM\Table(name="ccm_news_widget_gallery")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetGallery extends CcmNewsWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\Gallery")
     * @ORM\JoinColumn(name="gallery_id", onDelete="SET NULL")
     * @Groups({"news_show"})
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\Gallery $gallery
     * @return CcmNewsWidgetGallery
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
