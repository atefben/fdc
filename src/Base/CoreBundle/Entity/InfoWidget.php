<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * InfoWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "InfoWidgetText",
 *  "quote" = "InfoWidgetQuote",
 *  "audio" = "InfoWidgetAudio",
 *  "image" = "InfoWidgetImage",
 *  "image_dual_align" = "InfoWidgetImageDualAlign",
 *  "video" = "InfoWidgetVideo",
 *  "video_youtube" = "InfoWidgetVideoYoutube",
 * })
 */
abstract class InfoWidget
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
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $position;

    /**
     * @var Info
     *
     * @ORM\ManyToOne(targetEntity="Info", inversedBy="widgets")
     */
    protected $info;


    /**
     * @var string
     * @ORM\Column(name="old_import_reference", type="string", length=255, nullable=true)
     */
    protected $oldImportReference;

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
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"news_list", "search", "news_show"})
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
     * Set position
     *
     * @param integer $position
     * @return InfoWidget
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
     * Set info
     *
     * @param \Base\CoreBundle\Entity\Info $info
     * @return InfoWidget
     */
    public function setInfo(\Base\CoreBundle\Entity\Info $info = null)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return \Base\CoreBundle\Entity\Info
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set oldImportReference
     *
     * @param string $oldImportReference
     * @return InfoWidget
     */
    public function setOldImportReference($oldImportReference)
    {
        $this->oldImportReference = $oldImportReference;

        return $this;
    }

    /**
     * Get oldImportReference
     *
     * @return string 
     */
    public function getOldImportReference()
    {
        return $this->oldImportReference;
    }
}
