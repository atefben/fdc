<?php

namespace Base\CoreBundle\Entity;

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
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
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
}
