<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Util\Time;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * CcmShortFilmCornerWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "CcmShortFilmCornerWidgetText",
 *  "subtitle" = "CcmShortFilmCornerWidgetSubtitle",   
 *  "quote" = "CcmShortFilmCornerWidgetQuote",
 *  "audio" = "CcmShortFilmCornerWidgetAudio",
 *  "image" = "CcmShortFilmCornerWidgetImage",
 *  "gallery" = "CcmShortFilmCornerWidgetGallery",
 *  "image_dual_align" = "CcmShortFilmCornerWidgetImageDualAlign",  
 *  "video" = "CcmShortFilmCornerWidgetVideo",
 *  "video_youtube" = "CcmShortFilmCornerWidgetVideoYoutube",
 * })
 */
abstract class CcmShortFilmCornerWidget
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $position;

    /**
     * @var \FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner
     *
     * @ORM\ManyToOne(targetEntity="CcmShortFilmCorner", inversedBy="widgets")
     */
    protected $shortFilmCorner;

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     *
     * @return string
     */
    public function getWidgetType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return strtolower(str_replace('CcmShortFilmCornerWidget', '', $this->getWidgetType()));
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return void
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return CcmShortFilmCornerWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set shortFilmCorner
     *
     * @param \FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner $shortFilmCorner
     * @return $this
     */
    public function setShortFilmCorner(CcmShortFilmCorner $shortFilmCorner = null)
    {
        $this->shortFilmCorner = $shortFilmCorner;

        return $this;
    }

    /**
     * Get shortFilmCorner
     *
     * @return \FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner
     */
    public function getNews()
    {
        return $this->shortFilmCorner;
    }
}
