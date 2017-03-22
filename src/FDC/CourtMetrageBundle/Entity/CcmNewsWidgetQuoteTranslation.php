<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * CcmNewsWidgetQuoteTranslation
 *
 * @ORM\Table(name="ccm_news_widget_quote_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetQuoteTranslation
{
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     *
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $content;

    /**
     * Set content
     *
     * @param string $content
     * @return CcmNewsWidgetQuoteTranslation
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
