<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsArticleTranslationNewsTag
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsArticleTranslationNewsTag
{
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
     * @var NewsArticleTranslation
     *
     * @ORM\OneToOne(targetEntity="NewsArticleTranslation", inversedBy="tags")
     */
    private $news;
    
    /**
     * @var NewsTag
     *
     * @ORM\ManyToMany(targetEntity="NewsTag")
     */
    private $tags;

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string .= ' '. strval($this->getId());
        }
        
        return $string;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
     * Set news
     *
     * @param \FDC\CoreBundle\Entity\NewsArticleTranslation $news
     * @return NewsArticleTranslationNewsTag
     */
    public function setNews(\FDC\CoreBundle\Entity\NewsArticleTranslation $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \FDC\CoreBundle\Entity\NewsArticleTranslation 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add tags
     *
     * @param \FDC\CoreBundle\Entity\NewsTag $tags
     * @return NewsArticleTranslationNewsTag
     */
    public function addTag(\FDC\CoreBundle\Entity\NewsTag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \FDC\CoreBundle\Entity\NewsTag $tags
     */
    public function removeTag(\FDC\CoreBundle\Entity\NewsTag $tags)
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
}
