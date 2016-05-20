<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * GalleryMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryMedia
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImage")
     * @Groups({"news_list", "search", "news_show", "event_show", "home"})
     */
    private $media;
    
    /**
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="medias")
     */
    private $gallery;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;


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
     * Set media
     *
     * @param \Base\CoreBundle\Entity\MediaImage $media
     * @return GalleryMedia
     */
    public function setMedia(\Base\CoreBundle\Entity\MediaImage $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Base\CoreBundle\Entity\MediaImage
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set widget
     *
     * @param \Base\CoreBundle\Entity\Gallery $widget
     * @return GalleryMedia
     */
    public function setGallery(\Base\CoreBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return GalleryMedia
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
