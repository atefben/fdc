<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

/**
 * PressGuideWidgetPictoTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressGuideWidgetPictoTranslation
{
    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(name="press_guide_widget_picto_title", type="string", length=122, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="press_guide_widget_column_text", type="string", nullable=true)
     */
    protected $content;

    /**
     * Set title
     *
     * @param string $title
     * @return PressGuideWidgetPictoTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
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
     * @return PressGuideWidgetPictoTranslation
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
