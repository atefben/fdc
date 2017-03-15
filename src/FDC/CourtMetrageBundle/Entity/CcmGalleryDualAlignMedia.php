<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;

/**
 * CcmGalleryDualAlignMedia
 *
 * @ORM\Table(name="ccm_gallery_dual_align_media")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmGalleryDualAlignMedia
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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     */
    protected $media;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmGalleryDualAlign", inversedBy="medias")
     */
    protected $gallery;

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
     * @return CcmGalleryDualAlignMedia
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
     * Set gallery
     *
     * @param CcmGalleryDualAlign $gallery
     * @return CcmGalleryDualAlignMedia
     */
    public function setGallery(CcmGalleryDualAlign $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return CcmGalleryDualAlign 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
