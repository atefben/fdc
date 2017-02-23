<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelSectionContentOneColumnTranslation
 * @ORM\Table(name="ccm_label_section_content_one_column_translation")
 * @ORM\Entity()
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
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $fileTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $file2Title;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     *
     */
    protected $file;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     *
     */
    protected $file2;

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

    /**
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFile2()
    {
        return $this->file2;
    }

    /**
     * @param $file2
     *
     * @return $this
     */
    public function setFile2($file2)
    {
        $this->file2 = $file2;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileTitle()
    {
        return $this->fileTitle;
    }

    /**
     * @param $fileTitle
     *
     * @return $this
     */
    public function setFileTitle($fileTitle)
    {
        $this->fileTitle = $fileTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getFile2Title()
    {
        return $this->file2Title;
    }

    /**
     * @param $file2Title
     *
     * @return $this
     */
    public function setFile2Title($file2Title)
    {
        $this->file2Title = $file2Title;

        return $this;
    }
}
