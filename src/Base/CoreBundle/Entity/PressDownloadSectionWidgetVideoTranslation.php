<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

/**
 * PressDownloadSectionWidgetVideoTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownloadSectionWidgetVideoTranslation
{

    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $label;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $copyright;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $btnLabel;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $secondBtnLabel;


    /**
     * Set label
     *
     * @param string $label
     * @return PressDownloadSectionWidgetVideoTranslation
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return PressDownloadSectionWidgetVideoTranslation
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set btnLabel
     *
     * @param string $btnLabel
     * @return PressDownloadSectionWidgetVideoTranslation
     */
    public function setBtnLabel($btnLabel)
    {
        $this->btnLabel = $btnLabel;

        return $this;
    }

    /**
     * Get btnLabel
     *
     * @return string 
     */
    public function getBtnLabel()
    {
        return $this->btnLabel;
    }

    /**
     * Set secondBtnLabel
     *
     * @param string $secondBtnLabel
     * @return PressDownloadSectionWidgetVideoTranslation
     */
    public function setSecondBtnLabel($secondBtnLabel)
    {
        $this->secondBtnLabel = $secondBtnLabel;

        return $this;
    }

    /**
     * Get secondBtnLabel
     *
     * @return string 
     */
    public function getSecondBtnLabel()
    {
        return $this->secondBtnLabel;
    }
}
