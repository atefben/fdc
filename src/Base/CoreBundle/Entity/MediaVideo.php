<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Symfony\Component\Validator\Constraints as Assert;

use Base\AdminBundle\Component\Admin\Export;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * MediaVideo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\MediaVideoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaVideo extends Media
{
    use Translatable;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    protected $displayedWebTv;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     * @Groups({
     *  "film_show"
     * })
     */
    protected $displayedTrailer;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    protected $displayedHomeCorpo;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     *
     */
    protected $themeHomeCorpo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $dateHomeCorpo;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="topVideos")
     */
    protected $homepage;

    /**
     * @var WebTv
     *
     * @ORM\ManyToOne(targetEntity="WebTv", inversedBy="mediaVideos")
     * @Assert\Expression(
     *     "this.isDisplayedWebTvChecked() == false",
     *     message="Cette valeur ne doit pas être nulle."
     * )
     */
    protected $webTv;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"trailer_list", "trailer_show", "live", "web_tv_show", "live", "film_show", "news_list", "search", "news_show", "event_show", "home", "orange_video_on_demand",
     *     "search"})
     */
    protected $image;

    /**
     * @var NewsVideo
     *
     * @ORM\OneToOne(targetEntity="NewsVideo", cascade={"all"}, mappedBy="homepageMediaVideo")
     * @ORM\JoinColumn(name="homepage_news_id", referencedColumnName="id")
     */
    protected $homepageNews;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="MediaVideoFilmFilmAssociated", mappedBy="mediaVideo", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"trailer_list", "trailer_show"})
     */
    protected $associatedFilms;

    public function __construct()
    {
        parent::__construct();
        $this->associatedFilms = new ArrayCollection();
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


    /**
     * @Assert\IsFalse(message = "Vous ne pouvez avoir coché 'Afficher dans une chaîne de la webTV' et laisser le champ 'Chaîne' vide")
     */
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
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return MediaVideo
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
     * @param \Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedFilms
     * @return MediaVideo
     */
    public function addAssociatedFilm(\Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedFilms)
    {
        $associatedFilms->setMediaVideo($this);
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param \Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(\Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedFilms)
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
        if (!$this->getCreatedBy()) {
            return '';
        }
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

    public function getExportDisplayedTrailer()
    {
        return Export::yesOrNo($this->getDisplayedTrailer());
    }

    /**
     * Set displayedHomeCorpo
     *
     * @param boolean $displayedHomeCorpo
     * @return $this
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
     * @param \Base\CoreBundle\Entity\Theme $themeHomeCorpo
     * @return MediaVideo
     */
    public function setThemeHomeCorpo(\Base\CoreBundle\Entity\Theme $themeHomeCorpo = null)
    {
        $this->themeHomeCorpo = $themeHomeCorpo;

        return $this;
    }

    /**
     * Get themeHomeCorpo
     *
     * @return \Base\CoreBundle\Entity\Theme
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
