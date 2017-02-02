<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Symfony\Component\Validator\Constraints as Assert;

use Base\AdminBundle\Component\Admin\Export;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * MediaMdfVideo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MediaMdfVideoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaMdfVideo extends MediaMdf
{
    use Translatable;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    private $displayedWebTv;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     * @Groups({
     *  "film_show"
     * })
     */
    private $displayedTrailer;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    private $displayedHomeCorpo;

    /**
     * @var \FDC\MarcheDuFilmBundle\Entity\MdfTheme
     *
     * @ORM\ManyToOne(targetEntity="\FDC\MarcheDuFilmBundle\Entity\MdfTheme")
     *
     */
    private $themeHomeCorpo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateHomeCorpo;

    /**
     * @var \Base\CoreBundle\Entity\Homepage
     *
     * @ORM\ManyToOne(targetEntity="\Base\CoreBundle\Entity\Homepage", inversedBy="topVideos")
     */
    private $homepage;

    /**
     * @var \Base\CoreBundle\Entity\WebTv
     *
     * @ORM\ManyToOne(targetEntity="\Base\CoreBundle\Entity\WebTv", inversedBy="mediaVideos")
    private $webTv;

    /**
     * @var MediaMdfImage
     *
     * @ORM\ManyToOne(targetEntity="MediaMdfImage", cascade={"persist"}, inversedBy="mediaMdfVideo")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     * @Groups({"trailer_list", "trailer_show", "live", "web_tv_show", "live", "film_show", "news_list", "search", "news_show", "event_show", "home", "orange_video_on_demand",
     *     "search"})
     */
    private $image;

    /**
     * @var \Base\CoreBundle\Entity\NewsVideo
     *
     * @ORM\OneToOne(targetEntity="\Base\CoreBundle\Entity\NewsVideo", cascade={"all"}, mappedBy="homepageMediaVideo")
     */
    private $homepageNews;

    /**
     * @ORM\OneToMany(targetEntity="MediaMdfVideoFilmFilmAssociated", mappedBy="mediaVideo", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"trailer_list", "trailer_show"})
     */
    private $associatedFilms;

    public function __construct()
    {
        parent::__construct();
        $this->displayedWebTv = false;
        $this->displayedTrailer = false;
    }

    /**
     * Set displayedWebTv
     *
     * @param boolean $displayedWebTv
     * @return MediaVideo
     */
    public function setDisplayedWebTv($displayedWebTv)
    {
        $this->displayedWebTv = $displayedWebTv;

        return $this;
    }

    /**
     * Get displayedWebTv
     * @return boolean
     */
    public function getDisplayedWebTv()
    {
        return $this->displayedWebTv;
    }

    public function isDisplayedWebTvChecked()
    {
        return ($this->getDisplayedWebTv() == true && $this->getWebTv() == null);
    }

    /**
     * Set displayedTrailer
     *
     * @param boolean $displayedTrailer
     * @return MediaVideo
     */
    public function setDisplayedTrailer($displayedTrailer)
    {
        $this->displayedTrailer = $displayedTrailer;

        return $this;
    }

    /**
     * Get displayedTrailer
     *
     * @return boolean
     */
    public function getDisplayedTrailer()
    {
        return $this->displayedTrailer;
    }

    /**
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return MediaVideo
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
     * Set webTv
     *
     * @param \Base\CoreBundle\Entity\WebTv $webTv
     * @return MediaVideo
     */
    public function setWebTv(\Base\CoreBundle\Entity\WebTv $webTv = null)
    {
        $this->webTv = $webTv;

        return $this;
    }

    /**
     * Get webTv
     *
     * @return \Base\CoreBundle\Entity\WebTv
     */
    public function getWebTv()
    {
        return $this->webTv;
    }

    /**
     * Set image
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $image
     * @return MediaVideo
     */
    public function setImage(\FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Add associatedFilms
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfVideoFilmFilmAssociated $associatedFilms
     * @return MediaMdfVideo
     */
    public function addAssociatedFilm(\FDC\MarcheDuFilmBundle\Entity\MediaMdfVideoFilmFilmAssociated $associatedFilms)
    {
        $associatedFilms->setMediaVideo($this);
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfVideoFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(\FDC\MarcheDuFilmBundle\Entity\MediaMdfVideoFilmFilmAssociated $associatedFilms)
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
     * @param \Base\CoreBundle\Entity\NewsVideo $homepageNews
     * @return MediaVideo
     */
    public function setHomepageNews(\Base\CoreBundle\Entity\NewsVideo $homepageNews = null)
    {
        $this->homepageNews = $homepageNews;

        return $this;
    }

    /**
     * Get homepageNews
     *
     * @return \Base\CoreBundle\Entity\NewsVideo
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

    public function getExportWebTv()
    {
        return Export::translationField($this->getWebTv(), 'name', 'fr');
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

    public function getExportDisplayedTrailer()
    {
        return Export::yesOrNo($this->getDisplayedTrailer());
    }

    /**
     * Set displayedHomeCorpo
     *
     * @param boolean $displayedHomeCorpo
     * @return MediaVideo
     */
    public function setDisplayedHomeCorpo($displayedHomeCorpo)
    {
        $this->displayedHomeCorpo = $displayedHomeCorpo;

        return $this;
    }

    /**
     * Get displayedHomeCorpo
     *
     * @return boolean
     */
    public function getDisplayedHomeCorpo()
    {
        return $this->displayedHomeCorpo;
    }

    /**
     * Set themeHomeCorpo
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfTheme $themeHomeCorpo
     * @return MediaVideo
     */
    public function setThemeHomeCorpo(\FDC\MarcheDuFilmBundle\Entity\MdfTheme $themeHomeCorpo = null)
    {
        $this->themeHomeCorpo = $themeHomeCorpo;

        return $this;
    }

    /**
     * Get themeHomeCorpo
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MdfTheme
     */
    public function getThemeHomeCorpo()
    {
        return $this->themeHomeCorpo;
    }

    /**
     * Set dateHomeCorpo
     *
     * @param \DateTime $dateHomeCorpo
     * @return MediaVideo
     */
    public function setDateHomeCorpo($dateHomeCorpo)
    {
        $this->dateHomeCorpo = $dateHomeCorpo;

        return $this;
    }

    /**
     * Get dateHomeCorpo
     *
     * @return \DateTime
     */
    public function getDateHomeCorpo()
    {
        return $this->dateHomeCorpo;
    }
}
