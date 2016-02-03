<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

/**
 * PressGuideWidgetColumnTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressGuideWidgetColumnTranslation
{

    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="press_guide_widget_column_first", type="string", nullable=true)
     */
    protected $firstColumn;

    /**
     * @var string
     *
     * @ORM\Column(name="press_guide_widget_column_second", type="string", nullable=true)
     */
    protected $secondColumn;

    /**
     * @var string
     *
     * @ORM\Column(name="press_guide_widget_column_third", type="string", nullable=true)
     */
    protected $thirdColumn;


    /**
     * Set firstColumn
     *
     * @param string $firstColumn
     * @return PressGuideWidgetColumnTranslation
     */
    public function setFirstColumn($firstColumn)
    {
        $this->firstColumn = $firstColumn;

        return $this;
    }

    /**
     * Get firstColumn
     *
     * @return string 
     */
    public function getFirstColumn()
    {
        return $this->firstColumn;
    }

    /**
     * Set secondColumn
     *
     * @param string $secondColumn
     * @return PressGuideWidgetColumnTranslation
     */
    public function setSecondColumn($secondColumn)
    {
        $this->secondColumn = $secondColumn;

        return $this;
    }

    /**
     * Get secondColumn
     *
     * @return string 
     */
    public function getSecondColumn()
    {
        return $this->secondColumn;
    }

    /**
     * Set thirdColumn
     *
     * @param string $thirdColumn
     * @return PressGuideWidgetColumnTranslation
     */
    public function setThirdColumn($thirdColumn)
    {
        $this->thirdColumn = $thirdColumn;

        return $this;
    }

    /**
     * Get thirdColumn
     *
     * @return string 
     */
    public function getThirdColumn()
    {
        return $this->thirdColumn;
    }
}
