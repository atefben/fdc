<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationByLocale;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Event
{
    use TranslationByLocale;
    use Translatable;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"event_list", "event_show"})
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
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $translate;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="events", cascade={"persist"})
     *
     * @Groups({"event_list", "event_show"})
     *
     */
    private $festival;

    /**
     * @var EventTheme
     *
     * @ORM\ManyToOne(targetEntity="EventTheme", inversedBy="events", cascade={"persist"})
     *
     * @Groups({"event_list", "event_show"})
     *
     */
    private $theme;

    /**
     * @TODO
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     *
     * @Groups({"event_list", "event_show"})
     */
    private $title;

    /**
     * @var EventWidget
     *
     * @ORM\OneToMany(targetEntity="EventWidget", mappedBy="events", cascade={"persist"})
     *
     * @Groups({"event_list", "event_show"})
     */
    private $widgets;

    /**
     * @var NewsTag
     *
     * @ORM\OneToMany(targetEntity="EventNewsTag", mappedBy="events", cascade={"persist"})
     *
     * @Groups({"event_list", "event_show"})
     */
    private $tags;

    /**
     * ArrayCollection
     *
     * @Groups({"event_list", "event_show"})
     */
    protected $translations;


    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Event
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set translate
     *
     * @param boolean $translate
     * @return Event
     */
    public function setTranslate($translate)
    {
        $this->translate = $translate;

        return $this;
    }

    /**
     * Get translate
     *
     * @return boolean 
     */
    public function getTranslate()
    {
        return $this->translate;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Event
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
     * @param \Base\CoreBundle\Entity\NewsArticleLock $lock
     * @return Event
     */
    public function addLock(\Base\CoreBundle\Entity\NewsArticleLock $lock)
    {
        $this->lock[] = $lock;

        return $this;
    }

    /**
     * Remove lock
     *
     * @param \Base\CoreBundle\Entity\NewsArticleLock $lock
     */
    public function removeLock(\Base\CoreBundle\Entity\NewsArticleLock $lock)
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
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return Event
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\EventTheme $theme
     * @return Event
     */
    public function setTheme(\Base\CoreBundle\Entity\EventTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\EventTheme 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\EventWidget $widgets
     * @return Event
     */
    public function addWidget(\Base\CoreBundle\Entity\EventWidget $widgets)
    {
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\EventWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\EventWidget $widgets)
    {
        $this->widgets->removeElement($widgets);
    }

    /**
     * Get widgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * Add tags
     *
     * @param \Base\CoreBundle\Entity\EventNewsTag $tags
     * @return Event
     */
    public function addTag(\Base\CoreBundle\Entity\EventNewsTag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\EventNewsTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\EventNewsTag $tags)
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
