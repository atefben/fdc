<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\Groups;

/**
 * NewsNewsAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsNewsAssociated
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
     * @var News
     *
     * @ORM\ManyToOne(targetEntity="News", inversedBy="associatedNews")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $news;
    
     /**
     * @var NewsArticle
     *
     * @ORM\ManyToOne(targetEntity="News")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({"news_list", "search", "news_show"})
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
     * Set association
     *
     * @param \Base\CoreBundle\Entity\News $association
     * @return $this
     */
    public function setAssociation(\Base\CoreBundle\Entity\News $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\News
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
