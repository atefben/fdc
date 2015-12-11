<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationByLocale;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\MainStatus;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\NewsRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"article" = "NewsArticle", "audio" = "NewsAudio", "image" = "NewsImage", "video" = "NewsVideo"})
 */
abstract class News implements MainStatusInterface
{
    use TranslationByLocale;
    use Time;
    use Seo;
    use MainStatus;
    
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
     * @var NewsLock
     *
     * @ORM\OneToMany(targetEntity="NewsLock", mappedBy="news")
     */
    private $locks;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, options={"default":0})
     */
    private $priorityStatus;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, options={"default":0})
     */
    private $translationStatus;

     /**
      * @var NewsTheme
      *
      * @ORM\ManyToOne(targetEntity="NewsTheme")
      *
      * @Groups({"news_list", "news_show"})
      */
    private $theme;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;
    
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
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="sliderNews")
     */
    private $homepage;

    /**
     * @var NewsTag
     *
     * @ORM\OneToMany(targetEntity="NewsTag", mappedBy="news", cascade={"persist"})
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
     * @ORM\OrderBy({"position" = "ASC"})
     * @Groups({"news_list", "news_show"})
     */
    private $widgets;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     *
     * @Groups({"news_list", "news_show"})
     */
    private $sites;

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
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"news_list", "news_show"})
     */
    public function getNewsType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
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
     * Set festival
     *
     * @param fBase\CoreBundle\Entity\FilmFestival $festival
     * @return News
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival
     */
    public function getFestival()
    {
        return $this->festival;
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
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return NewsArticleTranslation
     */
    public function addSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites[] = $sites;

        return $this;
    }

    /**
     * Remove sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     */
    public function removeSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites->removeElement($sites);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return News
     */
    public function setHomepage(\Base\CoreBundle\Entity\Homepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\Homepage 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Add tags
     *
     * @param \Base\CoreBundle\Entity\NewsTag $tags
     * @return News
     */
    public function addTag(\Base\CoreBundle\Entity\NewsTag $tags)
    {
        $tags->setNews($this);
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\NewsTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\NewsTag $tags)
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
     * Add locks
     *
     * @param \Base\CoreBundle\Entity\NewsLock $locks
     * @return News
     */
    public function addLock(\Base\CoreBundle\Entity\NewsLock $lock)
    {
        $lock->setNews($this);
        $this->locks[] = $lock;

        return $this;
    }

    /**
     * Remove locks
     *
     * @param \Base\CoreBundle\Entity\NewsLock $locks
     */
    public function removeLock(\Base\CoreBundle\Entity\NewsLock $lock)
    {
        $this->locks->removeElement($lock);
    }

    /**
     * Get locks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocks()
    {
        return $this->locks;
    }

    /**
     * Set priorityStatus
     *
     * @param integer $priorityStatus
     * @return News
     */
    public function setPriorityStatus($priorityStatus)
    {
        $this->priorityStatus = $priorityStatus;

        return $this;
    }

    /**
     * Get priorityStatus
     *
     * @return integer 
     */
    public function getPriorityStatus()
    {
        return $this->priorityStatus;
    }

    /**
     * Set translationStatus
     *
     * @param integer $translationStatus
     * @return News
     */
    public function setTranslationStatus($translationStatus)
    {
        $this->translationStatus = $translationStatus;

        return $this;
    }

    /**
     * Get translationStatus
     *
     * @return integer 
     */
    public function getTranslationStatus()
    {
        return $this->translationStatus;
    }
}
