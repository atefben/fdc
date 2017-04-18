<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class GraphicalCharterSectionWidgetOneColumnTranslation
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
    protected $subLegend;

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
     * Get subLegend
     *
     * @return string 
     */
    public function getSubLegend()
    {
        return $this->subLegend;
    }

    /**
     * Set subLegend
     *
     * @param string $subLegend
     * @return GraphicalCharterSectionWidgetOneColumnTranslation
     */
    public function setSubLegend($subLegend)
    {
        $this->subLegend = $subLegend;

        return $this;
    }
}
