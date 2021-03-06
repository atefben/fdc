<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
/**
 * NewsWidgetImage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\NewsWidgetImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class NewsWidgetImage extends NewsWidget
{
    /**
     * @var Gallery
     * @ORM\ManyToOne(targetEntity="Gallery", cascade={"all"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $gallery;

    /**
     * Set gallery
     *
     * @param Gallery $gallery
     * @return NewsWidgetImage
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
