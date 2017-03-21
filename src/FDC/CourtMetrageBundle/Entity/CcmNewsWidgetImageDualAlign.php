<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
/**
 * CcmNewsWidgetImageDualAlign
 *
 * @ORM\Table(name="ccm_news_widget_image_dual_align")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetImageDualAlign extends CcmNewsWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmGalleryDualAlign", cascade={"persist"})
     * @Groups({"news_show"})
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param CcmGalleryDualAlign $gallery
     * @return CcmNewsWidgetImageDualAlign
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
