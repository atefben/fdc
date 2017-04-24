<?php

namespace Base\CoreBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FDC\CourtMetrageBundle\Entity\CcmLabelContentFiles;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class GraphicalCharterSectionWidgetThreeColumns extends GraphicalCharterSectionWidget
{
    use Translatable;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    protected $image;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    protected $image2;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    protected $image3;

    /**
     * @var GraphicalCharterButtonGroup
     *
     * @ORM\ManyToOne(targetEntity="GraphicalCharterButtonGroup")
     *
     */
    protected $graphicalCharterButtonGroup;

    /**
     * @var GraphicalCharterButtonGroup
     *
     * @ORM\ManyToOne(targetEntity="GraphicalCharterButtonGroup")
     *
     */
    protected $graphicalCharterButtonGroup2;

    /**
     * @var GraphicalCharterButtonGroup
     *
     * @ORM\ManyToOne(targetEntity="GraphicalCharterButtonGroup")
     *
     */
    protected $graphicalCharterButtonGroup3;

    /**
     * ArrayCollection
     */
    protected $translations;

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
     * CcmLabelSectionContentOneColumn constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }


    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return GraphicalCharterSectionWidgetThreeColumns
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
     * Set image2
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image2
     * @return GraphicalCharterSectionWidgetThreeColumns
     */
    public function setImage2(\Base\CoreBundle\Entity\MediaImageSimple $image2 = null)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * Set image3
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image3
     * @return GraphicalCharterSectionWidgetThreeColumns
     */
    public function setImage3(\Base\CoreBundle\Entity\MediaImageSimple $image3 = null)
    {
        $this->image3 = $image3;

        return $this;
    }

    /**
     * Get image3
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * Set graphicalCharterButtonGroup
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup
     * @return GraphicalCharterSectionWidgetThreeColumns
     */
    public function setGraphicalCharterButtonGroup(\Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup = null)
    {
        $this->graphicalCharterButtonGroup = $graphicalCharterButtonGroup;

        return $this;
    }

    /**
     * Get graphicalCharterButtonGroup
     *
     * @return \Base\CoreBundle\Entity\GraphicalCharterButtonGroup 
     */
    public function getGraphicalCharterButtonGroup()
    {
        return $this->graphicalCharterButtonGroup;
    }

    /**
     * Set graphicalCharterButtonGroup2
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup2
     * @return GraphicalCharterSectionWidgetThreeColumns
     */
    public function setGraphicalCharterButtonGroup2(\Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup2 = null)
    {
        $this->graphicalCharterButtonGroup2 = $graphicalCharterButtonGroup2;

        return $this;
    }

    /**
     * Get graphicalCharterButtonGroup2
     *
     * @return \Base\CoreBundle\Entity\GraphicalCharterButtonGroup 
     */
    public function getGraphicalCharterButtonGroup2()
    {
        return $this->graphicalCharterButtonGroup2;
    }

    /**
     * Set graphicalCharterButtonGroup3
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup3
     * @return GraphicalCharterSectionWidgetThreeColumns
     */
    public function setGraphicalCharterButtonGroup3(\Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup3 = null)
    {
        $this->graphicalCharterButtonGroup3 = $graphicalCharterButtonGroup3;

        return $this;
    }

    /**
     * Get graphicalCharterButtonGroup3
     *
     * @return \Base\CoreBundle\Entity\GraphicalCharterButtonGroup 
     */
    public function getGraphicalCharterButtonGroup3()
    {
        return $this->graphicalCharterButtonGroup3;
    }


    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * @return bool
     */
    public function isIsTechnicalConstraintsPopupActive()
    {
        return $this->isTechnicalConstraintsPopupActive;
    }

    /**
     * @param bool $isTechnicalConstraintsPopupActive
     * @return GraphicalCharterSectionWidgetThreeColumns
     */
    public function setIsTechnicalConstraintsPopupActive($isTechnicalConstraintsPopupActive)
    {
        $this->isTechnicalConstraintsPopupActive = $isTechnicalConstraintsPopupActive;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIsTechnicalConstraintsPopupActive2()
    {
        return $this->isTechnicalConstraintsPopupActive2;
    }

    /**
     * @param bool $isTechnicalConstraintsPopupActive2
     * @return GraphicalCharterSectionWidgetThreeColumns
     */
    public function setIsTechnicalConstraintsPopupActive2($isTechnicalConstraintsPopupActive2)
    {
        $this->isTechnicalConstraintsPopupActive2 = $isTechnicalConstraintsPopupActive2;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIsTechnicalConstraintsPopupActive3()
    {
        return $this->isTechnicalConstraintsPopupActive3;
    }

    /**
     * @param bool $isTechnicalConstraintsPopupActive3
     * @return GraphicalCharterSectionWidgetThreeColumns
     */
    public function setIsTechnicalConstraintsPopupActive3($isTechnicalConstraintsPopupActive3)
    {
        $this->isTechnicalConstraintsPopupActive3 = $isTechnicalConstraintsPopupActive3;
        return $this;
    }



    /**
     * Get isTechnicalConstraintsPopupActive
     *
     * @return boolean 
     */
    public function getIsTechnicalConstraintsPopupActive()
    {
        return $this->isTechnicalConstraintsPopupActive;
    }

    /**
     * Get isTechnicalConstraintsPopupActive2
     *
     * @return boolean 
     */
    public function getIsTechnicalConstraintsPopupActive2()
    {
        return $this->isTechnicalConstraintsPopupActive2;
    }

    /**
     * Get isTechnicalConstraintsPopupActive3
     *
     * @return boolean 
     */
    public function getIsTechnicalConstraintsPopupActive3()
    {
        return $this->isTechnicalConstraintsPopupActive3;
    }
}
