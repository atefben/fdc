<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * EventWidgetTextTranslation
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventWidgetTextTranslation
{
    use Translation;
    use TranslationChanges;
    use Time;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     * @Groups({"event_show"})
     */
    protected $content;

    /**
     * Set content
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
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
