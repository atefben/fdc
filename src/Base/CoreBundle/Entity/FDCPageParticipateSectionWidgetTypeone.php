<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
use Base\CoreBundle\Util\Time;

/**
 * FDCPageParticipateSectionWidgetTypeone
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateSectionWidgetTypeone extends FDCPageParticipateSectionWidget
{

    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $image;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $picto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }


    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return FDCPageParticipateSectionWidgetTypeone
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set picto
     *
     * @param string $picto
     * @return FDCPageParticipateSectionWidgetTypeone
     */
    public function setPicto($picto)
    {
        $this->picto = $picto;

        return $this;
    }

    /**
     * Get picto
     *
     * @return string 
     */
    public function getPicto()
    {
        return $this->picto;
    }
}
