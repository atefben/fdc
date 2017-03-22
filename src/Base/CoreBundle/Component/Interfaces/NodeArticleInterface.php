<?php

namespace Base\CoreBundle\Component\Interfaces;

use Base\CoreBundle\Entity\MediaImage;

interface NodeArticleInterface
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
     * @return string
     */
    public function getNewsFormat();
}
