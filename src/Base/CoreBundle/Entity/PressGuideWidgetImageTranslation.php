<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;
/**
 * PressGuideWidgetImageTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressGuideWidgetImageTranslation
{
    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * Set title
     *
     * @param string $title
     * @return PressGuideWidgetImageTranslation
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
     * @return PressGuideWidgetImageTranslation
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
