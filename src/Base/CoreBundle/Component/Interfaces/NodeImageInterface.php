<?php

namespace Base\CoreBundle\Component\Interfaces;

use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\MediaImage;

interface NodeImageInterface
{
    /**
     * @return MediaImage
     */
    public function getHeader();

    /**
     * @param MediaImage|null $header
     * @return $this
     */
    public function setHeader(MediaImage $header = null);

    /**
     * Set gallery
     *
     * @param Gallery $gallery
     * @return $this
     */
    public function setGallery(Gallery $gallery = null);

    /**
     * Get gallery
     *
     * @return Gallery
     */
    public function getGallery();

    /**
     * @return string
     */
    public function getNewsFormat();
}
