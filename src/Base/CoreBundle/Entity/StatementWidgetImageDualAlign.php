<?php

namespace Base\CoreBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Entity\StatementWidget;
use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
/**
 * StatementWidgetImageDualAlign
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementWidgetImageDualAlign extends StatementWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="GalleryDualAlign")
     * @Groups({"news_list", "news_show"})
     */
    private $gallery;

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\GalleryDualAlign $gallery
     * @return NewsWidgetImageDualAlign
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
