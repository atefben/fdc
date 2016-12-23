<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
use Base\CoreBundle\Util\Time;

/**
 * FDCPageParticipateSectionWidgetTypefour
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateSectionWidgetTypefour extends FDCPageParticipateSectionWidget
{

    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $imageBig;

    /**
     * @ORM\ManyToOne(targetEntity="MediaPdf")
     */
    protected $pdf;

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
     * @return FDCPageParticipateSectionWidgetTypefour
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
     * Set imageBig
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $imageBig
     * @return FDCPageParticipateSectionWidgetTypefour
     */
    public function setImageBig(\Base\CoreBundle\Entity\MediaImageSimple $imageBig = null)
    {
        $this->imageBig = $imageBig;

        return $this;
    }

    /**
     * Get imageBig
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getImageBig()
    {
        return $this->imageBig;
    }

    /**
     * Set pdf
     *
     * @param \Base\CoreBundle\Entity\MediaPdf $pdf
     * @return FDCPageParticipateSectionWidgetTypefour
     */
    public function setPdf(\Base\CoreBundle\Entity\MediaPdf $pdf = null)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return \Base\CoreBundle\Entity\MediaPdf
     */
    public function getPdf()
    {
        return $this->pdf;
    }
}
