<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationByLocale;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use Symfony\Component\Validator\Constraints as Assert;
use Zend\Stdlib\ArrayObject;

/**
 * MediaImage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\MediaImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaImage extends Media
{
    use Translatable;

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
     * @Serializer\Accessor(getter="getApiTranslations")
     */
    protected $translations;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="GalleryMedia", mappedBy="media")
     */
    protected $galleries;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\HomepageSlider", mappedBy="image")
     */
    protected $homepageSliders;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\HomepagePush", mappedBy="image")
     */
    protected $homepagePushes;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\HomepageActualite", mappedBy="image")
     */
    protected $homepageActualites;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\HomepageSejour", mappedBy="image")
     */
    protected $homepageSejoures;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\Homepage", mappedBy="catalogImage")
     */
    protected $catalogPushes;


    public function __construct()
    {
        parent::__construct();
        $this->galleries = new ArrayCollection();
        $this->homepageSliders = new ArrayCollection();
        $this->homepagePushes = new ArrayCollection();
        $this->catalogPushes = new ArrayCollection();
        $this->actualites = new ArrayCollection();
        $this->homepageSejoures = new ArrayCollection();
    }

    public function getApiTranslations()
    {
        $en = $this->findTranslationByLocale('en');
        $fr = $this->findTranslationByLocale('fr');
        if ((!$en || !$en->getFile() || $en->getStatus() !== MediaImageTranslation::STATUS_TRANSLATED) && $fr) {
            $this->translations->set('en', $fr);
        }
        return $this->translations;
    }


    public function getExportLegend()
    {
        return Export::translationField($this, 'legend', 'fr');
    }

    public function getExportTheme()
    {
        return Export::translationField($this->getTheme(), 'name', 'fr');
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

    public function getExportDisplayedAll()
    {
        return Export::yesOrNo($this->getDisplayedAll());
    }

    /**
     * Add galleries
     *
     * @param \Base\CoreBundle\Entity\GalleryMedia $galleries
     * @return MediaImage
     */
    public function addGallery(\Base\CoreBundle\Entity\GalleryMedia $galleries)
    {
        $this->galleries[] = $galleries;
        $galleries->setMedia($this);

        return $this;
    }

    /**
     * Remove galleries
     *
     * @param \Base\CoreBundle\Entity\GalleryMedia $galleries
     */
    public function removeGallery(\Base\CoreBundle\Entity\GalleryMedia $galleries)
    {
        $this->galleries->removeElement($galleries);
    }

    /**
     * Get galleries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGalleries()
    {
        return $this->galleries;
    }

    /**
     * Add homepageSlider.
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepageSlider $homepageSlider
     * @return $this
     */
    public function addHomepageSlider(\FDC\CourtMetrageBundle\Entity\HomepageSlider $homepageSlider)
    {
        $this->homepageSliders[] = $homepageSlider;
        $homepageSlider->setImage($this);

        return $this;
    }

    /**
     *
     * Remove homepageSlider
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepageSlider $homepageSlider
     */
    public function removeHomepageSlider(\FDC\CourtMetrageBundle\Entity\HomepageSlider $homepageSlider)
    {
        $this->homepageSliders->removeElement($homepageSlider);
    }

    /**
     * Get homepageSliders.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomepageSliders()
    {
        return $this->homepageSliders;
    }

    /**
     * Add homepagePush.
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepagePush $homepagePush
     * @return $this
     */
    public function addHomepagePush(\FDC\CourtMetrageBundle\Entity\HomepagePush $homepagePush)
    {
        $this->homepagePushes[] = $homepagePush;
        $homepagePush->setImage($this);

        return $this;
    }

    /**
     *
     * Remove homepagePush
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepagePush $homepagePush
     */
    public function removeHomepagePush(\FDC\CourtMetrageBundle\Entity\HomepagePush $homepagePush)
    {
        $this->homepagePushes->removeElement($homepagePush);
    }

    /**
     * Get homepagePush.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomepagePushes()
    {
        return $this->homepagePushes;
    }

    /**
     * Get catalogPushes.
     *
     * @return ArrayCollection
     */
    public function getCatalogPushes()
    {
        return $this->catalogPushes;
    }

    /**
     * Set catalogPushes.
     *
     * @param ArrayCollection $catalogPushes
     */
    public function setCatalogPushes($catalogPushes)
    {
        $this->catalogPushes = $catalogPushes;
    }

    /**
     * Add catalogPush.
     *
     * @param \FDC\CourtMetrageBundle\Entity\Homepage $catalogPush
     * @return $this
     */
    public function addCatalogPush(\FDC\CourtMetrageBundle\Entity\Homepage $catalogPush)
    {
        $this->catalogPushes[] = $catalogPush;
        $catalogPush->setCatalogPushes($this);

        return $this;
    }

    /**
     * Remove catalogPush.
     *
     * @param \FDC\CourtMetrageBundle\Entity\Homepage $catalogPush
     */
    public function removeCatalogPush(\FDC\CourtMetrageBundle\Entity\Homepage $catalogPush)
    {
        $this->homepagePushes->removeElement($catalogPush);
    }

    /**
     * Get homepageActualite.
     *
     * @return ArrayCollection
     */
    public function getHomepageActualites()
    {
        return $this->homepageActualites;
    }

    /**
     * Set homepageActualites.
     *
     * @param ArrayCollection $homepageActualites
     */
    public function setHomepageActualites($homepageActualites)
    {
        $this->homepageActualites = $homepageActualites;

        return $this;
    }

    /**
     * Add homepageActualite.
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepageActualite $homepageActualite
     * @return $this
     */
    public function addHomepageActualite(\FDC\CourtMetrageBundle\Entity\HomepageActualite $homepageActualite)
    {
        $this->homepageActualites[] = $homepageActualite;
        $homepageActualite->setImage($this);

        return $this;
    }

    /**
     * Remove homepageActualite
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepageActualite $homepageActualite
     */
    public function removeHomepageActualite(\FDC\CourtMetrageBundle\Entity\HomepageActualite $homepageActualite)
    {
        $this->homepageActualites->removeElement($homepageActualite);
    }

    /**
     * Get homepageSejour.
     *
     * @return ArrayCollection
     */
    public function getHomepageSejour()
    {
        return $this->homepageSejour;
    }

    /**
     * Set homepageSejour.
     *
     * @param ArrayCollection $homepageSejour
     */
    public function setHomepageSejour($homepageSejour)
    {
        $this->homepageSejour = $homepageSejour;

        return $this;
    }

    /**
     * Add homepageSejour.
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepageSejour $homepageSejour
     * @return $this
     */
    public function addHomepageSejour(\FDC\CourtMetrageBundle\Entity\HomepageSejour $homepageSejour)
    {
        $this->homepageSejoures[] = $homepageSejour;
        $homepageSejour->setImage($this);

        return $this;
    }

    /**
     * Remove homepageSejour
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepageSejour $homepageSejour
     */
    public function removeHomepageSejour(\FDC\CourtMetrageBundle\Entity\HomepageSejour $homepageSejour)
    {
        $this->homepageSejoures->removeElement($homepageSejour);
    }
}
