<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * NewsWidgetTextTranslation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\NewsWidgetTextTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class NewsWidgetTextTranslation
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
     * @return NewsWidgetText
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
