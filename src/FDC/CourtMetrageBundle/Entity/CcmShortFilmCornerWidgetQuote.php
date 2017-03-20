<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * CcmShortFilmCornerWidgetQuote
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_quote")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetQuote extends CcmShortFilmCornerWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmShortFilmCornerWidgetQuote constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}
