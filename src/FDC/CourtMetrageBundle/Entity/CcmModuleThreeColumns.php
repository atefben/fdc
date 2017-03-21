<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     */
    protected $image1;

    /**
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     */
    protected $image2;

    /**
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     */
    protected $image3;

    /**
     * @var CcmMediaPdf
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaPdf")
     */
    protected $pdf1;

    /**
     * @var CcmMediaPdf
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaPdf")
     */
    protected $pdf2;

    /**
     * @var CcmMediaPdf
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaPdf")
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
     * @return CcmMediaImage
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * @param CcmMediaImage $image1
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;
    }

    /**
     * @return CcmMediaImage
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param CcmMediaImage $image2
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;
    }

    /**
     * @return CcmMediaImage
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param CcmMediaImage $image3
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;
    }

    /**
     * @return CcmMediaPdf
     */
    public function getPdf1()
    {
        return $this->pdf1;
    }

    /**
     * @param CcmMediaPdf $pdf1
     */
    public function setPdf1($pdf1)
    {
        $this->pdf1 = $pdf1;
    }

    /**
     * @return CcmMediaPdf
     */
    public function getPdf2()
    {
        return $this->pdf2;
    }

    /**
     * @param CcmMediaPdf $pdf2
     */
    public function setPdf2($pdf2)
    {
        $this->pdf2 = $pdf2;
    }

    /**
     * @return CcmMediaPdf
     */
    public function getPdf3()
    {
        return $this->pdf3;
    }

    /**
     * @param CcmMediaPdf $pdf3
     */
    public function setPdf3($pdf3)
    {
        $this->pdf3 = $pdf3;
    }
}

