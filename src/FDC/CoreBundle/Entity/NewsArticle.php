<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * NewsArticle
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsArticle
{
    use Time;
  //  use Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     */
    protected $publishEndedAt;
    
     /**
      * @var Theme
      *
      * @ORM\OneToOne(targetEntity="Theme")
      */
    protected $theme;
        
    /**
     * @var Application\Sonata\MediaBundle\Entity\Gallery
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", inversedBy="newsArticleHeader")
     */
    protected $header;
    
    /**
     * @var ArticleLock
     *
     * @ORM\OneToMany(targetEntity="NewsArticleLock", mappedBy="articles")
     */
    protected $lock;

    /**
     * @var NewsWidget
     *
     * @ORM\OneToMany(targetEntity="NewsWidget", mappedBy="newsArticle", cascade={"persist"})
     */
    protected $widgets;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     */
    protected $sites;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
    
    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }
        
        return $string;
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
     * Set header
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $header
     * @return NewsArticle
     */
    public function setHeader(\Application\Sonata\MediaBundle\Entity\Gallery $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery 
     */
    public function getHeader()
    {
        return $this->header;
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
}
