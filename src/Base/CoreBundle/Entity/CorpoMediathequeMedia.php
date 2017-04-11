<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CorpoMediathequeMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CorpoMediathequeMedia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="CorpoMediatheque", inversedBy="medias")
     */
    protected $mediatheque;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"all"})
     */
    protected $photo;

    /**
     * @ORM\ManyToOne(targetEntity="MediaVideo", cascade={"all"})
     */
    protected $video;

    /**
     * @ORM\ManyToOne(targetEntity="MediaAudio", cascade={"all"})
     */
    protected $audio;
    
    /**
     * @ORM\Column(type="smallint")
     */
    protected $position;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mediatheque
     *
     * @param \Base\CoreBundle\Entity\CorpoMediatheque $mediatheque
     * @return CorpoMediathequeMedia
     */
    public function setMediatheque(\Base\CoreBundle\Entity\CorpoMediatheque $mediatheque = null)
    {
        $this->mediatheque = $mediatheque;

        return $this;
    }

    /**
     * Get mediatheque
     *
     * @return \Base\CoreBundle\Entity\CorpoMediatheque 
     */
    public function getMediatheque()
    {
        return $this->mediatheque;
    }

    /**
     * Get media
     *
     * @return \Base\CoreBundle\Entity\Media
     */
    public function getMedia()
    {
        if($this->photo) {
            return $this->getPhoto();
        }

        if($this->video) {
            return $this->getVideo();
        }

        if($this->audio) {
            return $this->getAudio();
        }
    }

    /**
     * Set photo
     *
     * @param \Base\CoreBundle\Entity\MediaImage $photo
     * @return CorpoMediathequeMediaImage
     */
    public function setPhoto(\Base\CoreBundle\Entity\MediaImage $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Base\CoreBundle\Entity\MediaImage
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set video
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $video
     * @return CorpoMediathequeMediaVideo
     */
    public function setVideo(\Base\CoreBundle\Entity\MediaVideo $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \Base\CoreBundle\Entity\MediaVideo 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set audio
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $audio
     * @return CorpoMediathequeMediaAudio
     */
    public function setAudio(\Base\CoreBundle\Entity\MediaAudio $audio = null)
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Get audio
     *
     * @return \Base\CoreBundle\Entity\MediaAudio 
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * Set position
     *
     * @param $position
     * @return CorpoMediathequeMedia
     */
    public function setPosition($position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return CorpoMediathequeMedia
     */
    public function getPosition()
    {
        return $this->position;
    }
}
