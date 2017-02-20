<?php

namespace FDC\CourtMetrageBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\Time;
use Doctrine\ORM\Mapping as ORM;
/**
 * CcmShortFilmCornerWidgetQuoteTranslation
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_quote_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetQuoteTranslation
{
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    protected $content;

    /**
     * Set content
     *
     * @param string $content
     * @return CcmShortFilmCornerWidgetQuoteTranslation
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
