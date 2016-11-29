<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
use Base\CoreBundle\Util\Time;

/**
 * FDCPagePrepareWidgetColumn
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPagePrepareWidgetColumn extends FDCPagePrepareWidget
{

    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $image;

    /**
     * @deprecated
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $file;


    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaPdf", cascade={"persist", "remove"})
     */
    private $pdf;


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
     * @return PressDownloadSectionWidgetDocument
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
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return PressDownloadSectionWidgetDocument
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set pdf
     *
     * @param \Base\CoreBundle\Entity\MediaPdf $pdf
     * @return FDCPagePrepareWidgetColumn
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
