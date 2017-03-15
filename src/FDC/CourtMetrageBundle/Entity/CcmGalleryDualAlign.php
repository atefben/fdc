<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;

/**
 * GalleryDualAlign
 *
 * @ORM\Table(name="ccm_gallery_dual_align")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmGalleryDualAlign
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmGalleryDualAlignMedia", mappedBy="gallery", cascade={"persist"})
     */
    protected $medias;

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
            return 'Module 2 photos /ligne #' . strval($this->getId());
        }

        return 'Module 2 photos /ligne';
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
     * @param CcmGalleryDualAlignMedia $medias
     * @return CcmGalleryDualAlign
     */
    public function addMedia(CcmGalleryDualAlignMedia $medias)
    {
        $medias->setGallery($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param CcmGalleryDualAlignMedia $medias
     */
    public function removeMedia(CcmGalleryDualAlignMedia $medias)
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
}
