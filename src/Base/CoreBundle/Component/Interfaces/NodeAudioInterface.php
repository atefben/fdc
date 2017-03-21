<?php

namespace Base\CoreBundle\Component\Interfaces;

use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaImage;

interface NodeAudioInterface
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
     * Set audio
     * @param MediaAudio $audio
     * @return $this
     */
    public function setAudio(MediaAudio $audio = null);

    /**
     * Get audio
     *
     * @return MediaAudio
     */
    public function getAudio();

    /**
     * @return string
     */
    public function getNewsFormat();
}
