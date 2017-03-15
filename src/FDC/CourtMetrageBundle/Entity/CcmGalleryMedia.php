<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;

/**
 * CcmGalleryMedia
 *
 * @ORM\Table(name="ccm_gallery_media")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmGalleryMedia
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage", cascade={"persist"}, inversedBy="galleries")
     */
    protected $media;
    
    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmGallery", inversedBy="medias")
     */
    protected $gallery;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
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
     * Set media
     *
     * @param CcmMediaImage $media
     * @return CcmGalleryMedia
     */
    public function setMedia(CcmMediaImage $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return CcmMediaImage
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param CcmGallery|null $gallery
     * @return $this
     */
    public function setGallery(CcmGallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return CcmGallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return CcmGalleryMedia
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
