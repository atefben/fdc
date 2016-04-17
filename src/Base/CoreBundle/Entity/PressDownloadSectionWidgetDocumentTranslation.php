<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

/**
 * PressDownloadSectionWidgetDocumentTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownloadSectionWidgetDocumentTranslation
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
     * @ORM\Column(type="string", nullable=true)
     */
    protected $content;

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
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $thirdBtnLabel;


    /**
     * Set label
     *
     * @param string $label
     * @return PressDownloadSectionWidgetDocumentTranslation
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
     * @return PressDownloadSectionWidgetDocumentTranslation
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
     * Set content
     *
     * @param string $content
     * @return PressDownloadSectionWidgetDocumentTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set btnLabel
     *
     * @param string $btnLabel
     * @return PressDownloadSectionWidgetDocumentTranslation
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
     * @return PressDownloadSectionWidgetDocumentTranslation
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

    /**
     * Set thirdBtnLabel
     *
     * @param string $thirdBtnLabel
     * @return PressDownloadSectionWidgetDocumentTranslation
     */
    public function setThirdBtnLabel($thirdBtnLabel)
    {
        $this->thirdBtnLabel = $thirdBtnLabel;

        return $this;
    }

    /**
     * Get thirdBtnLabel
     *
     * @return string 
     */
    public function getThirdBtnLabel()
    {
        return $this->thirdBtnLabel;
    }
}
