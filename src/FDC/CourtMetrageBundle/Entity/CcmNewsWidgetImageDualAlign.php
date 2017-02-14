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
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GalleryDualAlign")
     * @Groups({"news_show"})
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\GalleryDualAlign $gallery
     * @return CcmNewsWidgetImageDualAlign
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
