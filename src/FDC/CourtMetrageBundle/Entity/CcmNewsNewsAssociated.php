<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;
use FDC\CourtMetrageBundle\Entity\CcmNews;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

/**
 * CcmNewsNewsAssociated
 *
 * @ORM\Table(name="ccm_news_news_associated")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsNewsAssociated
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
     * @var CcmNews
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmNews", inversedBy="associatedNews")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $news;
    
     /**
     * @var CcmNewsArticle
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmNews")
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
     * @param CcmNews $news
     * @return $this
     */
    public function setNews(CcmNews $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return CcmNews
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set association
     *
     * @param CcmNews $association
     * @return $this
     */
    public function setAssociation(CcmNews $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return CcmNews
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
