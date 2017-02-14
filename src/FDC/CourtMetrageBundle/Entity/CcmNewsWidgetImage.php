<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Entity\Gallery;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
/**
 * CcmNewsWidgetImage
 *
 * @ORM\Table(name="ccm_news_widget_image")
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\NewsWidgetImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetImage extends CcmNewsWidget
{
    /**
     * @var Gallery
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\Gallery", cascade={"all"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param Gallery $gallery
     * @return CcmNewsWidgetImage
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
