<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
use Base\CoreBundle\Util\Time;

/**
 * FDCPageParticipateSectionWidgetTypetwo
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateSectionWidgetTypetwo extends FDCPageParticipateSectionWidget
{

    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $sponsorImage;

    /**
     * ArrayCollection
     */
    protected $translations;

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
     * @return FDCPageParticipateSectionWidgetTypetwo
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
     * Set sponsorImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $sponsorImage
     * @return FDCPageParticipateSectionWidgetTypetwo
     */
    public function setSponsorImage(\Base\CoreBundle\Entity\MediaImageSimple $sponsorImage = null)
    {
        $this->sponsorImage = $sponsorImage;

        return $this;
    }

    /**
     * Get sponsorImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getSponsorImage()
    {
        return $this->sponsorImage;
    }

    /**
     * Set pressDownload
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateSection $pressDownload
     * @return FDCPageParticipateSectionWidgetTypetwo
     */
    public function setPressDownload(\Base\CoreBundle\Entity\FDCPageParticipateSection $pressDownload = null)
    {
        $this->pressDownload = $pressDownload;

        return $this;
    }

    /**
     * Get pressDownload
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipateSection 
     */
    public function getPressDownload()
    {
        return $this->pressDownload;
    }
}
