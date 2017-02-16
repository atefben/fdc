<?php

namespace FDC\CourtMetrageBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\Theme;
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
use JMS\Serializer\Annotation\VirtualProperty;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmNews
 *
 * @ORM\Table(name="ccm_news")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmNewsRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"article" = "CcmNewsArticle", "audio" = "CcmNewsAudio", "image" = "CcmNewsImage", "video" = "CcmNewsVideo"})
 */
abstract class CcmNews implements TranslateMainInterface,RoutedItemInterface
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
      * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\Theme", inversedBy="ccmNews")
      * @ORM\JoinColumn(name="theme_id", referencedColumnName="id", nullable=true)
      *
      * @Groups({"news_list", "search", "news_show", "home", "film_show"})
      */
    protected $theme;

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
     * @ORM\Column(type="boolean", options={"default":0}, nullable=true)
     */
    protected $excludeFromSearch;

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
     * @ORM\OneToMany(targetEntity="CcmNewsNewsAssociated", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $associatedNews;

    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\FilmFilm", inversedBy="ccmNews")
     */
    protected $associatedFilm;
    
    /**
     * @var CcmNewsWidget
     *
     * @ORM\OneToMany(targetEntity="CcmNewsWidget", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     * @Groups({"news_show"})
     */
    protected $widgets;

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
     * @ORM\OneToOne(targetEntity="Base\CoreBundle\Entity\MediaAudio", cascade={"all"}, inversedBy="homepageNews", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $homepageMediaAudio;

    /**
     * @var MediaVideo
     *
     * @ORM\OneToOne(targetEntity="Base\CoreBundle\Entity\MediaVideo", cascade={"all"}, inversedBy="homepageNews", orphanRemoval=true)
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

    public function __construct()
    {
        $this->hideSameDay = false;
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
        $this->associatedNews = new ArrayCollection();
        $this->displayedHome = false;
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
            'FDC\CourtMetrageBundle\Entity\CcmNewsArticle' => 'article',
            'FDC\CourtMetrageBundle\Entity\CcmNewsAudio' => 'audio',
            'FDC\CourtMetrageBundle\Entity\CcmNewsImage' => 'photo',
            'FDC\CourtMetrageBundle\Entity\CcmNewsVideo' => 'video'
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
     * @return string
     */
    public function getType()
    {
        return strtolower(str_replace('CcmNews', '', $this->getNewsType()));
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
     * @param \FDC\CourtMetrageBundle\Entity\CcmNewsWidget $widgets
     * @return CcmNews
     */
    public function addWidget(CcmNewsWidget $widgets)
    {
        $widgets->setNews($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \FDC\CourtMetrageBundle\Entity\CcmNewsWidget $widgets
     */
    public function removeWidget(CcmNewsWidget $widgets)
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
     * @return CcmNews
     */
    public function setTheme(Theme $theme = null)
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
     * Set priorityStatus
     *
     * @param integer $priorityStatus
     * @return CcmNews
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
     * @return CcmNews
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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return CcmNews
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
     * @return CcmNews
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
     * @param CcmNewsNewsAssociated $associatedNews
     * @return CcmNews
     */
    public function addAssociatedNew(CcmNewsNewsAssociated $associatedNews)
    {
        $associatedNews->setNews($this);
        $this->associatedNews[] = $associatedNews;

        return $this;
    }

    /**
     * Remove associatedNews
     *
     * @param CcmNewsNewsAssociated $associatedNews
     */
    public function removeAssociatedNew(CcmNewsNewsAssociated $associatedNews)
    {
        $this->associatedNews->removeElement($associatedNews);
    }


    /**
     * Add associatedNews
     *
     * @param CcmNewsNewsAssociated $associatedNews
     * @return CcmNews
     */
    public function addAssociatedNews(CcmNewsNewsAssociated $associatedNews)
    {
        $associatedNews->setNews($this);
        $this->associatedNews[] = $associatedNews;

        return $this;
    }

    /**
     * Remove associatedNews
     *
     * @param CcmNewsNewsAssociated $associatedNews
     */
    public function removeAssociatedNews(CcmNewsNewsAssociated $associatedNews)
    {
        $this->associatedNews->removeElement($associatedNews);
    }

    /**
     * Get associatedNews
     *
     * @return CcmNewsNewsAssociated
     */
    public function getAssociatedNews()
    {
        if ($this->associatedNews->count() < 2) {
            while ($this->associatedNews->count() != 2) {
                $entity = new CcmNewsNewsAssociated();
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
     * @return CcmNews
     */
    public function setAssociatedFilm(FilmFilm $associatedFilm = null)
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
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return CcmNews
     */
    public function setCreatedBy(User $createdBy = null)
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
     * @return CcmNews
     */
    public function setUpdatedBy(User $updatedBy = null)
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
     * @return CcmNews
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
     * @return CcmNews
     */
    public function setHomepageMediaAudio(MediaAudio $homepageMediaAudio = null)
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
     * @return CcmNews
     */
    public function setHomepageMediaVideo(MediaVideo $homepageMediaVideo = null)
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
        return 'ccm_event_news_get';
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
        if($this->getNewsType() == 'CcmNewsArticle') {
            $format = 'articles';
        } elseif ($this->getNewsType() == 'CcmNewsAudio') {
            $format = 'audios';
        } elseif ($this->getNewsType() == 'CcmNewsImage') {
            $format = 'videos';
        } elseif ($this->getNewsType() == 'CcmNewsVideo') {
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
     * @return CcmNews
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
     * @return CcmNews
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
     * @return CcmNews
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
     * @return CcmNews
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
}
