<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * GalleryMdfDualAlignMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryMdfDualAlignMedia
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
     * @ORM\ManyToOne(targetEntity="MediaMdfImage", inversedBy="galleryMdfDualAlignMedia")
     * @Groups({"news_show"})
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity="GalleryMdfDualAlign", inversedBy="medias")
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
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $media
     * @return GalleryMdfDualAlignMedia
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
     * Set gallery
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlign $gallery
     * @return GalleryMdfDualAlignMedia
     */
    public function setGallery(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlign $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlign
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
