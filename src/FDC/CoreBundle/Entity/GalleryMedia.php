<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

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
     */
    private $media;
    
    /**
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="medias")
     */
    private $gallery;

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
     * @param \FDC\CoreBundle\Entity\MediaImage $media
     * @return GalleryMedia
     */
    public function setMedia(\FDC\CoreBundle\Entity\MediaImage $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \FDC\CoreBundle\Entity\MediaImage 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set widget
     *
     * @param \FDC\CoreBundle\Entity\Gallery $widget
     * @return GalleryMedia
     */
    public function setGallery(\FDC\CoreBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \FDC\CoreBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
