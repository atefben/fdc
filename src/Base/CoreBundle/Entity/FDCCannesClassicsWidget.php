<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * NewsWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "FDCCannesClassicsWidgetText",
 *  "quote" = "FDCCannesClassicsWidgetQuote",
 *  "audio" = "FDCCannesClassicsWidgetAudio",
 *  "image" = "FDCCannesClassicsWidgetImage",
 *  "image_dual_align" = "FDCCannesClassicsWidgetImageDualAlign",
 *  "video" = "FDCCannesClassicsWidgetVideo",
 *  "video_youtube" = "FDCCannesClassicsWidgetVideoYoutube",
 * })
 */
abstract class FDCCannesClassicsWidget
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
     * @var FDCCannesClassics
     *
     * @ORM\ManyToOne(targetEntity="FDCCannesClassics", inversedBy="widgets")
     */
    protected $classics;

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
     * Set classics
     *
     * @param \Base\CoreBundle\Entity\FDCCannesClassics $classics
     * @return FDCCannesClassicsWidget
     */
    public function setClassics(\Base\CoreBundle\Entity\FDCCannesClassics $classics = null)
    {
        $this->classics = $classics;

        return $this;
    }

    /**
     * Get classics
     *
     * @return \Base\CoreBundle\Entity\FDCCannesClassics 
     */
    public function getClassics()
    {
        return $this->classics;
    }
}
