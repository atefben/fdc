<?php

namespace Base\CoreBundle\Component\Traits;

use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaVideo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait NodeVideo
{

    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="MediaVideo", cascade={"persist"})
     * @Groups({"news_show", "news_list", "search", "home"})
     *
     * @Assert\NotNull()
     */
    protected $video;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $image;

    /**
     * Set video
     *
     * @param MediaVideo $video
     * @return $this
     */
    public function setVideo(MediaVideo $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return MediaVideo
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set image
     *
     * @param MediaImage $image
     * @return $this
     */
    public function setImage(MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Get header
     *
     * @return MediaImage
     */
    public function getHeader()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getNewsFormat()
    {
        return 'videos';
    }
}