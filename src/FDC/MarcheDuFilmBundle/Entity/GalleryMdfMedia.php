<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * GalleryMdfMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryMdfMedia
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
     * @ORM\ManyToOne(targetEntity="MediaMdfImage", inversedBy="galleryMdfMedia")
     * @Groups({"news_list", "search", "news_show", "event_show", "home"})
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $media;
    
    /**
     * @ORM\ManyToOne(targetEntity="GalleryMdf", inversedBy="medias")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", onDelete="SET NULL")
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
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $media
     * @return GalleryMdfMedia
     */
    public function setMedia(\FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set widget
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\GalleryMdf $widget
     * @return GalleryMdfMedia
     */
    public function setGallery(\FDC\MarcheDuFilmBundle\Entity\GalleryMdf $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\GalleryMdf
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return GalleryMdfMedia
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
