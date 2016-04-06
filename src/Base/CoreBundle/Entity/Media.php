<?php

namespace Base\CoreBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @Groups("news_list")
     */
    protected $id;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     *
     * @Groups({"news_list", "news_show", "film_show", "live", "event_show", "home"})
     * @Assert\NotNull()
     */
    private $theme;

    /**
     * @var MediaTag
     *
     * @ORM\OneToMany(targetEntity="MediaTag", mappedBy="media", cascade={"persist"})
     */
    private $tags;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Groups({
     *     "live",
     *     "web_tv_show",
     *     "film_list",
     *     "film_show",
     *     "news_list",
     *     "news_show",
     *     "event_show",
     *     "home"
     * })
     */
    private $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     * @Groups({
     *     "live",
     *     "web_tv_show",
     *     "film_list",
     *     "film_show",
     *     "news_list",
     *     "news_show",
     *     "event_show",
     *     "home"
     * })
     *
     */
    private $publishEndedAt;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     */
    private $sites;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $displayedAll;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $displayedHome;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $displayedMobile;

    /**
     * @var ArrayCollection
     * @Groups({
     *     "news_show",
     *     "news_list",
     *     "trailer_show",
     *     "live",
     *     "web_tv_show",
     *     "live",
     *     "film_list",
     *     "film_show",
     *     "event_list",
     *     "event_show",
     *     "home",
     *     "today_images",
     *     "live",
     *     "home"
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
    private $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $updatedBy;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     *
     * @Groups({"news_show"})
     */
    private $associatedFilm;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     *
     * @Groups({"news_show"})
     */
    private $associatedEvent;

    /**
     * @ORM\OneToMany(targetEntity="MediaFilmProjectionAssociated", mappedBy="media", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"news_show"})
     */
    private $associatedProjections;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            if ($string != 'MediaImage') {
                $string .= ' "' . $this->findTranslationByLocale('fr')->getTitle() . '"';
                $string = $this->truncate($string, 40, '..."', true);
            } else {
                $string .= ' "' . $this->findTranslationByLocale('fr')->getLegend() . '"';
                $string = $this->truncate($string, 40, '..."', true);
            }
        }

        return $string;
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"home", "news_list", "news_show"})
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
     * @return MediaImageTranslation
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
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return MediaImageTranslation
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
     * @return MediaImageTranslation
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
}
