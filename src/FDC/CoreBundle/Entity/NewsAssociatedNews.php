<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsAssociatedNews
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsAssociatedNews
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var NewsAssociated
     *
     * @ORM\ManyToOne(targetEntity="NewsAssociated", inversedBy="associations")
     */
    protected $news;
    
     /**
     * @var NewsArticle
     *
     * @ORM\ManyToOne(targetEntity="News")
     */
    protected $association;
    
    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }
        
        return $string;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @param \FDC\CoreBundle\Entity\NewsAssociated $news
     * @return NewsAssociatedNews
     */
    public function setNews(\FDC\CoreBundle\Entity\NewsAssociated $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \FDC\CoreBundle\Entity\NewsAssociated 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set association
     *
     * @param \FDC\CoreBundle\Entity\NewsArticle $association
     * @return NewsAssociatedNews
     */
    public function setAssociation(\FDC\CoreBundle\Entity\News $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \FDC\CoreBundle\Entity\News 
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
