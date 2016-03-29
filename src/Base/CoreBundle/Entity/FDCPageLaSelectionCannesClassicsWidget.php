<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * FDCPageLaSelectionCannesClassicsWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "FDCPageLaSelectionCannesClassicsWidgetText",
 *  "quote" = "FDCPageLaSelectionCannesClassicsWidgetQuote",
 *  "audio" = "FDCPageLaSelectionCannesClassicsWidgetAudio",
 *  "image" = "FDCPageLaSelectionCannesClassicsWidgetImage",
 *  "image_dual_align" = "FDCPageLaSelectionCannesClassicsWidgetImageDualAlign",
 *  "video" = "FDCPageLaSelectionCannesClassicsWidgetVideo",
 *  "video_youtube" = "FDCPageLaSelectionCannesClassicsWidgetVideoYoutube",
 *  "introduction" = "FDCPageLaSelectionCannesClassicsWidgetIntroduction",
 *  "subtitle" = "FDCPageLaSelectionCannesClassicsWidgetSubtitle",
 *  "movie" = "FDCPageLaSelectionCannesClassicsWidgetMovie"
 *
 * })
 */
abstract class FDCPageLaSelectionCannesClassicsWidget
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
     * @Groups({"news_list", "news_show"})
     */
    protected $position;

    /**
     * @var FDCPageLaSelectionCannesClassics
     *
     * @ORM\ManyToOne(targetEntity="FDCPageLaSelectionCannesClassics", inversedBy="widgets")
     */
    protected $FDCPageLaSelectionCannesClassics;

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"news_list", "news_show"})
     */
    public function getWidgetType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
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
     * @return NewsWidget
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
     * Set FDCPageLaSelectionCannesClassics
     *
     * @param \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics $fDCPageLaSelectionCannesClassics
     * @return FDCPageLaSelectionCannesClassicsWidget
     */
    public function setFDCPageLaSelectionCannesClassics(\Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics $fDCPageLaSelectionCannesClassics = null)
    {
        $this->FDCPageLaSelectionCannesClassics = $fDCPageLaSelectionCannesClassics;

        return $this;
    }

    /**
     * Get FDCPageLaSelectionCannesClassics
     *
     * @return \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics 
     */
    public function getFDCPageLaSelectionCannesClassics()
    {
        return $this->FDCPageLaSelectionCannesClassics;
    }
}
