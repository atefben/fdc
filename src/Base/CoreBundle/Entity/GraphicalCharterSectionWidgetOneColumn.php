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
class GraphicalCharterSectionWidgetOneColumn extends GraphicalCharterSectionWidget
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
     * @var GraphicalCharterButtonGroup
     *
     * @ORM\ManyToOne(targetEntity="GraphicalCharterButtonGroup")
     *
     */
    protected $graphicalCharterButtonGroup;

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
     * @return GraphicalCharterSectionWidgetOneColumn
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
     * Set graphicalCharterButtonGroup
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup
     * @return GraphicalCharterSectionWidgetOneColumn
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
