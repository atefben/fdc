<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Translation;

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
    use Translation;
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

     /**
      * @var Theme
      *
      * @ORM\ManyToOne(targetEntity="Theme")
      */
    private $theme;
    
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $status;

    /**
     * ArrayCollection
     */
    protected $translations;

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
    
    public static function getTypes()
    {
        return array(
            'FDC\CoreBundle\Entity\NewsArticle' => 'article',
            'FDC\CoreBundle\Entity\NewsAudio' => 'audio',
            'FDC\CoreBundle\Entity\NewsImage' => 'image',
            'FDC\CoreBundle\Entity\NewsVideo' => 'video'
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
     * Set title
     *
     * @param string $title
     * @return News
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
     * Add lock
     *
     * @param \FDC\CoreBundle\Entity\NewsArticleLock $lock
     * @return News
     */
    public function addLock(\FDC\CoreBundle\Entity\NewsArticleLock $lock)
    {
        $this->lock[] = $lock;

        return $this;
    }

    /**
     * Remove lock
     *
     * @param \FDC\CoreBundle\Entity\NewsArticleLock $lock
     */
    public function removeLock(\FDC\CoreBundle\Entity\NewsArticleLock $lock)
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
     * @param \FDC\CoreBundle\Entity\Theme $theme
     * @return News
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
     * @return News
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
