<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * NewsWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"text" = "EventWidgetText", "audio" = "EventWidgetAudio", "image" = "EventWidgetImage", "video" = "EventWidgetVideo"})
 */
abstract class EventWidget
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
     * @param \Base\CoreBundle\Entity\News $news
     * @return News
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
}
