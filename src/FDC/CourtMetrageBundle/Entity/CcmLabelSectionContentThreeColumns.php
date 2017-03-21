<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CcmLabelSectionContentThreeColumns
 * @ORM\Table(name="ccm_label_section_content_three_columns")
 * @ORM\Entity
 */
class CcmLabelSectionContentThreeColumns extends CcmLabelSectionContent
{
    use Translatable;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
     *
     */
    protected $image;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
     *
     */
    protected $image2;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
     *
     */
    protected $image3;

    /**
     * @var CcmLabelContentFiles
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFiles")
     *
     */
    protected $labelContentFiles;

    /**
     * @var CcmLabelContentFiles
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFiles")
     *
     */
    protected $labelContentFiles2;

    /**
     * @var CcmLabelContentFiles
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFiles")
     *
     */
    protected $labelContentFiles3;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * CcmLabelSectionContentOneColumn constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return CcmMediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return CcmMediaImageSimple
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param $image2
     *
     * @return $this
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * @return CcmMediaImageSimple
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param $image3
     *
     * @return $this
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @return CcmLabelContentFiles
     */
    public function getLabelContentFiles()
    {
        return $this->labelContentFiles;
    }

    /**
     * @param $labelContentFiles
     *
     * @return $this
     */
    public function setLabelContentFiles($labelContentFiles)
    {
        $this->labelContentFiles = $labelContentFiles;

        return $this;
    }

    /**
     * @return CcmLabelContentFiles
     */
    public function getLabelContentFiles2()
    {
        return $this->labelContentFiles2;
    }

    /**
     * @param $labelContentFiles2
     *
     * @return $this
     */
    public function setLabelContentFiles2($labelContentFiles2)
    {
        $this->labelContentFiles2 = $labelContentFiles2;

        return $this;
    }

    /**
     * @return CcmLabelContentFiles
     */
    public function getLabelContentFiles3()
    {
        return $this->labelContentFiles3;
    }

    /**
     * @param $labelContentFiles3
     *
     * @return $this
     */
    public function setLabelContentFiles3($labelContentFiles3)
    {
        $this->labelContentFiles3 = $labelContentFiles3;

        return $this;
    }
}
