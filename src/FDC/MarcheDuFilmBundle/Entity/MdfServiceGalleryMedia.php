<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfServiceGalleryMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfServiceGalleryMedia
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
     * @ORM\ManyToOne(targetEntity="MediaMdfImage", inversedBy="serviceGalleryMedia")
     * @Assert\Count(
     *      max = "3",
     *      maxMessage = "validation.service_product_image_max"
     * )
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $media;
    
    /**
     * @ORM\ManyToOne(targetEntity="MdfServiceGallery", inversedBy="medias")
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
     * @param MdfServiceGallery|null $gallery
     * @return $this
     */
    public function setGallery(\FDC\MarcheDuFilmBundle\Entity\MdfServiceGallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param $position
     * @return $this
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
