<?php

namespace Base\CoreBundle\Component\Interfaces;

use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaVideo;

interface NodeVideoInterface
{

    /**
     * @return MediaVideo
     */
    public function getVideo();

    /**
     * @param MediaVideo $video
     * @return $this
     */
    public function setVideo(MediaVideo $video);

    /**
     * @return MediaImage
     */
    public function getImage();

    /**
     * Alias of getImage
     * @return MediaImage
     */
    public function getHeader();

    /**
     * @param MediaImage|null $header
     * @return $this
     */
    public function setImage(MediaImage $header = null);

    /**
     * @return string
     */
    public function getNewsFormat();
}
