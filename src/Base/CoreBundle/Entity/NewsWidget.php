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
 *  "text" = "NewsWidgetText",
 *  "quote" = "NewsWidgetQuote",
 *  "audio" = "NewsWidgetAudio",
 *  "image" = "NewsWidgetImage",
 *  "image_dual_align" = "NewsWidgetImageDualAlign",
 *  "video" = "NewsWidgetVideo",
 *  "video_youtube" = "NewsWidgetVideoYoutube",
 * })
 */
abstract class NewsWidget
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
     * @var NewsArticle
     *
     * @ORM\ManyToOne(targetEntity="News", inversedBy="widgets")
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
     * Set news
     *
     * @param \Base\CoreBundle\Entity\News $news
     * @return $this
     */
    public function setNews(\Base\CoreBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \Base\CoreBundle\Entity\News
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set oldImportReference
     *
     * @param string $oldImportReference
     * @return NewsWidget
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
