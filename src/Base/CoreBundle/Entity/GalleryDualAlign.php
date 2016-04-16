<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * GalleryDualAlign
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryDualAlign
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
     * @ORM\OneToMany(targetEntity="GalleryDualAlignMedia", mappedBy="gallery", cascade={"persist"})
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
     * @param \Base\CoreBundle\Entity\GalleryDualAlignMedia $medias
     * @return GalleryDualAlign
     */
    public function addMedia(\Base\CoreBundle\Entity\GalleryDualAlignMedia $medias)
    {
        $medias->setGallery($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\GalleryDualAlignMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\GalleryDualAlignMedia $medias)
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
