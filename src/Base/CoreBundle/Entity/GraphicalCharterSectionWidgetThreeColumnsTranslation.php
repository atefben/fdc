<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class GraphicalCharterSectionWidgetThreeColumnsTranslation
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
}
