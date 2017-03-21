<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelSectionContentThreeColumnsTranslation
 * @ORM\Table(name="ccm_label_section_content_three_columns_translation")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmLabelSectionContentThreeColumnsTranslationRepository")
 */
class CcmLabelSectionContentThreeColumnsTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $legend;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $legend2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $legend3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $technicalConstraints;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $technicalConstraints2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $technicalConstraints3;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isTechnicalConstraintsPopupActive = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isTechnicalConstraintsPopupActive2 = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isTechnicalConstraintsPopupActive3 = false;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle2()
    {
        return $this->title2;
    }

    /**
     * @param $title2
     *
     * @return $this
     */
    public function setTitle2($title2)
    {
        $this->title2 = $title2;

        return $this;
    }

    /**
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @param $legend
     *
     * @return $this
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * @return string
     */
    public function getLegend2()
    {
        return $this->legend2;
    }

    /**
     * @param $legend2
     *
     * @return $this
     */
    public function setLegend2($legend2)
    {
        $this->legend2 = $legend2;

        return $this;
    }

    /**
     * @return string
     */
    public function getTechnicalConstraints()
    {
        return $this->technicalConstraints;
    }

    /**
     * @param $technicalConstraints
     *
     * @return $this
     */
    public function setTechnicalConstraints($technicalConstraints)
    {
        $this->technicalConstraints = $technicalConstraints;

        return $this;
    }

    /**
     * @return string
     */
    public function getTechnicalConstraints2()
    {
        return $this->technicalConstraints2;
    }

    /**
     * @param $technicalConstraints2
     *
     * @return $this
     */
    public function setTechnicalConstraints2($technicalConstraints2)
    {
        $this->technicalConstraints2 = $technicalConstraints2;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsTechnicalConstraintsPopupActive()
    {
        return $this->isTechnicalConstraintsPopupActive;
    }

    /**
     * @param $isTechnicalConstraintsPopupActive
     *
     * @return $this
     */
    public function setIsTechnicalConstraintsPopupActive($isTechnicalConstraintsPopupActive)
    {
        $this->isTechnicalConstraintsPopupActive = $isTechnicalConstraintsPopupActive;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsTechnicalConstraintsPopupActive2()
    {
        return $this->isTechnicalConstraintsPopupActive2;
    }

    /**
     * @param $isTechnicalConstraintsPopupActive2
     *
     * @return $this
     */
    public function setIsTechnicalConstraintsPopupActive2($isTechnicalConstraintsPopupActive2)
    {
        $this->isTechnicalConstraintsPopupActive2 = $isTechnicalConstraintsPopupActive2;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle3()
    {
        return $this->title3;
    }

    /**
     * @param $title3
     *
     * @return $this
     */
    public function setTitle3($title3)
    {
        $this->title3 = $title3;

        return $this;
    }

    /**
     * @return string
     */
    public function getLegend3()
    {
        return $this->legend3;
    }

    /**
     * @param $legend3
     *
     * @return $this
     */
    public function setLegend3($legend3)
    {
        $this->legend3 = $legend3;

        return $this;
    }

    /**
     * @return string
     */
    public function getTechnicalConstraints3()
    {
        return $this->technicalConstraints3;
    }

    /**
     * @param $technicalConstraints3
     *
     * @return $this
     */
    public function setTechnicalConstraints3($technicalConstraints3)
    {
        $this->technicalConstraints3 = $technicalConstraints3;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsTechnicalConstraintsPopupActive3()
    {
        return $this->isTechnicalConstraintsPopupActive3;
    }

    /**
     * @param $isTechnicalConstraintsPopupActive3
     *
     * @return $this
     */
    public function setIsTechnicalConstraintsPopupActive3($isTechnicalConstraintsPopupActive3)
    {
        $this->isTechnicalConstraintsPopupActive3 = $isTechnicalConstraintsPopupActive3;

        return $this;
    }
}
