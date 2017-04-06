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
class GraphicalCharterSectionWidgetTwoColumns extends GraphicalCharterSectionWidget
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
     * Set image
     *
     * @param MediaImageSimple $image
     * @return GraphicalCharterSectionWidgetTwoColumns
     */
    public function setImage(MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImageSimple 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image2
     *
     * @param MediaImageSimple $image2
     * @return GraphicalCharterSectionWidgetTwoColumns
     */
    public function setImage2(MediaImageSimple $image2 = null)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return MediaImageSimple 
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * Set graphicalCharterButtonGroup
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup
     * @return GraphicalCharterSectionWidgetTwoColumns
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
     * @return GraphicalCharterSectionWidgetTwoColumns
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


    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }
}
