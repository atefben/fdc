<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * Homepage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Homepage
{
    use Translatable;
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsMainImage1;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsMainImage2;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsMainImage3;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsSecondaryImage1;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsSecondaryImage2;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsSecondaryImage3;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsSecondaryImage4;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsSecondaryImage5;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsSecondaryImage6;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsSecondaryImage7;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $pushsSecondaryImage8;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $prefooterImage1;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $prefooterImage2;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $prefooterImage3;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $prefooterImage4;

    /**
     * @var HomepageSlide
     *
     * @ORM\OneToMany(targetEntity="HomepageSlide", mappedBy="homepage")
     */
    private $homepageSlide;

    /**
     * @var WebTv
     *
     * @ORM\OneToMany(targetEntity="MediaVideo", mappedBy="homepage")
     */
    private $topVideos;

    /**
     * @var WebTv
     *
     * @ORM\OneToMany(targetEntity="WebTv", mappedBy="homepage")
     */
    private $topWebTvs;

    /**
     * @var topVideosAssociated
     * @ORM\OneToMany(targetEntity="HomepageTopVideosAssociated", mappedBy="homepage", cascade={"persist"})
     */
    private $topVideosAssociated;

    /**
     * @var topWebTvsAssociated
     * @ORM\OneToMany(targetEntity="HomepageTopWebTvsAssociated", mappedBy="homepage", cascade={"persist"})
     */
    private $topWebTvsAssociated;

    /**
     * @var filmsAssociated
     * @ORM\OneToMany(targetEntity="HomepageFilmsAssociated", mappedBy="homepage", cascade={"persist"})
     */
    private $filmsAssociated;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     **/
    private $topNewsType;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $socialGraphHashtagTwitter;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $socialWallHashtags;
    
    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    private $displayedSlider;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     **/
    private $displayedTopNews;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $displayedSocialWall;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $displayedTopVideos;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $displayedTopWebTv;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $displayedPushsMain;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $displayedPushsSecondary;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $displayedPrefooters;


    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->sliderHomepage = new ArrayCollection();
        $this->topVideos = new ArrayCollection();
        $this->topWebTvs = new ArrayCollection();
        $this->hashtagTwitter = '';
        $this->tagInstagram = '';
        $this->displayedPrefooters = false;
        $this->displayedPushsMain = false;
        $this->displayedPushsSecondary = false;
        $this->displayedSlider = false;
        $this->displayedSocialWall = false;
        $this->displayedTopNews = false;
        $this->displayedTopVideos = false;
        $this->displayedTopWebTv = false;
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
     * Set topNewsType
     *
     * @param integer $topNewsType
     * @return Homepage
     */
    public function setTopNewsType($topNewsType)
    {
        $this->topNewsType = $topNewsType;

        return $this;
    }

    /**
     * Get topNewsType
     *
     * @return integer
     */
    public function getTopNewsType()
    {
        return $this->topNewsType;
    }

    /**
     * Get displayedTopNews
     *
     * @return boolean
     */
    public function getDisplayedTopNews()
    {
        return $this->displayedTopNews;
    }

    /**
     * Set displayedSocialWall
     *
     * @param boolean $displayedSocialWall
     * @return Homepage
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

    /**
     * Set displayedTopVideos
     *
     * @param boolean $displayedTopVideos
     * @return Homepage
     */
    public function setDisplayedTopVideos($displayedTopVideos)
    {
        $this->displayedTopVideos = $displayedTopVideos;

        return $this;
    }

    /**
     * Get displayedTopVideos
     *
     * @return boolean
     */
    public function getDisplayedTopVideos()
    {
        return $this->displayedTopVideos;
    }

    /**
     * Set displayedTopWebTv
     *
     * @param boolean $displayedTopWebTv
     * @return Homepage
     */
    public function setDisplayedTopWebTv($displayedTopWebTv)
    {
        $this->displayedTopWebTv = $displayedTopWebTv;

        return $this;
    }

    /**
     * Get displayedTopWebTv
     *
     * @return boolean
     */
    public function getDisplayedTopWebTv()
    {
        return $this->displayedTopWebTv;
    }

    /**
     * Get hashtagTwitter
     *
     * @return string
     */
    public function getHashtagTwitter()
    {
        return $this->hashtagTwitter;
    }

    /**
     * Set hashtagTwitter
     *
     * @param string $hashtagTwitter
     * @return Homepage
     */
    public function setHashtagTwitter($hashtagTwitter)
    {
        $this->hashtagTwitter = $hashtagTwitter;

        return $this;
    }

    /**
     * Get tagInstagram
     *
     * @return string
     */
    public function getTagInstagram()
    {
        return $this->tagInstagram;
    }

    /**
     * Set tagInstagram
     *
     * @param string $tagInstagram
     * @return Homepage
     */
    public function setTagInstagram($tagInstagram)
    {
        $this->tagInstagram = $tagInstagram;

        return $this;
    }


    /**
     * Set displayedPushsMain
     *
     * @param boolean $displayedPushsMain
     * @return Homepage
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
     * @return Homepage
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
     * Set displayedPrefooters
     *
     * @param boolean $displayedPrefooters
     * @return Homepage
     */
    public function setDisplayedPrefooters($displayedPrefooters)
    {
        $this->displayedPrefooters = $displayedPrefooters;

        return $this;
    }

    /**
     * Get displayedPrefooters
     *
     * @return boolean
     */
    public function getDisplayedPrefooters()
    {
        return $this->displayedPrefooters;
    }

    /**
     * Add topVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $topVideos
     * @return Homepage
     */
    public function addTopVideo(\Base\CoreBundle\Entity\MediaVideo $topVideos)
    {
        $topVideos->setHomepage($this);
        $this->topVideos[] = $topVideos;

        return $this;
    }

    /**
     * Remove topVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $topVideos
     */
    public function removeTopVideo(\Base\CoreBundle\Entity\MediaVideo $topVideos)
    {
        $this->topVideos->removeElement($topVideos);
    }

    /**
     * Get topVideos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTopVideos()
    {
        return $this->topVideos;
    }

    /**
     * Add topWebTvs
     *
     * @param \Base\CoreBundle\Entity\WebTv $topWebTvs
     * @return Homepage
     */
    public function addTopWebTv(\Base\CoreBundle\Entity\WebTv $topWebTvs)
    {
        $topWebTvs->setHomepage($this);
        $this->topWebTvs[] = $topWebTvs;

        return $this;
    }

    /**
     * Remove topWebTvs
     *
     * @param \Base\CoreBundle\Entity\WebTv $topWebTvs
     */
    public function removeTopWebTv(\Base\CoreBundle\Entity\WebTv $topWebTvs)
    {
        $this->topWebTvs->removeElement($topWebTvs);
    }

    /**
     * Get topWebTvs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTopWebTvs()
    {
        return $this->topWebTvs;
    }

    /**
     * Set socialGraphHashtagTwitter
     *
     * @param string $socialGraphHashtagTwitter
     * @return Homepage
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
     * @return Homepage
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
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return Homepage
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Add homepageSlide
     *
     * @param \Base\CoreBundle\Entity\HomepageSlide $homepageSlide
     * @return Homepage
     */
    public function addHomepageSlide(\Base\CoreBundle\Entity\HomepageSlide $homepageSlide)
    {
        $this->homepageSlide[] = $homepageSlide;

        return $this;
    }

    /**
     * Remove homepageSlide
     *
     * @param \Base\CoreBundle\Entity\HomepageSlide $homepageSlide
     */
    public function removeHomepageSlide(\Base\CoreBundle\Entity\HomepageSlide $homepageSlide)
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
     * Set displayedSlider
     *
     * @param boolean $displayedSlider
     * @return Homepage
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
     * Set displayedTopNews
     *
     * @param boolean $displayedTopNews
     * @return Homepage
     */
    public function setDisplayedTopNews($displayedTopNews)
    {
        $this->displayedTopNews = $displayedTopNews;

        return $this;
    }

    /**
     * Set pushsMainImage1
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsMainImage1
     * @return Homepage
     */
    public function setPushsMainImage1(\Base\CoreBundle\Entity\MediaImageSimple $pushsMainImage1 = null)
    {
        $this->pushsMainImage1 = $pushsMainImage1;

        return $this;
    }

    /**
     * Get pushsMainImage1
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushsMainImage1()
    {
        return $this->pushsMainImage1;
    }

    /**
     * Set pushsMainImage2
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsMainImage2
     * @return Homepage
     */
    public function setPushsMainImage2(\Base\CoreBundle\Entity\MediaImageSimple $pushsMainImage2 = null)
    {
        $this->pushsMainImage2 = $pushsMainImage2;

        return $this;
    }

    /**
     * Get pushsMainImage2
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushsMainImage2()
    {
        return $this->pushsMainImage2;
    }

    /**
     * Set pushsMainImage3
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsMainImage3
     * @return Homepage
     */
    public function setPushsMainImage3(\Base\CoreBundle\Entity\MediaImageSimple $pushsMainImage3 = null)
    {
        $this->pushsMainImage3 = $pushsMainImage3;

        return $this;
    }

    /**
     * Get pushsMainImage3
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushsMainImage3()
    {
        return $this->pushsMainImage3;
    }

    /**
     * Set pushsSecondaryImage1
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage1
     * @return Homepage
     */
    public function setPushsSecondaryImage1(\Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage1 = null)
    {
        $this->pushsSecondaryImage1 = $pushsSecondaryImage1;

        return $this;
    }

    /**
     * Get pushsSecondaryImage1
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushsSecondaryImage1()
    {
        return $this->pushsSecondaryImage1;
    }

    /**
     * Set pushsSecondaryImage2
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage2
     * @return Homepage
     */
    public function setPushsSecondaryImage2(\Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage2 = null)
    {
        $this->pushsSecondaryImage2 = $pushsSecondaryImage2;

        return $this;
    }

    /**
     * Get pushsSecondaryImage2
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushsSecondaryImage2()
    {
        return $this->pushsSecondaryImage2;
    }

    /**
     * Set pushsSecondaryImage3
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage3
     * @return Homepage
     */
    public function setPushsSecondaryImage3(\Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage3 = null)
    {
        $this->pushsSecondaryImage3 = $pushsSecondaryImage3;

        return $this;
    }

    /**
     * Get pushsSecondaryImage3
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushsSecondaryImage3()
    {
        return $this->pushsSecondaryImage3;
    }

    /**
     * Set pushsSecondaryImage4
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage4
     * @return Homepage
     */
    public function setPushsSecondaryImage4(\Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage4 = null)
    {
        $this->pushsSecondaryImage4 = $pushsSecondaryImage4;

        return $this;
    }

    /**
     * Get pushsSecondaryImage4
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushsSecondaryImage4()
    {
        return $this->pushsSecondaryImage4;
    }

    /**
     * Set pushsSecondaryImage5
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage5
     * @return Homepage
     */
    public function setPushsSecondaryImage5(\Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage5 = null)
    {
        $this->pushsSecondaryImage5 = $pushsSecondaryImage5;

        return $this;
    }

    /**
     * Get pushsSecondaryImage5
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushsSecondaryImage5()
    {
        return $this->pushsSecondaryImage5;
    }

    /**
     * Set pushsSecondaryImage6
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage6
     * @return Homepage
     */
    public function setPushsSecondaryImage6(\Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage6 = null)
    {
        $this->pushsSecondaryImage6 = $pushsSecondaryImage6;

        return $this;
    }

    /**
     * Get pushsSecondaryImage6
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushsSecondaryImage6()
    {
        return $this->pushsSecondaryImage6;
    }

    /**
     * Set pushsSecondaryImage7
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage7
     * @return Homepage
     */
    public function setPushsSecondaryImage7(\Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage7 = null)
    {
        $this->pushsSecondaryImage7 = $pushsSecondaryImage7;

        return $this;
    }

    /**
     * Get pushsSecondaryImage7
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushsSecondaryImage7()
    {
        return $this->pushsSecondaryImage7;
    }

    /**
     * Set pushsSecondaryImage8
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage8
     * @return Homepage
     */
    public function setPushsSecondaryImage8(\Base\CoreBundle\Entity\MediaImageSimple $pushsSecondaryImage8 = null)
    {
        $this->pushsSecondaryImage8 = $pushsSecondaryImage8;

        return $this;
    }

    /**
     * Get pushsSecondaryImage8
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushsSecondaryImage8()
    {
        return $this->pushsSecondaryImage8;
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return void
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * Set prefooterImage1
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $prefooterImage1
     * @return Homepage
     */
    public function setPrefooterImage1(\Base\CoreBundle\Entity\MediaImageSimple $prefooterImage1 = null)
    {
        $this->prefooterImage1 = $prefooterImage1;

        return $this;
    }

    /**
     * Get prefooterImage1
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPrefooterImage1()
    {
        return $this->prefooterImage1;
    }

    /**
     * Set prefooterImage2
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $prefooterImage2
     * @return Homepage
     */
    public function setPrefooterImage2(\Base\CoreBundle\Entity\MediaImageSimple $prefooterImage2 = null)
    {
        $this->prefooterImage2 = $prefooterImage2;

        return $this;
    }

    /**
     * Get prefooterImage2
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPrefooterImage2()
    {
        return $this->prefooterImage2;
    }

    /**
     * Set prefooterImage3
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $prefooterImage3
     * @return Homepage
     */
    public function setPrefooterImage3(\Base\CoreBundle\Entity\MediaImageSimple $prefooterImage3 = null)
    {
        $this->prefooterImage3 = $prefooterImage3;

        return $this;
    }

    /**
     * Get prefooterImage3
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPrefooterImage3()
    {
        return $this->prefooterImage3;
    }

    /**
     * Set prefooterImage4
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $prefooterImage4
     * @return Homepage
     */
    public function setPrefooterImage4(\Base\CoreBundle\Entity\MediaImageSimple $prefooterImage4 = null)
    {
        $this->prefooterImage4 = $prefooterImage4;

        return $this;
    }

    /**
     * Get prefooterImage4
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPrefooterImage4()
    {
        return $this->prefooterImage4;
    }

    /**
     * Add topVideosAssociated
     *
     * @param \Base\CoreBundle\Entity\HomepageTopVideosAssociated $topVideosAssociated
     * @return Homepage
     */
    public function addTopVideosAssociated(\Base\CoreBundle\Entity\HomepageTopVideosAssociated $topVideosAssociated)
    {
        $this->topVideosAssociated[] = $topVideosAssociated;

        return $this;
    }

    /**
     * Remove topVideosAssociated
     *
     * @param \Base\CoreBundle\Entity\HomepageTopVideosAssociated $topVideosAssociated
     */
    public function removeTopVideosAssociated(\Base\CoreBundle\Entity\HomepageTopVideosAssociated $topVideosAssociated)
    {
        $this->topVideosAssociated->removeElement($topVideosAssociated);
    }

    /**
     * Get topVideosAssociated
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTopVideosAssociated()
    {
        return $this->topVideosAssociated;
    }

    /**
     * Add topWebTvsAssociated
     *
     * @param \Base\CoreBundle\Entity\HomepageTopWebTvsAssociated $topWebTvsAssociated
     * @return Homepage
     */
    public function addTopWebTvsAssociated(\Base\CoreBundle\Entity\HomepageTopWebTvsAssociated $topWebTvsAssociated)
    {
        $this->topWebTvsAssociated[] = $topWebTvsAssociated;

        return $this;
    }

    /**
     * Remove topWebTvsAssociated
     *
     * @param \Base\CoreBundle\Entity\HomepageTopWebTvsAssociated $topWebTvsAssociated
     */
    public function removeTopWebTvsAssociated(\Base\CoreBundle\Entity\HomepageTopWebTvsAssociated $topWebTvsAssociated)
    {
        $this->topWebTvsAssociated->removeElement($topWebTvsAssociated);
    }

    /**
     * Get topWebTvsAssociated
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTopWebTvsAssociated()
    {
        return $this->topWebTvsAssociated;
    }

    /**
     * Add filmsAssociated
     *
     * @param \Base\CoreBundle\Entity\HomepageFilmsAssociated $filmsAssociated
     * @return Homepage
     */
    public function addFilmsAssociated(\Base\CoreBundle\Entity\HomepageFilmsAssociated $filmsAssociated)
    {
        $this->filmsAssociated[] = $filmsAssociated;

        return $this;
    }

    /**
     * Remove filmsAssociated
     *
     * @param \Base\CoreBundle\Entity\HomepageFilmsAssociated $filmsAssociated
     */
    public function removeFilmsAssociated(\Base\CoreBundle\Entity\HomepageFilmsAssociated $filmsAssociated)
    {
        $this->filmsAssociated->removeElement($filmsAssociated);
    }

    /**
     * Get filmsAssociated
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmsAssociated()
    {
        return $this->filmsAssociated;
    }
}
