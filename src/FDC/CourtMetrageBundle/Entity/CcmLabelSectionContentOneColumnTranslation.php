<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelSectionContentOneColumnTranslation
 * @ORM\Table(name="ccm_label_section_content_one_column_translation")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmLabelSectionContentOneColumnTranslationRepository")
 */
class CcmLabelSectionContentOneColumnTranslation
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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $legend;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $technicalConstraints;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isTechnicalConstraintsPopupActive = false;

    /**
     * @return bool
     */
    public function isIsTechnicalConstraintsPopupActive()
    {
        return $this->isTechnicalConstraintsPopupActive;
    }

    /**
     * @param $isActive
     *
     * @return $this
     */
    public function setIsTechnicalConstraintsPopupActive($isActive)
    {
        $this->isTechnicalConstraintsPopupActive = $isActive;

        return $this;
    }

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
}
