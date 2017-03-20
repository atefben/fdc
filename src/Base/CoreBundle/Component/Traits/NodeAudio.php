<?php

namespace Base\CoreBundle\Component\Traits;

use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait NodeAudio
{

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $header;

    /**
     * @var MediaAudio
     *
     * @ORM\ManyToOne(targetEntity="MediaAudio", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show", "home"})
     *
     * @Assert\NotNull()
     */
    protected $audio;

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
     * Set audio
     *
     * @param MediaAudio $audio
     * @return $this
     */
    public function setAudio(MediaAudio $audio = null)
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Get audio
     *
     * @return MediaAudio
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * @return string
     */
    public function getNewsFormat()
    {
        return 'audios';
    }
}