<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * GalleryMdfDualAlign
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryMdfDualAlign
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
     * @ORM\OneToMany(targetEntity="GalleryMdfDualAlignMedia", mappedBy="gallery", cascade={"persist"})
     * @Groups({"news_show"})
     */
    private $medias;

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
     * @param \FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlignMedia $medias
     * @return GalleryMdfDualAlign
     */
    public function addMedia(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlignMedia $medias)
    {
        $medias->setGallery($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlignMedia $medias
     */
    public function removeMedia(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlignMedia $medias)
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
