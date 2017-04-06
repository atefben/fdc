<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * FDCPageLaSelectionCannesClassicsWidgetVideoYoutubeTranslation
 *
 * @ORM\Table(name="fdc_page_la_selection_cc_widget_video_yb_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageLaSelectionCannesClassicsWidgetVideoYoutubeTranslation
{
    use Translation;
    use TranslationChanges;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $title;

    /**
     * Set title
     *
     * @param string $title
     * @return FDCPageLaSelectionCannesClassicsWidgetVideoYoutubeTranslation
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
     * Set url
     *
     * @param string $url
     * @return FDCPageLaSelectionCannesClassicsWidgetVideoYoutubeTranslation
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}
