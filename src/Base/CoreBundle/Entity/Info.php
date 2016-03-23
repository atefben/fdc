<?php

namespace Base\CoreBundle\Entity;

use Base\AdminBundle\Component\Admin\Export;
use \DateTime;

use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Info
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\InfoRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"article" = "InfoArticle", "audio" = "InfoAudio", "image" = "InfoImage", "video" = "InfoVideo"})
 */
abstract class Info implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("home")
     *
     */
    private $id;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     * @Groups("home")
     *
     * @Assert\NotNull()
     */
    private $theme;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="infos")
     */
    private $festival;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage")
     */
    private $homepage;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     *
     */
    private $displayedHome;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $displayedMobile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $signature;

    /**
     * @var InfoTag
     *
     * @ORM\OneToMany(targetEntity="InfoTag", mappedBy="info", cascade={"persist"})
     *
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="InfoInfoAssociated", mappedBy="info", cascade={"persist"}, orphanRemoval=true)
     *
     */
    private $associatedInfo;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     *
     */
    private $associatedFilm;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     *
     */
    private $associatedEvent;

    /**
     * @ORM\OneToMany(targetEntity="InfoFilmProjectionAssociated", mappedBy="info", cascade={"persist"}, orphanRemoval=true)
     *
     */
    private $associatedProjections;

    /**
     * @ORM\OneToMany(targetEntity="InfoFilmFilmAssociated", mappedBy="info", cascade={"persist"}, orphanRemoval=true)
     *
     */
    private $associatedFilms;

    /**
     * @var InfoWidget
     *
     * @ORM\OneToMany(targetEntity="InfoWidget", mappedBy="info", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $widgets;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     *
     */
    private $sites;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     */
    private $publishEndedAt;

    /**
     * ArrayCollection
     * @Groups({"home"})
     *
     */
    protected $translations;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    private $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    private $updatedBy;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $hideSameDay;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $hidden = 0;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->widgets = new ArrayCollection();
        $this->associatedInfo = new ArrayCollection();
        $this->associatedProjections = new ArrayCollection();
        $this->associatedFilms = new ArrayCollection();
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #' . $this->getId();
        }

        return $string;
    }

    public static function getTypes()
    {
        return array(
            'Base\CoreBundle\Entity\InfoArticle' => 'article',
            'Base\CoreBundle\Entity\InfoAudio'   => 'audio',
            'Base\CoreBundle\Entity\InfoImage'   => 'photo',
            'Base\CoreBundle\Entity\InfoVideo'   => 'video'
        );
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups("home")
     */
    public function getInfoType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
    }

    public function getExportTitle()
    {
        return Export::translationField($this, 'title', 'fr');
    }

    public function getExportTheme()
    {
        return Export::translationField($this->getTheme(), 'name', 'fr');
    }

    public function getExportAuthor()
    {
        return $this->getCreatedBy()->getId();
    }

    public function getExportCreatedAt()
    {
        return Export::formatDate($this->getCreatedAt());
    }

    public function getExportPublishDates()
    {
        return Export::publishsDates($this->getPublishedAt(), $this->getPublishEndedAt());
    }

    public function getExportUpdatedAt()
    {
        return Export::formatDate($this->getUpdatedAt());
    }

    public function getExportStatusMaster()
    {
        $status = $this->findTranslationByLocale('fr')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEn()
    {
        $status = $this->findTranslationByLocale('en')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEs()
    {
        $status = $this->findTranslationByLocale('es')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusZh()
    {
        $status = $this->findTranslationByLocale('zh')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportSites()
    {
        return Export::sites($this->getSites());
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
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\InfoWidget $widgets
     * @return InfoArticleTranslation
     */
    public function addWidget(\Base\CoreBundle\Entity\InfoWidget $widgets)
    {
        $widgets->setInfo($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\InfoWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\InfoWidget $widgets)
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
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\Theme $theme
     * @return Info
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
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return Info
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
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return InfoArticleTranslation
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
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return Info
     */
    public function setHomepage(\Base\CoreBundle\Entity\Homepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\Homepage
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Add tags
     *
     * @param \Base\CoreBundle\Entity\InfoTag $tags
     * @return Info
     */
    public function addTag(\Base\CoreBundle\Entity\InfoTag $tags)
    {
        $tags->setInfo($this);
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\InfoTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\InfoTag $tags)
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

    /**
     * Set priorityStatus
     *
     * @param integer $priorityStatus
     * @return Info
     */
    public function setPriorityStatus($priorityStatus)
    {
        $this->priorityStatus = $priorityStatus;

        return $this;
    }

    /**
     * Get priorityStatus
     *
     * @return integer
     */
    public function getPriorityStatus()
    {
        return $this->priorityStatus;
    }

    /**
     * Set displayedHome
     *
     * @param boolean $displayedHome
     * @return Info
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
     * Set signature
     *
     * @param string $signature
     * @return Info
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set displayedMobile
     *
     * @param boolean $displayedMobile
     * @return Info
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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Info
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
     * @return Info
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
     * Add associatedInfo
     *
     * @param \Base\CoreBundle\Entity\InfoInfoAssociated $associatedInfo
     * @return Info
     */
    public function addAssociatedInfo(\Base\CoreBundle\Entity\InfoInfoAssociated $associatedInfo)
    {
        $this->associatedInfo[] = $associatedInfo;

        return $this;
    }

    /**
     * Remove associatedInfo
     *
     * @param \Base\CoreBundle\Entity\InfoInfoAssociated $associatedInfo
     */
    public function removeAssociatedInfo(\Base\CoreBundle\Entity\InfoInfoAssociated $associatedInfo)
    {
        $this->associatedInfo->removeElement($associatedInfo);
    }

    /**
     * Get associatedInfo
     *
     * @return \Base\CoreBundle\Entity\InfoInfoAssociated
     */
    public function getAssociatedInfo()
    {
        if ($this->associatedInfo->count() < 2) {
            while ($this->associatedInfo->count() != 2) {
                $entity = new InfoInfoAssociated();
                $entity->setInfo($this);
                $this->associatedInfo->add($entity);
            }
        }

        return $this->associatedInfo;
    }

    /**
     * Set associatedFilm
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $associatedFilm
     * @return Info
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
     * @return Info
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
     * @param \Base\CoreBundle\Entity\InfoFilmProjectionAssociated $associatedProjections
     * @return Info
     */
    public function addAssociatedProjection(\Base\CoreBundle\Entity\InfoFilmProjectionAssociated $associatedProjections)
    {
        $this->associatedProjections[] = $associatedProjections;

        return $this;
    }

    /**
     * Remove associatedProjections
     *
     * @param \Base\CoreBundle\Entity\InfoFilmProjectionAssociated $associatedProjections
     */
    public function removeAssociatedProjection(\Base\CoreBundle\Entity\InfoFilmProjectionAssociated $associatedProjections)
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

    /**
     * Add associatedFilms
     *
     * @param \Base\CoreBundle\Entity\InfoFilmFilmAssociated $associatedFilms
     * @return Info
     */
    public function addAssociatedFilm(\Base\CoreBundle\Entity\InfoFilmFilmAssociated $associatedFilms)
    {
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param \Base\CoreBundle\Entity\InfoFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(\Base\CoreBundle\Entity\InfoFilmFilmAssociated $associatedFilms)
    {
        $this->associatedFilms->removeElement($associatedFilms);
    }

    /**
     * Get associatedFilms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedFilms()
    {
        return $this->associatedFilms;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return Info
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
     * @return Info
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
     * @param InfoWidget $widgets
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;
    }

    /**
     * Set hideSameDay
     *
     * @param boolean $hideSameDay
     * @return Info
     */
    public function setHideSameDay($hideSameDay)
    {
        $this->hideSameDay = $hideSameDay;

        return $this;
    }

    /**
     * Get hideSameDay
     *
     * @return boolean
     */
    public function getHideSameDay()
    {
        return $this->hideSameDay;
    }

    /**
     * Set hidden
     *
     * @param boolean $hidden
     * @return News
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Get hidden
     *
     * @return boolean
     */
    public function getHidden()
    {
        return $this->hidden;
    }
}
