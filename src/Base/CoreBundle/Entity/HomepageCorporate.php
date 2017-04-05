<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;

use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * HomepageCorporate
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageCorporate implements TranslateMainInterface
{
    use SeoMain;
    use Translatable;
    use Time;
    use TranslateMain;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $festivalStartsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $festivalEndsAt;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedPopin;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $displayedSocialWall;

    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedBanner;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedGallery;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    protected $socialGraphHashtagTwitter;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    protected $socialWallHashtags;

    /**
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     */
    protected $videoMain;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedVideo;

    /**
     * @var HomepageCorporateSlide
     *
     * @ORM\OneToMany(targetEntity="HomepageCorporateSlide", mappedBy="homepage", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $homepageSlide;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedSlider;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedFeaturedContents;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedFeaturedContentsFilters;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushEditionImage;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedPushEdition;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedCannesReleases;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushMainImage1;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushMainImage2;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedPushsMain;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushSecondaryImage1;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushSecondaryImage2;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushSecondaryImage3;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     */
    protected $VideoUne;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    protected $displayedPushsSecondary;

    /**
     * ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->homepageSlide = new ArrayCollection();
        $this->displayedBanner = false;
        $this->displayedCannesReleases = false;
        $this->displayedPopin = false;
        $this->displayedSlider = false;
        $this->displayedFeaturedContents = false;
        $this->displayedFeaturedContentsFilters = false;
        $this->displayedPushsMain = false;
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        return $string;
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
     * Set festivalStartsAt
     *
     * @param \DateTime $festivalStartsAt
     * @return HomepageCorporate
     */
    public function setFestivalStartsAt($festivalStartsAt)
    {
        $this->festivalStartsAt = $festivalStartsAt;

        return $this;
    }

    /**
     * Get festivalStartsAt
     *
     * @return \DateTime
     */
    public function getFestivalStartsAt()
    {
        return $this->festivalStartsAt;
    }

    /**
     * Set festivalEndsAt
     *
     * @param \DateTime $festivalEndsAt
     * @return HomepageCorporate
     */
    public function setFestivalEndsAt($festivalEndsAt)
    {
        $this->festivalEndsAt = $festivalEndsAt;

        return $this;
    }

    /**
     * Get festivalEndsAt
     *
     * @return \DateTime
     */
    public function getFestivalEndsAt()
    {
        return $this->festivalEndsAt;
    }

    /**
     * Set popinSubtitle1
     *
     * @param string $popinSubtitle1
     * @return HomepageCorporate
     */
    public function setPopinSubtitle1($popinSubtitle1)
    {
        $this->popinSubtitle1 = $popinSubtitle1;

        return $this;
    }

    /**
     * Get popinSubtitle1
     *
     * @return string
     */
    public function getPopinSubtitle1()
    {
        return $this->popinSubtitle1;
    }

    /**
     * Set popinSubtitle2
     *
     * @param string $popinSubtitle2
     * @return HomepageCorporate
     */
    public function setPopinSubtitle2($popinSubtitle2)
    {
        $this->popinSubtitle2 = $popinSubtitle2;

        return $this;
    }

    /**
     * Get popinSubtitle2
     *
     * @return string
     */
    public function getPopinSubtitle2()
    {
        return $this->popinSubtitle2;
    }

    /**
     * Set bannerText
     *
     * @param string $bannerText
     * @return HomepageCorporate
     */
    public function setBannerText($bannerText)
    {
        $this->bannerText = $bannerText;

        return $this;
    }

    /**
     * Get bannerText
     *
     * @return string
     */
    public function getBannerText()
    {
        return $this->bannerText;
    }

    /**
     * Set displayedPopin
     *
     * @param boolean $displayedPopin
     * @return HomepageCorporate
     */
    public function setDisplayedPopin($displayedPopin)
    {
        $this->displayedPopin = $displayedPopin;

        return $this;
    }

    /**
     * Get displayedPopin
     *
     * @return boolean
     */
    public function getDisplayedPopin()
    {
        return $this->displayedPopin;
    }

    /**
     * Set displayedBanner
     *
     * @param boolean $displayedBanner
     * @return HomepageCorporate
     */
    public function setDisplayedBanner($displayedBanner)
    {
        $this->displayedBanner = $displayedBanner;

        return $this;
    }

    /**
     * Get displayedBanner
     *
     * @return boolean
     */
    public function getDisplayedBanner()
    {
        return $this->displayedBanner;
    }

    /**
     * Set displayedSlider
     *
     * @param boolean $displayedSlider
     * @return HomepageCorporate
     */
    public function setDisplayedSlider($displayedSlider)
    {
        $this->displayedSlider = $displayedSlider;

        return $this;
    }

    /**
     * Get displayedSlider
     *
     * @return boolean
     */
    public function getDisplayedSlider()
    {
        return $this->displayedSlider;
    }

    /**
     * Set displayedSliderFilters
     *
     * @param boolean $displayedSliderFilters
     * @return HomepageCorporate
     */
    public function setDisplayedSliderFilters($displayedSliderFilters)
    {
        $this->displayedSliderFilters = $displayedSliderFilters;

        return $this;
    }

    /**
     * Get displayedSliderFilters
     *
     * @return boolean
     */
    public function getDisplayedSliderFilters()
    {
        return $this->displayedSliderFilters;
    }

    /**
     * Set displayedCannesReleases
     *
     * @param boolean $displayedCannesReleases
     * @return HomepageCorporate
     */
    public function setDisplayedCannesReleases($displayedCannesReleases)
    {
        $this->displayedCannesReleases = $displayedCannesReleases;

        return $this;
    }

    /**
     * Get displayedCannesReleases
     *
     * @return boolean
     */
    public function getDisplayedCannesReleases()
    {
        return $this->displayedCannesReleases;
    }

    /**
     * Set videoMain
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $videoMain
     * @return HomepageCorporate
     */
    public function setVideoMain(\Base\CoreBundle\Entity\MediaVideo $videoMain = null)
    {
        $this->videoMain = $videoMain;

        return $this;
    }

    /**
     * Get videoMain
     *
     * @return \Base\CoreBundle\Entity\MediaVideo
     */
    public function getVideoMain()
    {
        return $this->videoMain;
    }

    /**
     * Set pushEditionImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushEditionImage
     * @return HomepageCorporate
     */
    public function setPushEditionImage(\Base\CoreBundle\Entity\MediaImageSimple $pushEditionImage = null)
    {
        $this->pushEditionImage = $pushEditionImage;

        return $this;
    }

    /**
     * Get pushEditionImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushEditionImage()
    {
        return $this->pushEditionImage;
    }

    /**
     * Set pushMainImage1
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushMainImage1
     * @return HomepageCorporate
     */
    public function setPushMainImage1(\Base\CoreBundle\Entity\MediaImageSimple $pushMainImage1 = null)
    {
        $this->pushMainImage1 = $pushMainImage1;

        return $this;
    }

    /**
     * Get pushMainImage1
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushMainImage1()
    {
        return $this->pushMainImage1;
    }

    /**
     * Set pushMainImage2
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushMainImage2
     * @return HomepageCorporate
     */
    public function setPushMainImage2(\Base\CoreBundle\Entity\MediaImageSimple $pushMainImage2 = null)
    {
        $this->pushMainImage2 = $pushMainImage2;

        return $this;
    }

    /**
     * Get pushMainImage2
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushMainImage2()
    {
        return $this->pushMainImage2;
    }

    /**
     * Set pushSecondaryImage1
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushSecondaryImage1
     * @return HomepageCorporate
     */
    public function setPushSecondaryImage1(\Base\CoreBundle\Entity\MediaImageSimple $pushSecondaryImage1 = null)
    {
        $this->pushSecondaryImage1 = $pushSecondaryImage1;

        return $this;
    }

    /**
     * Get pushSecondaryImage1
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushSecondaryImage1()
    {
        return $this->pushSecondaryImage1;
    }

    /**
     * Set pushSecondaryImage2
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushSecondaryImage2
     * @return HomepageCorporate
     */
    public function setPushSecondaryImage2(\Base\CoreBundle\Entity\MediaImageSimple $pushSecondaryImage2 = null)
    {
        $this->pushSecondaryImage2 = $pushSecondaryImage2;

        return $this;
    }

    /**
     * Get pushSecondaryImage2
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushSecondaryImage2()
    {
        return $this->pushSecondaryImage2;
    }

    /**
     * Set pushSecondaryImage3
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushSecondaryImage3
     * @return HomepageCorporate
     */
    public function setPushSecondaryImage3(\Base\CoreBundle\Entity\MediaImageSimple $pushSecondaryImage3 = null)
    {
        $this->pushSecondaryImage3 = $pushSecondaryImage3;

        return $this;
    }

    /**
     * Get pushSecondaryImage3
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushSecondaryImage3()
    {
        return $this->pushSecondaryImage3;
    }

    /**
     * Set displayedVideo
     *
     * @param boolean $displayedVideo
     * @return HomepageCorporate
     */
    public function setDisplayedVideo($displayedVideo)
    {
        $this->displayedVideo = $displayedVideo;

        return $this;
    }

    /**
     * Get displayedVideo
     *
     * @return boolean
     */
    public function getDisplayedVideo()
    {
        return $this->displayedVideo;
    }

    /**
     * Set displayedPushEdition
     *
     * @param boolean $displayedPushEdition
     * @return HomepageCorporate
     */
    public function setDisplayedPushEdition($displayedPushEdition)
    {
        $this->displayedPushEdition = $displayedPushEdition;

        return $this;
    }

    /**
     * Get displayedPushEdition
     *
     * @return boolean
     */
    public function getDisplayedPushEdition()
    {
        return $this->displayedPushEdition;
    }

    /**
     * Set displayedPushsMain
     *
     * @param boolean $displayedPushsMain
     * @return HomepageCorporate
     */
    public function setDisplayedPushsMain($displayedPushsMain)
    {
        $this->displayedPushsMain = $displayedPushsMain;

        return $this;
    }

    /**
     * Get displayedPushsMain
     *
     * @return boolean
     */
    public function getDisplayedPushsMain()
    {
        return $this->displayedPushsMain;
    }

    /**
     * Set displayedPushsSecondary
     *
     * @param boolean $displayedPushsSecondary
     * @return HomepageCorporate
     */
    public function setDisplayedPushsSecondary($displayedPushsSecondary)
    {
        $this->displayedPushsSecondary = $displayedPushsSecondary;

        return $this;
    }

    /**
     * Get displayedPushsSecondary
     *
     * @return boolean
     */
    public function getDisplayedPushsSecondary()
    {
        return $this->displayedPushsSecondary;
    }

    /**
     * Add homepageSlide
     *
     * @param \Base\CoreBundle\Entity\HomepageCorporateSlide $homepageSlide
     * @return HomepageCorporate
     */
    public function addHomepageSlide(\Base\CoreBundle\Entity\HomepageCorporateSlide $homepageSlide)
    {
        $homepageSlide->setHomepage($this);
        $this->homepageSlide[] = $homepageSlide;

        return $this;
    }

    /**
     * Remove homepageSlide
     *
     * @param \Base\CoreBundle\Entity\HomepageCorporateSlide $homepageSlide
     */
    public function removeHomepageSlide(\Base\CoreBundle\Entity\HomepageCorporateSlide $homepageSlide)
    {
        $this->homepageSlide->removeElement($homepageSlide);
    }

    /**
     * Get homepageSlide
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomepageSlide()
    {
        return $this->homepageSlide;
    }


    /**
     * Set displayedFeaturedContents
     *
     * @param boolean $displayedFeaturedContents
     * @return HomepageCorporate
     */
    public function setDisplayedFeaturedContents($displayedFeaturedContents)
    {
        $this->displayedFeaturedContents = $displayedFeaturedContents;

        return $this;
    }

    /**
     * Get displayedFeaturedContents
     *
     * @return boolean 
     */
    public function getDisplayedFeaturedContents()
    {
        return $this->displayedFeaturedContents;
    }

    /**
     * Set displayedFeaturedContentsFilters
     *
     * @param boolean $displayedFeaturedContentsFilters
     * @return HomepageCorporate
     */
    public function setDisplayedFeaturedContentsFilters($displayedFeaturedContentsFilters)
    {
        $this->displayedFeaturedContentsFilters = $displayedFeaturedContentsFilters;

        return $this;
    }

    /**
     * Get displayedFeaturedContentsFilters
     *
     * @return boolean 
     */
    public function getDisplayedFeaturedContentsFilters()
    {
        return $this->displayedFeaturedContentsFilters;
    }

    /**
     * Set displayedGallery
     *
     * @param boolean $displayedGallery
     * @return HomepageCorporate
     */
    public function setDisplayedGallery($displayedGallery)
    {
        $this->displayedGallery = $displayedGallery;

        return $this;
    }

    /**
     * Get displayedGallery
     *
     * @return boolean 
     */
    public function getDisplayedGallery()
    {
        return $this->displayedGallery;
    }

    /**
     * Set VideoUne
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $videoUne
     * @return HomepageCorporate
     */
    public function setVideoUne(\Base\CoreBundle\Entity\MediaVideo $videoUne = null)
    {
        $this->VideoUne = $videoUne;

        return $this;
    }

    /**
     * Get VideoUne
     *
     * @return \Base\CoreBundle\Entity\MediaVideo 
     */
    public function getVideoUne()
    {
        return $this->VideoUne;
    }

    /**
     * Set socialGraphHashtagTwitter
     *
     * @param string $socialGraphHashtagTwitter
     * @return HomepageCorporate
     */
    public function setSocialGraphHashtagTwitter($socialGraphHashtagTwitter)
    {
        $this->socialGraphHashtagTwitter = $socialGraphHashtagTwitter;

        return $this;
    }

    /**
     * Get socialGraphHashtagTwitter
     *
     * @return string 
     */
    public function getSocialGraphHashtagTwitter()
    {
        return $this->socialGraphHashtagTwitter;
    }

    /**
     * Set socialWallHashtags
     *
     * @param string $socialWallHashtags
     * @return HomepageCorporate
     */
    public function setSocialWallHashtags($socialWallHashtags)
    {
        $this->socialWallHashtags = $socialWallHashtags;

        return $this;
    }

    /**
     * Get socialWallHashtags
     *
     * @return string 
     */
    public function getSocialWallHashtags()
    {
        return $this->socialWallHashtags;
    }

    /**
     * Set displayedSocialWall
     *
     * @param boolean $displayedSocialWall
     * @return HomepageCorporate
     */
    public function setDisplayedSocialWall($displayedSocialWall)
    {
        $this->displayedSocialWall = $displayedSocialWall;

        return $this;
    }

    /**
     * Get displayedSocialWall
     *
     * @return boolean 
     */
    public function getDisplayedSocialWall()
    {
        return $this->displayedSocialWall;
    }
}
