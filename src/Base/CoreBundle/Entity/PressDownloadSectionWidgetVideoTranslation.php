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

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $label;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $copyright;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $btnLabel;


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
}
