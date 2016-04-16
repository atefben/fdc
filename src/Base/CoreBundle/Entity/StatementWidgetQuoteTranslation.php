<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * StatementWidgetQuoteTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementWidgetQuoteTranslation
{
    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     *
     * @Groups({"statement_list", "statement_show", "news_show"})
     */
    private $content;

    /**
     * Set content
     *
     * @param string $content
     * @return StatementWidgetText
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
