<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\NewsTranslation;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsArticleTranslation implements NewsTranslationInterface
{
    use Time;
    use Translation;
    use NewsTranslation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $introduction;
    
    /**
     * @var NewsWidget
     *
     * @ORM\OneToMany(targetEntity="NewsWidget", mappedBy="newsArticle", cascade={"persist"})
     */
    private $widgets;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     */
    private $publishEndedAt;
    
     /**
      * @var Theme
      *
      * @ORM\ManyToOne(targetEntity="Theme")
      */
    private $theme;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site", inversedBy="newsArticles")
     */
    private $sites;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->widgets = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->associations = new ArrayCollection();
    }

    /**
     * Set theme
     *
     * @param \FDC\CoreBundle\Entity\Theme $theme
     * @return Article
     */
    public function setTheme(\FDC\CoreBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \FDC\CoreBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return NewsArticleTranslation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return NewsArticleTranslation
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Article
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
     * @return Article
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
     * Set title
     *
     * @param string $title
     * @return NewsArticleTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add widgets
     *
     * @param \FDC\CoreBundle\Entity\NewsWidget $widgets
     * @return NewsArticle
     */
    public function addWidget(\FDC\CoreBundle\Entity\NewsWidget $widget)
    {
        $widget->setNewsArticle($this);
        $this->widgets[] = $widget;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \FDC\CoreBundle\Entity\NewsWidget $widgets
     */
    public function removeWidget(\FDC\CoreBundle\Entity\NewsWidget $widgets)
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
     * Add sites
     *
     * @param \FDC\CoreBundle\Entity\Site $sites
     * @return NewsArticle
     */
    public function addSite(\FDC\CoreBundle\Entity\Site $sites)
    {
        $this->sites[] = $sites;

        return $this;
    }

    /**
     * Remove sites
     *
     * @param \FDC\CoreBundle\Entity\Site $sites
     */
    public function removeSite(\FDC\CoreBundle\Entity\Site $sites)
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
     * Set introduction
     *
     * @param string $introduction
     * @return NewsArticleTranslation
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;

        return $this;
    }

    /**
     * Get introduction
     *
     * @return string 
     */
    public function getIntroduction()
    {
        return $this->introduction;
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
     * Set newsAssociated
     *
     * @param \FDC\CoreBundle\Entity\NewsAssociated $newsAssociated
     * @return NewsArticleTranslation
     */
    public function setNewsAssociated(\FDC\CoreBundle\Entity\NewsAssociated $newsAssociated = null)
    {
        $newsAssociated->setNews($this);
        $this->newsAssociated = $newsAssociated;

        return $this;
    }

    /**
     * Get newsAssociated
     *
     * @return \FDC\CoreBundle\Entity\NewsAssociated 
     */
    public function getNewsAssociated()
    {
        return $this->newsAssociated;
    }

    /**
     * Set tags
     *
     * @param \FDC\CoreBundle\Entity\NewsArticleTranslationNewsTag $tags
     * @return NewsArticleTranslation
     */
    public function setTags(\FDC\CoreBundle\Entity\NewsArticleTranslationNewsTag $tags = null)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return \FDC\CoreBundle\Entity\NewsArticleTranslationNewsTag 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
