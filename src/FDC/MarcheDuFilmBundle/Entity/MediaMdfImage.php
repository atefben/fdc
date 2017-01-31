<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Util\Time;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use Symfony\Component\Validator\Constraints as Assert;
use Zend\Stdlib\ArrayObject;

/**
 * MediaMdfImage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MediaMdfImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaMdfImage extends MediaMdf
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
     * @var MdfConferencePartnerLogo
     *
     * @ORM\OneToMany(targetEntity="MdfConferencePartnerLogo", mappedBy="image")
     */
    protected $logo;

    /**
     * @var Contact
     *
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="image")
     */
    protected $contact;

    /**
     * @var DispatchDeServiceWidget
     *
     * @ORM\OneToMany(targetEntity="DispatchDeServiceWidget", mappedBy="image")
     */
    protected $dispatchDeService;

    /**
     * @var GalleryMdfDualAlignMedia
     *
     * @ORM\OneToMany(targetEntity="GalleryMdfDualAlignMedia", mappedBy="media")
     */
    protected $galleryMdfDualAlignMedia;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="GalleryMdfMedia", mappedBy="media")
     */
    protected $galleryMdfMedia;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="HeaderFooter", mappedBy="headerBanner")
     */
    protected $headerFooter;
    
    /**
     * @var HomeSlider
     *
     * @ORM\OneToMany(targetEntity="HomeSlider", mappedBy="image")
     */
    protected $homeSlider;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->logo = new ArrayCollection();
        $this->contact = new ArrayCollection();
        $this->dispatchDeService = new ArrayCollection();
        $this->galleryMdfDualAlignMedia = new ArrayCollection();
        $this->galleryMdfMedia = new ArrayCollection();
        $this->headerFooter = new ArrayCollection();
        $this->homeSlider = new ArrayCollection();
    }

    public function getApiTranslations()
    {
        $en = $this->findTranslationByLocale('en');
        $fr = $this->findTranslationByLocale('fr');
        if ((!$en || !$en->getFile() || $en->getStatus() !== MediaMdfImageTranslation::STATUS_TRANSLATED) && $fr) {
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
     * @param MdfConferencePartnerLogo $conferencePartnerLogo
     * @return $this
     */
    public function addLogo(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerLogo $conferencePartnerLogo)
    {
        $conferencePartnerLogo->setImage($this);
        $this->logo[] = $conferencePartnerLogo;

        return $this;
    }

    /**
     * @param MdfConferencePartnerLogo $conferencePartnerLogo
     */
    public function removeLogo(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerLogo $conferencePartnerLogo)
    {
        $this->logo->removeElement($conferencePartnerLogo);
    }

    /**
     * @return ArrayCollection|MdfConferencePartnerLogo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param Contact $contact
     * @return $this
     */
    public function addContact(\FDC\MarcheDuFilmBundle\Entity\Contact $contact)
    {
        $contact->setImage($this);
        $this->contact[] = $contact;

        return $this;
    }

    /**
     * @param Contact $contact
     */
    public function removeContact(\FDC\MarcheDuFilmBundle\Entity\Contact $contact)
    {
        $this->contact->removeElement($contact);
    }

    /**
     * @return ArrayCollection|Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param DispatchDeServiceWidget $dispatchDeServiceWidget
     * @return $this
     */
    public function addDispatchDeService(\FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceWidget $dispatchDeServiceWidget)
    {
        $dispatchDeServiceWidget->setImage($this);
        $this->dispatchDeService[] = $dispatchDeServiceWidget;

        return $this;
    }

    /**
     * @param DispatchDeServiceWidget $dispatchDeServiceWidget
     */
    public function removeDispatchDeService(\FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceWidget $dispatchDeServiceWidget)
    {
        $this->dispatchDeService->removeElement($dispatchDeServiceWidget);
    }

    /**
     * @return ArrayCollection|DispatchDeServiceWidget
     */
    public function getDispatchDeService()
    {
        return $this->dispatchDeService;
    }

    /**
     * @param GalleryMdfDualAlignMedia $galleryMdfDualAlignMedia
     * @return $this
     */
    public function addGalleryMdfDualAlignMedia(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlignMedia $galleryMdfDualAlignMedia)
    {
        $galleryMdfDualAlignMedia->setMedia($this);
        $this->galleryMdfDualAlignMedia[] = $galleryMdfDualAlignMedia;

        return $this;
    }

    /**
     * @param GalleryMdfDualAlignMedia $galleryMdfDualAlignMedia
     */
    public function removeGalleryMdfDualAlignMedia(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfDualAlignMedia $galleryMdfDualAlignMedia)
    {
        $this->galleryMdfDualAlignMedia->removeElement($galleryMdfDualAlignMedia);
    }

    /**
     * @return ArrayCollection|GalleryMdfDualAlignMedia
     */
    public function getGalleryMdfDualAlignMedia()
    {
        return $this->galleryMdfDualAlignMedia;
    }

    /**
     * @param GalleryMdfMedia $galleryMdfMedia
     * @return $this
     */
    public function addGalleryMdfMedia(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfMedia $galleryMdfMedia)
    {
        $galleryMdfMedia->setMedia($this);
        $this->galleryMdfMedia[] = $galleryMdfMedia;

        return $this;
    }

    /**
     * @param GalleryMdfMedia $galleryMdfMedia
     */
    public function removeGalleryMdfMedia(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfMedia $galleryMdfMedia)
    {
        $this->galleryMdfMedia->removeElement($galleryMdfMedia);
    }

    /**
     * @return ArrayCollection|GalleryMdfMedia
     */
    public function getGalleryMdfMedia()
    {
        return $this->galleryMdfMedia;
    }

    /**
     * @param HeaderFooter $headerFooter
     * @return $this
     */
    public function addHeaderFooter(\FDC\MarcheDuFilmBundle\Entity\HeaderFooter $headerFooter)
    {
        $headerFooter->setHeaderBanner($this);
        $this->headerFooter[] = $headerFooter;

        return $this;
    }

    /**
     * @param HeaderFooter $headerFooter
     */
    public function removeHeaderFooter(\FDC\MarcheDuFilmBundle\Entity\HeaderFooter $headerFooter)
    {
        $this->headerFooter->removeElement($headerFooter);
    }

    /**
     * @return ArrayCollection|GalleryMdfMedia
     */
    public function getHeaderFooter()
    {
        return $this->headerFooter;
    }

    /**
     * @param HomeSlider $homeSlider
     * @return $this
     */
    public function addHomeSlider(\FDC\MarcheDuFilmBundle\Entity\HomeSlider $homeSlider)
    {
        $homeSlider->setImage($this);
        $this->homeSlider[] = $homeSlider;

        return $this;
    }

    /**
     * @param HomeSlider $homeSlider
     */
    public function removeHomeSlider(\FDC\MarcheDuFilmBundle\Entity\HomeSlider $homeSlider)
    {
        $this->homeSlider->removeElement($homeSlider);
    }

    /**
     * @return ArrayCollection|HomeSlider
     */
    public function getHomeSlider()
    {
        return $this->homeSlider;
    }
}
