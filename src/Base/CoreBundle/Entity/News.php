<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationByLocale;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"article" = "NewsArticle", "audio" = "NewsAudio", "image" = "NewsImage", "video" = "NewsVideo"})
 */
class News
{
    use TranslationByLocale;
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"news_list", "news_show"})
     */
    private $id;
    
    /**
     * @var ArticleLock
     *
     * @ORM\OneToMany(targetEntity="NewsArticleLock", mappedBy="articles")
     */
    private $lock;
    
    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    private $translate;

     /**
      * @var NewsTheme
      *
      * @ORM\ManyToOne(targetEntity="NewsTheme")
      */
    private $theme;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     *
     * @Groups({"news_list", "news_show"})
     */
    private $publishedAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     *
     * @Groups({"news_list", "news_show"})
     */
    private $publishEndedAt;

    /**
     * @var NewsTag
     *
     * @ORM\OneToMany(targetEntity="NewsNewsTag", mappedBy="news", cascade={"persist"})
     *
     * @Groups({"news_list", "news_show"})
     */
    private $tags;
    
    /**
     * @ORM\OneToMany(targetEntity="NewsNewsAssociated", mappedBy="news", cascade={"persist"})
     *
     * @Groups({"news_list", "news_show"})
     */
    private $associations;
    
    /**
     * @var NewsWidget
     *
     * @ORM\OneToMany(targetEntity="NewsWidget", mappedBy="news", cascade={"persist"})
     *
     * @Groups({"news_list", "news_show"})
     */
    private $widgets;

    /**
     * ArrayCollection
     *
     * @Groups({"news_list", "news_show"})
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }
    
    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }
        
        return $string;
    }
    
    public static function getTypes()
    {
        return array(
            'Base\CoreBundle\Entity\NewsArticle' => 'article',
            'Base\CoreBundle\Entity\NewsAudio' => 'audio',
            'Base\CoreBundle\Entity\NewsImage' => 'image',
            'Base\CoreBundle\Entity\NewsVideo' => 'video'
        );
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
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\NewsWidget $widgets
     * @return NewsArticleTranslation
     */
    public function addWidget(\Base\CoreBundle\Entity\NewsWidget $widgets)
    {
        $widgets->setNews($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\NewsWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\NewsWidget $widgets)
    {
        $this->widgets->removeElement($widgets);
    }

    /**
     * Get widgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * Add lock
     *
     * @param \Base\CoreBundle\Entity\NewsArticleLock $lock
     * @return News
     */
    public function addLock(\Base\CoreBundle\Entity\NewsArticleLock $lock)
    {
        $this->lock[] = $lock;

        return $this;
    }

    /**
     * Remove lock
     *
     * @param \Base\CoreBundle\Entity\NewsArticleLock $lock
     */
    public function removeLock(\Base\CoreBundle\Entity\NewsArticleLock $lock)
    {
        $this->lock->removeElement($lock);
    }

    /**
     * Get lock
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLock()
    {
        return $this->lock;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return News
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return News
     */
    public function setPublishEndedAt($publishEndedAt)
    {
        $this->publishEndedAt = $publishEndedAt;

        return $this;
    }

    /**
     * Get publishEndedAt
     *
     * @return \DateTime 
     */
    public function getPublishEndedAt()
    {
        return $this->publishEndedAt;
    }

    /**
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\NewsTheme $theme
     * @return News
     */
    public function setTheme(\Base\CoreBundle\Entity\NewsTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Add tags
     *
     * @param \Base\CoreBundle\Entity\NewsNewsTag $tags
     * @return News
     */
    public function addTag(\Base\CoreBundle\Entity\NewsNewsTag $tags)
    {
        $this->tags[] = $tags;
        $tags->setNews($this);

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\NewsNewsTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\NewsNewsTag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add associations
     *
     * @param \Base\CoreBundle\Entity\NewsNewsAssociated $associations
     * @return News
     */
    public function addAssociation(\Base\CoreBundle\Entity\NewsNewsAssociated $associations)
    {
        $this->associations[] = $associations;
        $associations->setNews($this);

        return $this;
    }

    /**
     * Remove associations
     *
     * @param \Base\CoreBundle\Entity\NewsNewsAssociated $associations
     */
    public function removeAssociation(\Base\CoreBundle\Entity\NewsNewsAssociated $associations)
    {
        $this->associations->removeElement($associations);
    }

    /**
     * Get associations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * Set translate
     *
     * @param boolean $translate
     * @return News
     */
    public function setTranslate($translate)
    {
        $this->translate = $translate;

        return $this;
    }

    /**
     * Get translate
     *
     * @return boolean 
     */
    public function getTranslate()
    {
        return $this->translate;
    }
}
