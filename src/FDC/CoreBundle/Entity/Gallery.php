<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * Gallery
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Gallery
{   
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Media
     *
     * @ORM\OneToMany(targetEntity="GalleryMedia", mappedBy="gallery", cascade={"persist"})
     */
    private $medias;
    
    /**
     * @var Media
     *
     * @ORM\OneToMany(targetEntity="NewsWidgetImage", mappedBy="gallery")
     */
    private $newsWidgetImages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }
    
    public function __toString()
    {
        if ($this->getId()) {
            return strval($this->getId());
        }
        
        return 'New Gallery';
    }

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
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\GalleryMedia $medias
     * @return MediaGallery
     */
    public function addMedia(\FDC\CoreBundle\Entity\GalleryMedia $medias)
    {
        $medias->setGallery($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\GalleryMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\GalleryMedia $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Add newsWidgetImages
     *
     * @param \FDC\CoreBundle\Entity\NewsWidgetImage $newsWidgetImages
     * @return Gallery
     */
    public function addNewsWidgetImage(\FDC\CoreBundle\Entity\NewsWidgetImage $newsWidgetImages)
    {
        $this->newsWidgetImages[] = $newsWidgetImages;

        return $this;
    }

    /**
     * Remove newsWidgetImages
     *
     * @param \FDC\CoreBundle\Entity\NewsWidgetImage $newsWidgetImages
     */
    public function removeNewsWidgetImage(\FDC\CoreBundle\Entity\NewsWidgetImage $newsWidgetImages)
    {
        $this->newsWidgetImages->removeElement($newsWidgetImages);
    }

    /**
     * Get newsWidgetImages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNewsWidgetImages()
    {
        return $this->newsWidgetImages;
    }
}
