<?php

namespace FDC\CourtMetrageBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * CcmShortFilmCornerWidgetSubtitle
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_subtitle")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetSubtitle extends CcmShortFilmCornerWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmShortFilmCornerWidgetSubtitle constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}
