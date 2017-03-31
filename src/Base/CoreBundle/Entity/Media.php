<?php

namespace Base\CoreBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Media
 *
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"image" = "MediaImage", "audio" = "MediaAudio", "video" = "MediaVideo"})
 */
abstract class Media implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;
    use TruncatePro;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"news_list", "search"})
     */
    protected $id;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme", cascade={"persist"})
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "live", "event_show", "home", "search"})
     */
    protected $theme;

    /**
     * @var MediaTag
     *
     * @ORM\OneToMany(targetEntity="MediaTag", mappedBy="media", cascade={"persist"})
     */
    protected $tags;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Groups({
     *     "live",
     *     "web_tv_show",
     *     "film_list",
     *     "film_show",
     *     "news_list", "search",
     *     "news_show",
     *     "event_show",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     * @Serializer\Accessor(getter="getApiPublishedAt")
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     * @Groups({
     *     "live",
     *     "web_tv_show",
     *     "film_list",
     *     "film_show",
     *     "news_list", "search",
     *     "news_show",
     *     "event_show",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     *
     */
    protected $publishEndedAt;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     */
    protected $sites;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    protected $festival;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $displayedAll;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $displayedHome;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $displayedMobile;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0}, nullable=true)
     */
    protected $excludeFromSearch;

    /**
     * @var ArrayCollection
     * @Groups({
     *     "news_show",
     *     "news_list", "search",
     *     "trailer_show",
     *     "live",
     *     "web_tv_show",
     *     "live",
     *     "film_list",
     *     "film_show",
     *     "event_list", "search",
     *     "event_show",
     *     "home",
     *     "today_images",
     *     "live",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     *
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $updatedBy;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     *
     * @Groups({"news_show"})
     */
    protected $associatedFilm;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     *
     * @Groups({"news_show"})
     */
    protected $associatedEvent;

    /**
     * @ORM\OneToMany(targetEntity="MediaFilmProjectionAssociated", mappedBy="media", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"news_show"})
     */
    protected $associatedProjections;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $oldMediaId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $oldReference;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->displayedAll = false;
        $this->displayedHome = false;
        $this->displayedMobile = false;
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            if ($string != 'MediaImage') {
                if ($this->findTranslationByLocale('fr') != null) {
                    $string = $this->findTranslationByLocale('fr')->getTitle();
                }
            } else {
                if ($this->findTranslationByLocale('fr') != null) {
                    $string = $this->findTranslationByLocale('fr')->getLegend();
                }
            }
        }

        return $string;
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"home", "news_list", "search", "news_show", "search"})
     */
    public function getMediaType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
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
     * Add tags
     *
     * @param \Base\CoreBundle\Entity\MediaTag $tags
     * @return Media
     */
    public function addTag(\Base\CoreBundle\Entity\MediaTag $tags)
    {
        if ($this->tags->contains($tags)) {
            return;
        }

        $tags->setMedia($this);
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\MediaTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\MediaTag $tags)
    {
        if (!$this->tags->contains($tags)) {
            return;
        }

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

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return $this
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getApiPublishedAt()
    {
        return $this->publishedAt ? $this->publishedAt : new \DateTime();
    }

    /**
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return $this
     */
    public function setPublishEndedAt($publishEndedAt)
    {
        $this->publishEndedAt = $publishEndedAt;

        return $this;
    }

    /**
     * Get publishEndedAt
     *
     * @return \DateTime
     */
    public function getPublishEndedAt()
    {
        return $this->publishEndedAt;
    }


    /**
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return $this
     */
    public function addSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites[] = $sites;

        return $this;
    }

    /**
     * Remove sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     */
    public function removeSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites->removeElement($sites);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * Set displayedAll
     *
     * @param boolean $displayedAll
     * @return Media
     */
    public function setDisplayedAll($displayedAll)
    {
        $this->displayedAll = $displayedAll;

        return $this;
    }

    /**
     * Get displayedAll
     *
     * @return boolean
     */
    public function getDisplayedAll()
    {
        return $this->displayedAll;
    }

    /**
     * Set displayedHome
     *
     * @param boolean $displayedHome
     * @return Media
     */
    public function setDisplayedHome($displayedHome)
    {
        $this->displayedHome = $displayedHome;

        return $this;
    }

    /**
     * Get displayedHome
     *
     * @return boolean
     */
    public function getDisplayedHome()
    {
        return $this->displayedHome;
    }

    /**
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\Theme $theme
     * @return Media
     */
    public function setTheme(\Base\CoreBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set displayedMobile
     *
     * @param boolean $displayedMobile
     * @return News
     */
    public function setDisplayedMobile($displayedMobile)
    {
        $this->displayedMobile = $displayedMobile;

        return $this;
    }

    /**
     * Get displayedMobile
     *
     * @return boolean
     */
    public function getDisplayedMobile()
    {
        return $this->displayedMobile;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return Media
     */
    public function setCreatedBy(\Application\Sonata\UserBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $updatedBy
     * @return Media
     */
    public function setUpdatedBy(\Application\Sonata\UserBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return Media
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
     * Set associatedFilm
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $associatedFilm
     * @return Media
     */
    public function setAssociatedFilm(\Base\CoreBundle\Entity\FilmFilm $associatedFilm = null)
    {
        $this->associatedFilm = $associatedFilm;

        return $this;
    }

    /**
     * Get associatedFilm
     *
     * @return \Base\CoreBundle\Entity\FilmFilm
     */
    public function getAssociatedFilm()
    {
        return $this->associatedFilm;
    }

    /**
     * Set associatedEvent
     *
     * @param \Base\CoreBundle\Entity\Event $associatedEvent
     * @return Media
     */
    public function setAssociatedEvent(\Base\CoreBundle\Entity\Event $associatedEvent = null)
    {
        $this->associatedEvent = $associatedEvent;

        return $this;
    }

    /**
     * Get associatedEvent
     *
     * @return \Base\CoreBundle\Entity\Event
     */
    public function getAssociatedEvent()
    {
        return $this->associatedEvent;
    }

    /**
     * Add associatedProjections
     *
     * @param \Base\CoreBundle\Entity\MediaFilmProjectionAssociated $associatedProjections
     * @return Media
     */
    public function addAssociatedProjection(\Base\CoreBundle\Entity\MediaFilmProjectionAssociated $associatedProjections)
    {
        $associatedProjections->setMedia($this);
        $this->associatedProjections[] = $associatedProjections;

        return $this;
    }


    /**
     * Remove associatedProjections
     *
     * @param \Base\CoreBundle\Entity\MediaFilmProjectionAssociated $associatedProjections
     */
    public function removeAssociatedProjection(\Base\CoreBundle\Entity\MediaFilmProjectionAssociated $associatedProjections)
    {
        $this->associatedProjections->removeElement($associatedProjections);
    }

    /**
     * Get associatedProjections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedProjections()
    {
        return $this->associatedProjections;
    }

    public function isElasticable()
    {
        $isElasticable = true;
        $fr = $this->findTranslationByLocale('fr');
        if (!$fr || $fr->getStatus() !== TranslateChildInterface::STATUS_PUBLISHED) {
            $isElasticable = false;
        }
        if ($this->getExcludeFromSearch()) {
            $isElasticable = false;
        }
        return $isElasticable;
    }

    /**
     * Set excludeFromSearch
     *
     * @param boolean $excludeFromSearch
     * @return Media
     */
    public function setExcludeFromSearch($excludeFromSearch)
    {
        $this->excludeFromSearch = $excludeFromSearch;

        return $this;
    }

    /**
     * Get excludeFromSearch
     *
     * @return boolean 
     */
    public function getExcludeFromSearch()
    {
        return $this->excludeFromSearch;
    }

    /**
     * Set oldMediaId
     *
     * @param integer $oldMediaId
     * @return Media
     */
    public function setOldMediaId($oldMediaId)
    {
        $this->oldMediaId = $oldMediaId;

        return $this;
    }

    /**
     * Get oldMediaId
     *
     * @return integer 
     */
    public function getOldMediaId()
    {
        return $this->oldMediaId;
    }

    /**
     * Set oldReference
     *
     * @param string $oldReference
     * @return Media
     */
    public function setOldReference($oldReference)
    {
        $this->oldReference = $oldReference;

        return $this;
    }

    /**
     * Get oldReference
     *
     * @return string 
     */
    public function getOldReference()
    {
        return $this->oldReference;
    }
}
