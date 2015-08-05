<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

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
     * @ORM\ManyToOne(targetEntity="NewsArticle", inversedBy="widgets")
     */
    protected $newsArticle;

    /**
     * @var NewsAudio
     *
     * @ORM\ManyToOne(targetEntity="NewsAudio", inversedBy="widgets")
     */
    protected $newsAudio;
    
    /**
     * @var NewsImage
     *
     * @ORM\ManyToOne(targetEntity="NewsImage", inversedBy="widgets")
     */
    protected $newsImage;

    /**
     * @var NewsVideo
     *
     * @ORM\ManyToOne(targetEntity="NewsVideo", inversedBy="widgets")
     */
    protected $newsVideo;

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
     * Set newsArticle
     *
     * @param \FDC\CoreBundle\Entity\NewsArticle $newsArticle
     * @return NewsWidget
     */
    public function setNewsArticle(\FDC\CoreBundle\Entity\NewsArticle $newsArticle = null)
    {
        $this->newsArticle = $newsArticle;

        return $this;
    }

    /**
     * Get newsArticle
     *
     * @return \FDC\CoreBundle\Entity\NewsArticle 
     */
    public function getNewsArticle()
    {
        return $this->newsArticle;
    }

    /**
     * Set newsAudio
     *
     * @param \FDC\CoreBundle\Entity\NewsAudio $newsAudio
     * @return NewsWidget
     */
    public function setNewsAudio(\FDC\CoreBundle\Entity\NewsAudio $newsAudio = null)
    {
        $this->newsAudio = $newsAudio;

        return $this;
    }

    /**
     * Get newsAudio
     *
     * @return \FDC\CoreBundle\Entity\NewsAudio 
     */
    public function getNewsAudio()
    {
        return $this->newsAudio;
    }

    /**
     * Set newsImage
     *
     * @param \FDC\CoreBundle\Entity\NewsImage $newsImage
     * @return NewsWidget
     */
    public function setNewsImage(\FDC\CoreBundle\Entity\NewsImage $newsImage = null)
    {
        $this->newsImage = $newsImage;

        return $this;
    }

    /**
     * Get newsImage
     *
     * @return \FDC\CoreBundle\Entity\NewsImage 
     */
    public function getNewsImage()
    {
        return $this->newsImage;
    }

    /**
     * Set newsVideo
     *
     * @param \FDC\CoreBundle\Entity\NewsVideo $newsVideo
     * @return NewsWidget
     */
    public function setNewsVideo(\FDC\CoreBundle\Entity\NewsVideo $newsVideo = null)
    {
        $this->newsVideo = $newsVideo;

        return $this;
    }

    /**
     * Get newsVideo
     *
     * @return \FDC\CoreBundle\Entity\NewsVideo 
     */
    public function getNewsVideo()
    {
        return $this->newsVideo;
    }
}
