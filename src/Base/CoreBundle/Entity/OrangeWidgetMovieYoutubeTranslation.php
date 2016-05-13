<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use JMS\Serializer\Annotation\Groups;

/**
 * OrangeWidgetMovieYoutube
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeWidgetMovieYoutubeTranslation
{
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use Time;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     * @Groups({
     *     "orange_series_and_cie"
     * })
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="text", nullable=true)
     * @Groups({
     *     "orange_series_and_cie"
     * })
     */
    private $subtitle;

    /**
     * Set title
     *
     * @param string $title
     * @return OrangeWidgetMovieYoutube
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
     * Set subtitle
     *
     * @param string $subtitle
     * @return OrangeWidgetMovieYoutube
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }
}
