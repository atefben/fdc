<?php

namespace Base\CoreBundle\Component\Traits;

use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait NodeImage
{

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $header;

    /**
     * @ORM\ManyToOne(targetEntity="Gallery")
     * @Groups({"news_list", "search", "news_show", "home"})
     *
     * @Assert\NotNull()
     */
    protected $gallery;

    /**
     * Set header
     *
     * @param MediaImage $header
     * @return $this
     */
    public function setHeader(MediaImage $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return MediaImage
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set gallery
     *
     * @param Gallery $gallery
     * @return $this
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

    /**
     * @return string
     */
    public function getNewsFormat()
    {
        return 'photos';
    }
}