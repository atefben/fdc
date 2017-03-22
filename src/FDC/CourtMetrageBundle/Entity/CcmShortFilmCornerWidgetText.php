<?php

namespace FDC\CourtMetrageBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * CcmShortFilmCornerWidgetText
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_text")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetText extends CcmShortFilmCornerWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmShortFilmCornerWidgetText constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}
