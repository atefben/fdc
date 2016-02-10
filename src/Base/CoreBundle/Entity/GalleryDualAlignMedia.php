<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * GalleryDualAlignMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryDualAlignMedia
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
     * @ORM\ManyToOne(targetEntity="GalleryDualAlign", inversedBy="medias")
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
     * @param \Base\CoreBundle\Entity\MediaImage $media
     * @return GalleryDualAlignMedia
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
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\GalleryDualAlign $gallery
     * @return GalleryDualAlignMedia
     */
    public function setGallery(\Base\CoreBundle\Entity\GalleryDualAlign $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\GalleryDualAlign 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
