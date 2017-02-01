<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Util\Time;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\SecurityExtraBundle\Tests\Fixtures\A;
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
     * @ORM\OneToMany(targetEntity="MdfConferencePartnerLogo", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $logo;

    /**
     * @var Contact
     *
     * @ORM\OneToMany(targetEntity="Contact", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $contact;

    /**
     * @var DispatchDeServiceWidget
     *
     * @ORM\OneToMany(targetEntity="DispatchDeServiceWidget", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $dispatchDeService;

    /**
     * @var GalleryMdfDualAlignMedia
     *
     * @ORM\OneToMany(targetEntity="GalleryMdfDualAlignMedia", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="media")
     */
    protected $galleryMdfDualAlignMedia;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="GalleryMdfMedia", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="media")
     */
    protected $galleryMdfMedia;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="HeaderFooter", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="headerBanner")
     */
    protected $headerFooter;
    
    /**
     * @var HomeSlider
     *
     * @ORM\OneToMany(targetEntity="HomeSlider", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $homeSlider;

    /**
     * @var HomeSliderTop
     *
     * @ORM\OneToMany(targetEntity="HomeSliderTop", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $homeSliderTop;

    /**
     * @var MdfConferenceInfoAndContactWidget
     *
     * @ORM\OneToMany(targetEntity="MdfConferenceInfoAndContactWidget", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $infoAndContact;

    /**
     * @var MdfContentTemplateWidgetImage
     *
     * @ORM\OneToMany(targetEntity="MdfContentTemplateWidgetImage", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $contentTemplateWidgetImage;

    /**
     * @var MdfContentTemplateWidgetVideo
     *
     * @ORM\OneToMany(targetEntity="MdfContentTemplateWidgetVideo", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $contentTemplateWidgetVideo;

    /**
     * @var MdfHomeService
     *
     * @ORM\OneToMany(targetEntity="MdfHomeService", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $homeService;

    /**
     * @var MdfProgramSpeaker
     *
     * @ORM\OneToMany(targetEntity="MdfProgramSpeaker", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $programSpeaker;

    /**
     * @var MdfServiceGalleryMedia
     *
     * @ORM\OneToMany(targetEntity="MdfServiceGalleryMedia", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="media")
     */
    protected $serviceGalleryMedia;

    /**
     * @var MdfSpeakersDetails
     *
     * @ORM\OneToMany(targetEntity="MdfSpeakersDetails", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $speakersDetails;

    /**
     * @var MediaMdfVideo
     *
     * @ORM\OneToMany(targetEntity="MediaMdfVideo", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $mediaMdfVideo;

    /**
     * @var MediaMdfAudio
     *
     * @ORM\OneToMany(targetEntity="MediaMdfAudio", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="image")
     */
    protected $mediaMdfAudio;
    
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
        $this->homeSliderTop = new ArrayCollection();
        $this->infoAndContact = new ArrayCollection();
        $this->contentTemplateWidgetImage = new ArrayCollection();
        $this->contentTemplateWidgetVideo = new ArrayCollection();
        $this->homeService = new ArrayCollection();
        $this->programSpeaker = new ArrayCollection();
        $this->serviceGalleryMedia = new ArrayCollection();
        $this->speakersDetails = new ArrayCollection();
        $this->mediaMdfVideo = new ArrayCollection();
        $this->mediaMdfAudio = new ArrayCollection();
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

    /**
     * @param HomeSliderTop $homeSliderTop
     * @return $this
     */
    public function addHomeSliderTop(\FDC\MarcheDuFilmBundle\Entity\HomeSliderTop $homeSliderTop)
    {
        $homeSliderTop->setImage($this);
        $this->homeSliderTop[] = $homeSliderTop;

        return $this;
    }

    /**
     * @param HomeSliderTop $homeSliderTop
     */
    public function removeHomeSliderTop(\FDC\MarcheDuFilmBundle\Entity\HomeSliderTop $homeSliderTop)
    {
        $this->homeSliderTop->removeElement($homeSliderTop);
    }

    /**
     * @return ArrayCollection|HomeSliderTop
     */
    public function getHomeSliderTop()
    {
        return $this->homeSliderTop;
    }

    /**
     * @param MdfConferenceInfoAndContactWidget $infoAndContactWidget
     * @return $this
     */
    public function addInfoAndContact(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContactWidget $infoAndContactWidget)
    {
        $infoAndContactWidget->setImage($this);
        $this->infoAndContact[] = $infoAndContactWidget;

        return $this;
    }

    /**
     * @param MdfConferenceInfoAndContactWidget $infoAndContactWidget
     */
    public function removeInfoAndContact(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContactWidget $infoAndContactWidget)
    {
        $this->infoAndContact->removeElement($infoAndContactWidget);
    }

    /**
     * @return ArrayCollection|MdfConferenceInfoAndContactWidget
     */
    public function getHomeInfoAndContact()
    {
        return $this->infoAndContact;
    }

    /**
     * @param MdfContentTemplateWidgetImage $contentTemplateWidgetImage
     * @return $this
     */
    public function addContentTemplateWidgetImage(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetImage $contentTemplateWidgetImage)
    {
        $contentTemplateWidgetImage->setImage($this);
        $this->contentTemplateWidgetImage[] = $contentTemplateWidgetImage;

        return $this;
    }

    /**
     * @param MdfContentTemplateWidgetImage $contentTemplateWidgetImage
     */
    public function removeContentTemplateWidgetImage(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetImage $contentTemplateWidgetImage)
    {
        $this->contentTemplateWidgetImage->removeElement($contentTemplateWidgetImage);
    }

    /**
     * @return ArrayCollection|MdfContentTemplateWidgetImage
     */
    public function getContentTemplateWidgetImage()
    {
        return $this->contentTemplateWidgetImage;
    }

    /**
     * @param MdfContentTemplateWidgetVideo $contentTemplateWidgetVideo
     * @return $this
     */
    public function addContentTemplateWidgetVideo(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetVideo $contentTemplateWidgetVideo)
    {
        $contentTemplateWidgetVideo->setImage($this);
        $this->contentTemplateWidgetVideo[] = $contentTemplateWidgetVideo;

        return $this;
    }

    /**
     * @param MdfContentTemplateWidgetVideo $contentTemplateWidgetVideo
     */
    public function removeContentTemplateWidgetVideo(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetVideo $contentTemplateWidgetVideo)
    {
        $this->contentTemplateWidgetVideo->removeElement($contentTemplateWidgetVideo);
    }

    /**
     * @return ArrayCollection|MdfContentTemplateWidgetVideo
     */
    public function getContentTemplateWidgetVideo()
    {
        return $this->contentTemplateWidgetVideo;
    }

    /**
     * @param MdfHomeService $homeService
     * @return $this
     */
    public function addHomeService(\FDC\MarcheDuFilmBundle\Entity\MdfHomeService $homeService)
    {
        $homeService->setImage($this);
        $this->homeService[] = $homeService;

        return $this;
    }

    /**
     * @param MdfHomeService $homeService
     */
    public function removeHomeService(\FDC\MarcheDuFilmBundle\Entity\MdfHomeService $homeService)
    {
        $this->homeService->removeElement($homeService);
    }

    /**
     * @return ArrayCollection|MdfHomeService
     */
    public function getHomeService()
    {
        return $this->homeService;
    }

    /**
     * @param MdfProgramSpeaker $mdfProgramSpeaker
     * @return $this
     */
    public function addProgramSpeaker(\FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeaker $mdfProgramSpeaker)
    {
        $mdfProgramSpeaker->setImage($this);
        $this->programSpeaker[] = $mdfProgramSpeaker;

        return $this;
    }

    /**
     * @param MdfProgramSpeaker $mdfProgramSpeaker
     */
    public function removeProgramSpeaker(\FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeaker $mdfProgramSpeaker)
    {
        $this->programSpeaker->removeElement($mdfProgramSpeaker);
    }

    /**
     * @return ArrayCollection|MdfProgramSpeaker
     */
    public function getProgramSpeaker()
    {
        return $this->programSpeaker;
    }

    /**
     * @param MdfServiceGalleryMedia $mdfServiceGalleryMedia
     * @return $this
     */
    public function addServiceGalleryMedia(\FDC\MarcheDuFilmBundle\Entity\MdfServiceGalleryMedia $mdfServiceGalleryMedia)
    {
        $mdfServiceGalleryMedia->setMedia($this);
        $this->serviceGalleryMedia[] = $mdfServiceGalleryMedia;

        return $this;
    }

    /**
     * @param MdfServiceGalleryMedia $mdfServiceGalleryMedia
     */
    public function removeServiceGalleryMedia(\FDC\MarcheDuFilmBundle\Entity\MdfServiceGalleryMedia $mdfServiceGalleryMedia)
    {
        $this->serviceGalleryMedia->removeElement($mdfServiceGalleryMedia);
    }

    /**
     * @return ArrayCollection|MdfServiceGalleryMedia
     */
    public function getServiceGalleryMedia()
    {
        return $this->serviceGalleryMedia;
    }

    /**
     * @param MdfSpeakersDetails $speakersDetails
     * @return $this
     */
    public function addSpeakersDetails(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetails $speakersDetails)
    {
        $speakersDetails->setImage($this);
        $this->speakersDetails[] = $speakersDetails;

        return $this;
    }

    /**
     * @param MdfSpeakersDetails $speakersDetails
     */
    public function removeSpeakersDetails(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetails $speakersDetails)
    {
        $this->speakersDetails->removeElement($speakersDetails);
    }

    /**
     * @return ArrayCollection|MdfSpeakersDetails
     */
    public function getSpeakersDetails()
    {
        return $this->speakersDetails;
    }

    /**
     * @param MediaMdfVideo $mediaMdfVideo
     * @return $this
     */
    public function addMediaMdfVideo(\FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo $mediaMdfVideo)
    {
        $mediaMdfVideo->setImage($this);
        $this->mediaMdfVideo[] = $mediaMdfVideo;

        return $this;
    }

    /**
     * @param MediaMdfVideo $mediaMdfVideo
     */
    public function removeMediaMdfVideo(\FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo $mediaMdfVideo)
    {
        $this->mediaMdfVideo->removeElement($mediaMdfVideo);
    }

    /**
     * @return ArrayCollection|MediaMdfVideo
     */
    public function getMediaMdfVideo()
    {
        return $this->mediaMdfVideo;
    }

    /**
     * @param MediaMdfAudio $mediaMdfAudio
     * @return $this
     */
    public function addMediaMdfAudio(\FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio $mediaMdfAudio)
    {
        $mediaMdfAudio->setImage($this);
        $this->mediaMdfAudio[] = $mediaMdfAudio;

        return $this;
    }

    /**
     * @param MediaMdfAudio $mediaMdfAudio
     */
    public function removeMediaMdfAudio(\FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio $mediaMdfAudio)
    {
        $this->mediaMdfAudio->removeElement($mediaMdfAudio);
    }

    /**
     * @return ArrayCollection|MediaMdfAudio
     */
    public function getMediaMdfAudio()
    {
        return $this->mediaMdfAudio;
    }
}
