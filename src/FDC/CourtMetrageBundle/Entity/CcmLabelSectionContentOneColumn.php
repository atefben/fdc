<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Entity\MediaImageSimple;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CcmLabelSectionContentOneColumn
 * @ORM\Table(name="ccm_label_section_content_one_column")
 * @ORM\Entity
 */
class CcmLabelSectionContentOneColumn extends CcmLabelSectionContent
{
    use Translatable;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImageSimple")
     *
     */
    protected $image;

    /**
     * @var CcmLabelContentFiles
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFiles")
     *
     */
    protected $labelContentFiles;

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
     * @return MediaImageSimple
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
}
