<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\AdminBundle\Component\Admin\Export;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Eko\FeedBundle\Item\Writer\RoutedItemInterface;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * MediaAudio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaAudio extends Media implements RoutedItemInterface
{
    use Translatable;

    public static $localeTemp = 'fr';

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"all"})
     *
     * @Groups({"news_show", "news_list", "search", "trailer_list", "trailer_show", "web_tv_show", "live", "film_show", "event_show", "home"})
     */
    protected $image;

    /**
     * @ORM\OneToMany(targetEntity="MediaAudioFilmFilmAssociated", mappedBy="mediaAudio", cascade={"all"})
     *
     * @Groups({"trailer_list", "trailer_show"})
     */
    protected $associatedFilms;

    /**
     * @var NewsAudio
     *
     * @ORM\OneToOne(targetEntity="NewsAudio", cascade={"all"}, mappedBy="homepageMediaAudio", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $homepageNews;

    /**
     * MediaAudio constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->associatedFilms = new ArrayCollection();
    }

    /**
     * Set image
     *
     * @param MediaImage $image
     * @return MediaAudio
     */
    public function setImage(MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Add associatedFilms
     *
     * @param MediaAudioFilmFilmAssociated $associatedFilms
     * @return MediaAudio
     */
    public function addAssociatedFilm(MediaAudioFilmFilmAssociated $associatedFilms)
    {
        $associatedFilms->setMediaAudio($this);
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param MediaAudioFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(MediaAudioFilmFilmAssociated $associatedFilms)
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
     * Set homepageNews
     *
     * @param NewsAudio $homepageNews
     * @return MediaAudio
     */
    public function setHomepageNews(NewsAudio $homepageNews = null)
    {
        $this->homepageNews = $homepageNews;

        return $this;
    }

    /**
     * Get homepageNews
     *
     * @return NewsAudio
     */
    public function getHomepageNews()
    {
        return $this->homepageNews;
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
        return $this->getCreatedBy() ? $this->getCreatedBy()->getId() : '';
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
        if (!$this->findTranslationByLocale('fr')) {
            return '';
        }
        $status = $this->findTranslationByLocale('fr')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEn()
    {
        if (!$this->findTranslationByLocale('en')) {
            return '';
        }
        $status = $this->findTranslationByLocale('en')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEs()
    {
        if (!$this->findTranslationByLocale('es')) {
            return '';
        }
        $status = $this->findTranslationByLocale('es')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusZh()
    {
        if (!$this->findTranslationByLocale('zh')) {
            return '';
        }
        $status = $this->findTranslationByLocale('zh')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportDisplayedHome()
    {
        return Export::yesOrNo($this->getDisplayedHome());
    }

    public function getExportSites()
    {
        return Export::sites($this->getSites());
    }

    public function getExportDisplayedAll()
    {
        return Export::yesOrNo($this->getDisplayedAll());

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
        return array('description' => 'description');
    }

    /**
     * This method returns the name of the route.
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemRouteName(){
        return 'fdc_event_news_getaudios';
    }

    /**
     * This method returns the parameters for the route.
     *
     * @abstract
     *
     * @return array
     */
    public function getFeedItemRouteParameters(){
        return null;
    }

    /**
     * This method returns the anchor to be appended on this item's url.
     *
     * @abstract
     *
     * @return string The anchor, without the "#"
     */
    public function getFeedItemUrlAnchor() {
        return 'aid='.$this->id;
    }

    /**
     * This method returns item publication date.
     *
     * @abstract
     *
     * @return array
     */
    public function getFeedItemPubDate() {
        return array('date' => $this->getUpdatedAt());
    }

}
