<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CcmLabelSectionContentText
 * @ORM\Table(name="ccm_label_section_content_text")
 * @ORM\Entity
 */
class CcmLabelSectionContentText extends CcmLabelSectionContent
{
    use Translatable;

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
}
