<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

/**
 * FDCPagePrepareWidgetColumnTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPagePrepareWidgetColumnTranslation
{

    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $btnLabel;

    /**
     * Set label
     *
     * @param string $title
     * @return PressDownloadSectionWidgetDocumentTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
}
