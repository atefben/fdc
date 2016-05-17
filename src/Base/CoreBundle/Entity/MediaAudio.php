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

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"all"})
     *
     * @Groups({"news_show", "news_list", "search", "trailer_list", "trailer_show", "web_tv_show", "live", "film_show", "event_show", "home"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="MediaAudioFilmFilmAssociated", mappedBy="mediaAudio", cascade={"all"})
     *
     * @Groups({"trailer_list", "trailer_show"})
     */
    private $associatedFilms;

    /**
     * @var NewsAudio
     *
     * @ORM\OneToOne(targetEntity="NewsAudio", cascade={"all"}, inversedBy="homepageMediaAudio", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $homepageNews;


    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return MediaAudio
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Add associatedFilms
     *
     * @param \Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedFilms
     * @return MediaAudio
     */
    public function addAssociatedFilm(\Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedFilms)
    {
        $associatedFilms->setMediaAudio($this);
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param \Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(\Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedFilms)
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
     * @param \Base\CoreBundle\Entity\NewsAudio $homepageNews
     * @return MediaAudio
     */
    public function setHomepageNews(\Base\CoreBundle\Entity\NewsAudio $homepageNews = null)
    {
        $this->homepageNews = $homepageNews;

        return $this;
    }

    /**
     * Get homepageNews
     *
     * @return \Base\CoreBundle\Entity\NewsAudio
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
        return array('title' => $this->findTranslationByLocale('fr')->getTitle());
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
     * @return \DateTime
     */
    public function getFeedItemPubDate() {
        return array('date' => $this->getUpdatedAt());
    }

}
