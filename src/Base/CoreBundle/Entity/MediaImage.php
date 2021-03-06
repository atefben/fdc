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

    public function __construct()
    {
        parent::__construct();
        $this->galleries = new ArrayCollection();
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
}
