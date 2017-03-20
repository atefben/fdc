<?php

namespace FDC\CourtMetrageBundle\Entity;


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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmGallery")
     * @ORM\JoinColumn(name="gallery_id", onDelete="SET NULL")
     * @Groups({"news_show"})
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param CcmGallery $gallery
     * @return CcmNewsWidgetGallery
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
