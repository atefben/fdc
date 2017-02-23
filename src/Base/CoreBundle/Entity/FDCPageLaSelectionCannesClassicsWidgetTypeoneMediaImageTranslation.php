<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class FDCPageLaSelectionCannesClassicsWidgetTypeoneMediaImageTranslation
 * @package Base\CoreBundle\Entity
 * @ORM\Table(name="fdcpage_la_selection_cannes_classics_widgettypeonemitranslation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageLaSelectionCannesClassicsWidgetTypeoneMediaImageTranslation
{

    use Translation;
    use TranslationChanges;
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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * Set label
     *
     * @param string $title
     * @return $this
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
     * Set content
     *
     * @param string $content
     * @return $this
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
}
