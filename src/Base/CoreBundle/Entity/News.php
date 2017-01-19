<?php

namespace Base\CoreBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use \DateTime;

use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;

use Eko\FeedBundle\Item\Writer\RoutedItemInterface;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Discriminator;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\NewsRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"article" = "NewsArticle", "audio" = "NewsAudio", "image" = "NewsImage", "video" = "NewsVideo"})
 */
abstract class News implements TranslateMainInterface,RoutedItemInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;

    public static $localeTemp = 'fr';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"news_list", "search", "news_show", "home", "film_show"})
     */
    protected $id;

     /**
      * @var Theme
      *
      * @ORM\ManyToOne(targetEntity="Theme")
      * @ORM\JoinColumn(nullable=true)
      *
      * @Groups({"news_list", "search", "news_show", "home", "film_show"})
      */
    protected $theme;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    protected $festival;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", cascade={"all"})
     */
    protected $homepage;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     * @Groups({"news_show"})
     */
    protected $hideSameDay;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     *
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
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"news_show", "film_show"})
     */
    protected $signature;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $typeClone;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $hidden = 0;

    /**
     * @var NewsTag
     *
     * @ORM\OneToMany(targetEntity="NewsTag", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     *
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="NewsNewsAssociated", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $associatedNews;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="news")
     */
    protected $associatedFilm;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     *
     */
    protected $associatedEvent;

    /**
     * @ORM\OneToMany(targetEntity="NewsFilmProjectionAssociated", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     *
     */
    protected $associatedProjections;

    /**
     * @ORM\OneToMany(targetEntity="NewsFilmFilmAssociated", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"news_show"})
     */
    protected $associatedFilms;

    /**
     * @var NewsWidget
     *
     * @ORM\OneToMany(targetEntity="NewsWidget", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     * @Groups({"news_show"})
     */
    protected $widgets;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     *
     */
    protected $sites;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Groups({"news_list", "search", "news_show", "live", "web_tv_show", "live", "home", "film_show"})
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     * @Groups({"news_list", "search", "news_show", "live", "web_tv_show", "live", "home", "film_show"})
     */
    protected $publishEndedAt;

    /**
     * ArrayCollection
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $translations;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     * @Groups({"news_show"})
     */
    protected $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    protected $updatedBy;

    /**
     * @var MediaVideo
     *
     * @ORM\OneToOne(targetEntity="MediaAudio", cascade={"all"}, inversedBy="homepageNews", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $homepageMediaAudio;

    /**
     * @var MediaVideo
     *
     * @ORM\OneToOne(targetEntity="MediaVideo", cascade={"all"}, inversedBy="homepageNews", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $homepageMediaVideo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $oldNewsId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $oldNewsTable;

    /**
     * @var string
     *
     * @ORM\Column(name="is_main", type="boolean", nullable=true)
     *
     */
    protected $isMain = false;

    /**
     * @var string
     *
     * @ORM\Column(name="is_big", type="boolean", nullable=true)
     *
     */
    protected $isBig = false;

    public function __construct()
    {
        $this->hideSameDay = false;
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->widgets = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->associatedNews = new ArrayCollection();
        $this->associatedProjections = new ArrayCollection();
        $this->associatedFilms = new ArrayCollection();
        $this->displayedHome = false;
        $this->displayedMobile = false;
    }

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
    }

    public static function getTypes()
    {
        return array(
            'Base\CoreBundle\Entity\NewsArticle' => 'article',
            'Base\CoreBundle\Entity\NewsAudio' => 'audio',
            'Base\CoreBundle\Entity\NewsImage' => 'photo',
            'Base\CoreBundle\Entity\NewsVideo' => 'video'
        );
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    public function getNewsType()
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
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\NewsWidget $widgets
     * @return NewsArticleTranslation
     */
    public function addWidget(\Base\CoreBundle\Entity\NewsWidget $widgets)
    {
        $widgets->setNews($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\NewsWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\NewsWidget $widgets)
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
     * @return News
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
     * @return News
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
     * @return NewsArticleTranslation
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
     * @return News
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
     * @param \Base\CoreBundle\Entity\NewsTag $tags
     * @return News
     */
    public function addTag(\Base\CoreBundle\Entity\NewsTag $tags)
    {
        $tags->setNews($this);
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\NewsTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\NewsTag $tags)
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
     * @return News
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
     * @return News
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
     * @return News
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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return News
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
     * @return News
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
     * Add associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsNewsAssociated $associatedNews
     * @return News
     */
    public function addAssociatedNew(\Base\CoreBundle\Entity\NewsNewsAssociated $associatedNews)
    {
        $associatedNews->setNews($this);
        $this->associatedNews[] = $associatedNews;

        return $this;
    }

    /**
     * Remove associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsNewsAssociated $associatedNews
     */
    public function removeAssociatedNew(\Base\CoreBundle\Entity\NewsNewsAssociated $associatedNews)
    {
        $this->associatedNews->removeElement($associatedNews);
    }


    /**
     * Add associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsNewsAssociated $associatedNews
     * @return News
     */
    public function addAssociatedNews(\Base\CoreBundle\Entity\NewsNewsAssociated $associatedNews)
    {
        $associatedNews->setNews($this);
        $this->associatedNews[] = $associatedNews;

        return $this;
    }

    /**
     * Remove associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsNewsAssociated $associatedNews
     */
    public function removeAssociatedNews(\Base\CoreBundle\Entity\NewsNewsAssociated $associatedNews)
    {
        $this->associatedNews->removeElement($associatedNews);
    }

    /**
     * Get associatedNews
     *
     * @return \Base\CoreBundle\Entity\NewsNewsAssociated
     */
    public function getAssociatedNews()
    {
        if ($this->associatedNews->count() < 2) {
            while ($this->associatedNews->count() != 2) {
                $entity = new NewsNewsAssociated();
                $entity->setNews($this);
                $this->associatedNews->add($entity);
            }
        }

        return $this->associatedNews;
    }

    /**
     * Set associatedFilm
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $associatedFilm
     * @return News
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
     * @return News
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
     * @param \Base\CoreBundle\Entity\NewsFilmProjectionAssociated $associatedProjections
     * @return News
     */
    public function addAssociatedProjection(\Base\CoreBundle\Entity\NewsFilmProjectionAssociated $associatedProjections)
    {
        $associatedProjections->setNews($this);
        $this->associatedProjections[] = $associatedProjections;

        return $this;
    }

    /**
     * Remove associatedProjections
     *
     * @param \Base\CoreBundle\Entity\NewsFilmProjectionAssociated $associatedProjections
     */
    public function removeAssociatedProjection(\Base\CoreBundle\Entity\NewsFilmProjectionAssociated $associatedProjections)
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
     * @param \Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedFilms
     * @return News
     */
    public function addAssociatedFilm(\Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedFilms)
    {
        $associatedFilms->setNews($this);
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param \Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(\Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedFilms)
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
     * @return News
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
     * @return News
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
     * Set hideSameDay
     *
     * @param boolean $hideSameDay
     * @return $this
     */
    public function setHideSameDay($hideSameDay)
    {
        $this->hideSameDay = $hideSameDay;
        return $this;
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

    /**
     * Set homepageMediaAudio
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $homepageMediaAudio
     * @return News
     */
    public function setHomepageMediaAudio(\Base\CoreBundle\Entity\MediaAudio $homepageMediaAudio = null)
    {
        $this->homepageMediaAudio = $homepageMediaAudio;

        return $this;
    }

    /**
     * Get homepageMediaAudio
     *
     * @return \Base\CoreBundle\Entity\MediaAudio
     */
    public function getHomepageMediaAudio()
    {
        return $this->homepageMediaAudio;
    }

    /**
     * Set homepageMediaVideo
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $homepageMediaVideo
     * @return News
     */
    public function setHomepageMediaVideo(\Base\CoreBundle\Entity\MediaVideo $homepageMediaVideo = null)
    {
        $this->homepageMediaVideo = $homepageMediaVideo;

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
     * Get homepageMediaVideo
     *
     * @return \Base\CoreBundle\Entity\MediaVideo
     */
    public function getHomepageMediaVideo()
    {
        return $this->homepageMediaVideo;
    }


    /**
     * This method returns feed item title.
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemTitle(){
        return array('title' => $this->findTranslationByLocale(static::$localeTemp)->getTitle());
    }

    /**
     * This method returns feed item description (or content).
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemDescription(){
        return null;
    }

    /**
     * This method returns the name of the route.
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemRouteName(){
        return 'fdc_event_news_get';
    }

    /**
     * This method returns the parameters for the route.
     *
     * @abstract
     *
     * @return array
     */
    public function getFeedItemRouteParameters(){

        $format = 'articles';
        if($this->getNewsType() == 'NewsArticle') {
            $format = 'articles';
        } elseif ($this->getNewsType() == 'NewsAudio') {
            $format = 'audios';
        } elseif ($this->getNewsType() == 'NewsImage') {
            $format = 'videos';
        } elseif ($this->getNewsType() == 'NewsVideo') {
            $format = 'videos';
        }
        return array(
            'format' => $format,
            'slug' => $this->findTranslationByLocale(static::$localeTemp)->getSlug(),
        );
    }

    /**
     * This method returns the anchor to be appended on this item's url.
     *
     * @abstract
     *
     * @return string The anchor, without the "#"
     */
    public function getFeedItemUrlAnchor() {
        return null;
    }

    /**
     * This method returns item publication date.
     *
     * @abstract
     *
     * @return \DateTime
     */
    public function getFeedItemPubDate() {
        return array('date' => $this->getUpdatedAt());
    }

    /**
     * Set typeClone
     *
     * @param string $typeClone
     * @return News
     */
    public function setTypeClone($typeClone)
    {
        $this->typeClone = $typeClone;

        return $this;
    }

    /**
     * Get typeClone
     *
     * @return string
     */
    public function getTypeClone()
    {
        return $this->typeClone;
    }

    public function isElasticable()
    {
        $isElasticable = true;
        $fr = $this->findTranslationByLocale('fr');
        if ($fr == null || $fr->getStatus() !== TranslateChildInterface::STATUS_PUBLISHED) {
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
     * Set oldNewsId
     *
     * @param integer $oldNewsId
     * @return News
     */
    public function setOldNewsId($oldNewsId)
    {
        $this->oldNewsId = $oldNewsId;

        return $this;
    }

    /**
     * Get oldNewsId
     *
     * @return integer
     */
    public function getOldNewsId()
    {
        return $this->oldNewsId;
    }

    /**
     * Set oldNewsTable
     *
     * @param string $oldNewsTable
     * @return News
     */
    public function setOldNewsTable($oldNewsTable)
    {
        $this->oldNewsTable = $oldNewsTable;

        return $this;
    }

    /**
     * Get oldNewsTable
     *
     * @return string
     */
    public function getOldNewsTable()
    {
        return $this->oldNewsTable;
    }

    /**
     * Set isMain
     *
     * @param boolean $isMain
     * @return News
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    /**
     * Get isMain
     *
     * @return boolean 
     */
    public function getIsMain()
    {
        return $this->isMain;
    }

    /**
     * Set isBig
     *
     * @param boolean $isBig
     * @return News
     */
    public function setIsBig($isBig)
    {
        $this->isBig = $isBig;

        return $this;
    }

    /**
     * Get isBig
     *
     * @return boolean 
     */
    public function getIsBig()
    {
        return $this->isBig;
    }
}
