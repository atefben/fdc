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
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="topVideos")
     */
    private $homepage;

    /**
     * @var WebTv
     *
     * @ORM\ManyToOne(targetEntity="WebTv", inversedBy="mediaVideos")
     * @Assert\Expression(
     *     "this.isDisplayedWebTvChecked() == false",
     *     message="Cette valeur ne doit pas être nulle."
     * )
     */
    private $webTv;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"trailer_list", "trailer_show", "live", "web_tv_show", "live", "film_show", "news_list", "news_show", "event_show", "home"})
     */
    private $image;

    /**
     * @var NewsVideo
     *
     * @ORM\ManyToOne(targetEntity="NewsVideo", cascade={"all"})
     */
    private $homepageNews;

    /**
     * @ORM\OneToMany(targetEntity="MediaVideoFilmFilmAssociated", mappedBy="mediaVideo", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"trailer_list", "trailer_show"})
     */
    private $associatedFilms;

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
}
