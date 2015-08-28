<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsAssociated
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
     * @var NewsArticleTranslation
     *
     * @ORM\OneToOne(targetEntity="NewsArticleTranslation", mappedBy="newsAssociated")
     */
    protected $news;

    /**
     * @var NewsArticleTranslation
     *
     * @ORM\OneToOne(targetEntity="NewsAudioTranslation", mappedBy="newsAssociated")
     */
    protected $newsAudios;
    
    /**
     * @var NewsAssociatedNews
     *
     * @ORM\OneToMany(targetEntity="NewsAssociatedNews", mappedBy="news", cascade={"persist"})
     */
    protected $associations;
    
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
        $this->associations = new ArrayCollection();
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
     * Add associations
     *
     * @param \FDC\CoreBundle\Entity\NewsAssociatedNews $associations
     * @return NewsAssociated
     */
    public function addAssociation(\FDC\CoreBundle\Entity\NewsAssociatedNews $associations)
    {
        $associations->setNews($this);
        $this->associations[] = $associations;

        return $this;
    }

    /**
     * Remove associations
     *
     * @param \FDC\CoreBundle\Entity\NewsAssociatedNews $associations
     */
    public function removeAssociation(\FDC\CoreBundle\Entity\NewsAssociatedNews $associations)
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
     * Set news
     *
     * @param \FDC\CoreBundle\Entity\NewsArticleTranslation $news
     * @return NewsAssociated
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
}
