<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Entity\MediaImageSimple;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CcmLabelSectionContentTwoColumns
 * @ORM\Table(name="ccm_label_section_content_two_columns")
 * @ORM\Entity
 */
class CcmLabelSectionContentTwoColumns extends CcmLabelSectionContent
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
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImageSimple")
     *
     */
    protected $image2;

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
     * @return MediaImageSimple
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
