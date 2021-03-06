<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * CcmNewsWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "CcmNewsWidgetText",
 *  "description" = "CcmNewsWidgetDescription",   
 *  "quote" = "CcmNewsWidgetQuote",
 *  "signature" = "CcmNewsWidgetSignature",
 *  "audio" = "CcmNewsWidgetAudio",
 *  "image" = "CcmNewsWidgetImage",
 *  "image_dual_align" = "CcmNewsWidgetImageDualAlign",
 *  "gallery" = "CcmNewsWidgetGallery",   
 *  "video" = "CcmNewsWidgetVideo",
 *  "video_youtube" = "CcmNewsWidgetVideoYoutube",
 * })
 */
abstract class CcmNewsWidget
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
     * @var CcmNews
     *
     * @ORM\ManyToOne(targetEntity="CcmNews", inversedBy="widgets")
     */
    protected $news;
    
    /**
     * @var string
     * @ORM\Column(name="old_import_reference", type="string", length=255, nullable=true)
     */
    protected $oldImportReference;

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
     * @return string
     */
    public function getType()
    {
        return strtolower(str_replace('CcmNewsWidget', '', $this->getWidgetType()));
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
     * @return CcmNewsWidget
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
     * Set news
     *
     * @param \FDC\CourtMetrageBundle\Entity\CcmNews $news
     * @return $this
     */
    public function setNews(CcmNews $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \FDC\CourtMetrageBundle\Entity\CcmNews
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set oldImportReference
     *
     * @param string $oldImportReference
     * @return CcmNewsWidget
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
