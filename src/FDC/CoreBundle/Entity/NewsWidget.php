<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * NewsWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"text" = "NewsWidgetText", "audio" = "NewsWidgetAudio", "image" = "NewsWidgetImage", "video" = "NewsWidgetVideo"})
 */
abstract class NewsWidget
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $position;

    /**
     * @var NewsArticle
     *
     * @ORM\ManyToOne(targetEntity="News", inversedBy="widgets")
     */
    protected $news;

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
     * Set position
     *
     * @param integer $position
     * @return NewsWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set news
     *
     * @param \FDC\CoreBundle\Entity\News $news
     * @return News
     */
    public function setNews(\FDC\CoreBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \FDC\CoreBundle\Entity\News 
     */
    public function getNews()
    {
        return $this->news;
    }
}
