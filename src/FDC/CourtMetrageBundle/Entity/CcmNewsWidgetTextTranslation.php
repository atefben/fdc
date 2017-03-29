<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * CcmNewsWidgetTextTranslation
 * @ORM\Table(name="ccm_news_widget_text_translation")
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\NewsWidgetTextTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetTextTranslation
{
    use Translation;
    use TranslationChanges;
    use Time;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     * @Groups({"news_list", "search", "news_show"})
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
