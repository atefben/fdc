<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaPdf;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModuleThreeColumns
 * @ORM\Table(name="ccm_module_three_columns")
 * @ORM\Entity
 *
 */
class CcmModuleThreeColumns extends CcmModule
{
    use Translatable;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
     */
    protected $image1;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
     */
    protected $image2;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
     */
    protected $image3;

    /**
     * @var MediaPdf
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaPdf")
     */
    protected $pdf1;

    /**
     * @var MediaPdf
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaPdf")
     */
    protected $pdf2;

    /**
     * @var MediaPdf
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaPdf")
     */
    protected $pdf3;

    /**
     * HomeSliderTop constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return MediaImage
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * @param MediaImage $image1
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;
    }

    /**
     * @return MediaImage
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param MediaImage $image2
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;
    }

    /**
     * @return MediaImage
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param MediaImage $image3
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;
    }

    /**
     * @return MediaPdf
     */
    public function getPdf1()
    {
        return $this->pdf1;
    }

    /**
     * @param MediaPdf $pdf1
     */
    public function setPdf1($pdf1)
    {
        $this->pdf1 = $pdf1;
    }

    /**
     * @return MediaPdf
     */
    public function getPdf2()
    {
        return $this->pdf2;
    }

    /**
     * @param MediaPdf $pdf2
     */
    public function setPdf2($pdf2)
    {
        $this->pdf2 = $pdf2;
    }

    /**
     * @return MediaPdf
     */
    public function getPdf3()
    {
        return $this->pdf3;
    }

    /**
     * @param MediaPdf $pdf3
     */
    public function setPdf3($pdf3)
    {
        $this->pdf3 = $pdf3;
    }
}

