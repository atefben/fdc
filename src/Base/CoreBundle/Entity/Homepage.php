<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

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
     * @var HomepageSlide
     *
     * @ORM\OneToMany(targetEntity="HomepageSlide", mappedBy="homepage", cascade={"persist"})
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
}
