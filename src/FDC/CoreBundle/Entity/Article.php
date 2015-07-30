<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Article
{
    use Time;
    use Translatable;

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
     * @var ArrayCollection
     *
     */
    protected $translations;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;
    
     /**
      * @var Application\Sonata\MediaBundle\Entity\Gallery
      *
      * @ORM\OneToOne(targetEntity="Theme")
      */
    protected $theme;
        
    /**
     * @var Application\Sonata\MediaBundle\Entity\Gallery
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", inversedBy="articleMainGallery")
     */
    protected $headerGallery;
    
    /**
     * @var Application\Sonata\MediaBundle\Entity\Gallery
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery")
     */
    protected $footerGallery;
    
    /**
     * @var ArticleLock
     *
     * @ORM\OneToMany(targetEntity="ArticleLock", mappedBy="articles")
     */
    protected $lock;
    
    /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="articles", cascade={"persist"})
     */
    protected $site;
    
    /**
     * @var Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="articleMainAudio")
     */
    protected $headerAudio;
    
    /**
     * @var Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="articleMainVideo")
     */
    protected $headerVideo;
    
    /**
     * @var ArticleVideo
     *
     * @ORM\OneToMany(targetEntity="ArticleVideo", mappedBy="article")
     */
    protected $footerVideos;
    
    /**
     * @var ArticleAudio
     *
     * @ORM\OneToMany(targetEntity="ArticleAudio", mappedBy="article")
     */
    protected $footerAudios;
    
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
    
    public function getTranslationByLocale($locale)
    {
        foreach ($this->translations as $translation) {
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
     * Set headerAudio
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $headerAudio
     * @return Article
     */
    public function setHeaderAudio(\Application\Sonata\MediaBundle\Entity\Media $headerAudio = null)
    {
        $this->headerAudio = $headerAudio;

        return $this;
    }

    /**
     * Get headerAudio
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getHeaderAudio()
    {
        return $this->headerAudio;
    }

    /**
     * Set headerVideo
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $headerVideo
     * @return Article
     */
    public function setHeaderVideo(\Application\Sonata\MediaBundle\Entity\Media $headerVideo = null)
    {
        $this->headerVideo = $headerVideo;

        return $this;
    }

    /**
     * Get headerVideo
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getHeaderVideo()
    {
        return $this->headerVideo;
    }

    /**
     * Set headerGallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $headerGallery
     * @return Article
     */
    public function setHeaderGallery(\Application\Sonata\MediaBundle\Entity\Gallery $headerGallery = null)
    {
        $this->headerGallery = $headerGallery;

        return $this;
    }

    /**
     * Get headerGallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery 
     */
    public function getHeaderGallery()
    {
        return $this->headerGallery;
    }

    /**
     * Set footerGallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $footerGallery
     * @return Article
     */
    public function setFooterGallery(\Application\Sonata\MediaBundle\Entity\Gallery $footerGallery = null)
    {
        $this->footerGallery = $footerGallery;

        return $this;
    }

    /**
     * Get footerGallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery 
     */
    public function getFooterGallery()
    {
        return $this->footerGallery;
    }

    /**
     * Add footerVideos
     *
     * @param \FDC\CoreBundle\Entity\ArticleVideo $footerVideos
     * @return Article
     */
    public function addFooterVideo(\FDC\CoreBundle\Entity\ArticleVideo $footerVideos)
    {
        $this->footerVideos[] = $footerVideos;

        return $this;
    }

    /**
     * Remove footerVideos
     *
     * @param \FDC\CoreBundle\Entity\ArticleVideo $footerVideos
     */
    public function removeFooterVideo(\FDC\CoreBundle\Entity\ArticleVideo $footerVideos)
    {
        $this->footerVideos->removeElement($footerVideos);
    }

    /**
     * Get footerVideos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFooterVideos()
    {
        return $this->footerVideos;
    }

    /**
     * Add footerAudios
     *
     * @param \FDC\CoreBundle\Entity\ArticleAudio $footerAudios
     * @return Article
     */
    public function addFooterAudio(\FDC\CoreBundle\Entity\ArticleAudio $footerAudios)
    {
        $this->footerAudios[] = $footerAudios;

        return $this;
    }

    /**
     * Remove footerAudios
     *
     * @param \FDC\CoreBundle\Entity\ArticleAudio $footerAudios
     */
    public function removeFooterAudio(\FDC\CoreBundle\Entity\ArticleAudio $footerAudios)
    {
        $this->footerAudios->removeElement($footerAudios);
    }

    /**
     * Get footerAudios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFooterAudios()
    {
        return $this->footerAudios;
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set lock
     *
     * @param \FDC\CoreBundle\Entity\ArticleLock $lock
     * @return Article
     */
    public function setLock(\FDC\CoreBundle\Entity\ArticleLock $lock = null)
    {
        $this->lock = $lock;

        return $this;
    }

    /**
     * Get lock
     *
     * @return \FDC\CoreBundle\Entity\ArticleLock 
     */
    public function getLock()
    {
        return $this->lock;
    }

    /**
     * Set site
     *
     * @param \FDC\CoreBundle\Entity\Site $site
     * @return Article
     */
    public function setSite(\FDC\CoreBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \FDC\CoreBundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Add lock
     *
     * @param \FDC\CoreBundle\Entity\ArticleLock $lock
     * @return Article
     */
    public function addLock(\FDC\CoreBundle\Entity\ArticleLock $lock)
    {
        $this->lock[] = $lock;

        return $this;
    }

    /**
     * Remove lock
     *
     * @param \FDC\CoreBundle\Entity\ArticleLock $lock
     */
    public function removeLock(\FDC\CoreBundle\Entity\ArticleLock $lock)
    {
        $this->lock->removeElement($lock);
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        // Add your code here
    }
}
