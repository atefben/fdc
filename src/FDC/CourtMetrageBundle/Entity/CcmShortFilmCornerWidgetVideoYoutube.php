<?php

namespace FDC\CourtMetrageBundle\Entity;


use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmShortFilmCornerWidgetVideoYoutube
 *
 * @ORM\Table(name="ccm_short_film_corner_widget_video_youtube")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmShortFilmCornerWidgetVideoYoutube extends CcmShortFilmCornerWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
     */
    protected $image;

    /**
     * CcmShortFilmCornerWidgetVideoYoutube constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Set image
     *
     * @param CcmMediaImageSimple $image
     * @return CcmShortFilmCornerWidgetVideoYoutube
     */
    public function setImage(CcmMediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return CcmMediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }
}
