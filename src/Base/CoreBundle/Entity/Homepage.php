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
     * @var News
     *
     * @ORM\OneToMany(targetEntity="News", mappedBy="homepage")
     */
    private $sliderNews;

    /**
     * @var Info
     *
     * @ORM\OneToMany(targetEntity="Info", mappedBy="homepage")
     */
    private $sliderInfos;


    /**
     * @var Info
     *
     * @ORM\OneToMany(targetEntity="Statement", mappedBy="homepage")
     */
    private $sliderStatements;

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
        $this->sliderNews = new ArrayCollection();
        $this->topVideos = new ArrayCollection();
        $this->topWebTvs = new ArrayCollection();
        $this->displayedPrefooters = false;
        $this->displayedPushsMain = false;
        $this->displayedPushsSecondary = false;
        $this->displayedSlider = false;
        $this->displayedSocialWall = false;
        $this->displayedTopNews = false;
        $this->displayedTopVideos = false;
        $this->displayedTopWebTv = false;
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
     * Add sliderNews
     *
     * @param \Base\CoreBundle\Entity\News $sliderNews
     * @return Homepage
     */
    public function addSliderNews(\Base\CoreBundle\Entity\News $sliderNews)
    {
        $sliderNews->setHomepage($this);
        $this->sliderNews[] = $sliderNews;

        return $this;
    }

    /**
     * Remove sliderNews
     *
     * @param \Base\CoreBundle\Entity\News $sliderNews
     */
    public function removeSliderNews(\Base\CoreBundle\Entity\News $sliderNews)
    {
        $this->sliderNews->removeElement($sliderNews);
    }

    /**
     * Get sliderNews
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSliderNews()
    {
        return $this->sliderNews;
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
     * Add sliderInfos
     *
     * @param \Base\CoreBundle\Entity\Info $sliderInfos
     * @return Homepage
     */
    public function addSliderInfo(\Base\CoreBundle\Entity\Info $sliderInfos)
    {
        $sliderInfos->setHomepage($this);
        $this->sliderInfos[] = $sliderInfos;

        return $this;
    }

    /**
     * Remove sliderInfos
     *
     * @param \Base\CoreBundle\Entity\Info $sliderInfos
     */
    public function removeSliderInfo(\Base\CoreBundle\Entity\Info $sliderInfos)
    {
        $this->sliderInfos->removeElement($sliderInfos);
    }

    /**
     * Get sliderInfos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSliderInfos()
    {
        return $this->sliderInfos;
    }

    /**
     * Add sliderStatements
     *
     * @param \Base\CoreBundle\Entity\Statement $sliderStatements
     * @return Homepage
     */
    public function addSliderStatement(\Base\CoreBundle\Entity\Statement $sliderStatements)
    {
        $sliderStatements->setHomepage($this);
        $this->sliderStatements[] = $sliderStatements;

        return $this;
    }

    /**
     * Remove sliderStatements
     *
     * @param \Base\CoreBundle\Entity\Statement $sliderStatements
     */
    public function removeSliderStatement(\Base\CoreBundle\Entity\Statement $sliderStatements)
    {
        $this->sliderStatements->removeElement($sliderStatements);
    }

    /**
     * Get sliderStatements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSliderStatements()
    {
        return $this->sliderStatements;
    }
}
