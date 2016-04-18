<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

/**
 * PressDownloadSectionWidgetFileTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownloadSectionWidgetFileTranslation
{

    use Translation;
    use Time;

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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    protected $updateDate;

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return PressDownloadSectionWidgetFileTranslation
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
     * @return PressDownloadSectionWidgetFileTranslation
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
     * @return PressDownloadSectionWidgetFileTranslation
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
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return PressDownloadSectionWidgetFileTranslation
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }
}
