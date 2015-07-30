<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAtelier
 *
 * @ORM\Table(indexes={@ORM\Index(name="festival_year_title_vo", columns={"festival_year", "title_vo"}),@ORM\Index(name="internet", columns={"internet"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelier
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned" = true})
     */
    private $festivalYear;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $courtlong;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=2, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $premierFilm;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $premiereMondiale;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $productionYear;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmCategory", inversedBy="filmAteliers")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $section;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVf2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVf3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVa;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVa2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVa3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialog1Vf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialogue2Vf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialogue3Vf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialog1Va;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialog2Va;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialog3Va;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $previousEvent;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $exploitationCountry;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internetDiffusion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cinandoUrl;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $productionAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $distributionAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $pressFrAdress;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $addressPressInternatId;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $eventAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $directorAddress;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $subtitleLanguage;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $restaurantOwner;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $restorationType;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $noDialog;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $color;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $gala;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $transitaireDepart;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $transitaireArrivee;
    
     /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $productionInfos;

    /**
     * @ORM\OneToMany(targetEntity="FilmAtelierMinorProduction", mappedBy="film")
     */
    private $minorProductions;

    /**
     * @var FilmAtelierGeneric
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierGeneric", mappedBy="filmAtelier")
     */
    private $filmAtelierGenerics;

    /**
     * @var FilmPhoto
     *
     * @ORM\OneToMany(targetEntity="FilmPhoto", mappedBy="filmAtelier")
     */
    private $photos;
    
    /**
     * @var FilmCountry
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierCountry", mappedBy="film")
     */
    private $countries;
    
    /**
     * @var FilmCountry
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierLanguage", mappedBy="film")
     */
    private $languages;
    
    /**
     * @var FilmAtelierTranslation
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierTranslation", mappedBy="film")
     */
    private $translations;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->minorProductions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->filmAtelierGenerics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmAtelier
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set festivalYear
     *
     * @param integer $festivalYear
     * @return FilmAtelier
     */
    public function setFestivalYear($festivalYear)
    {
        $this->festivalYear = $festivalYear;

        return $this;
    }

    /**
     * Get festivalYear
     *
     * @return integer 
     */
    public function getFestivalYear()
    {
        return $this->festivalYear;
    }

    /**
     * Set titleVo
     *
     * @param string $titleVo
     * @return FilmAtelier
     */
    public function setTitleVo($titleVo)
    {
        $this->titleVo = $titleVo;

        return $this;
    }

    /**
     * Get titleVo
     *
     * @return string 
     */
    public function getTitleVo()
    {
        return $this->titleVo;
    }

    /**
     * Set titleVf
     *
     * @param string $titleVf
     * @return FilmAtelier
     */
    public function setTitleVf($titleVf)
    {
        $this->titleVf = $titleVf;

        return $this;
    }

    /**
     * Get titleVf
     *
     * @return string 
     */
    public function getTitleVf()
    {
        return $this->titleVf;
    }

    /**
     * Set titleVa
     *
     * @param string $titleVa
     * @return FilmAtelier
     */
    public function setTitleVa($titleVa)
    {
        $this->titleVa = $titleVa;

        return $this;
    }

    /**
     * Get titleVa
     *
     * @return string 
     */
    public function getTitleVa()
    {
        return $this->titleVa;
    }

    /**
     * Set courtlong
     *
     * @param string $courtlong
     * @return FilmAtelier
     */
    public function setCourtlong($courtlong)
    {
        $this->courtlong = $courtlong;

        return $this;
    }

    /**
     * Get courtlong
     *
     * @return string 
     */
    public function getCourtlong()
    {
        return $this->courtlong;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return FilmAtelier
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set premierFilm
     *
     * @param string $premierFilm
     * @return FilmAtelier
     */
    public function setPremierFilm($premierFilm)
    {
        $this->premierFilm = $premierFilm;

        return $this;
    }

    /**
     * Get premierFilm
     *
     * @return string 
     */
    public function getPremierFilm()
    {
        return $this->premierFilm;
    }

    /**
     * Set premiereMondiale
     *
     * @param string $premiereMondiale
     * @return FilmAtelier
     */
    public function setPremiereMondiale($premiereMondiale)
    {
        $this->premiereMondiale = $premiereMondiale;

        return $this;
    }

    /**
     * Get premiereMondiale
     *
     * @return string 
     */
    public function getPremiereMondiale()
    {
        return $this->premiereMondiale;
    }

    /**
     * Set productionYear
     *
     * @param string $productionYear
     * @return FilmAtelier
     */
    public function setProductionYear($productionYear)
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    /**
     * Get productionYear
     *
     * @return string 
     */
    public function getProductionYear()
    {
        return $this->productionYear;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return FilmAtelier
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set section
     *
     * @param string $section
     * @return FilmAtelier
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set synopsisVf
     *
     * @param string $synopsisVf
     * @return FilmAtelier
     */
    public function setSynopsisVf($synopsisVf)
    {
        $this->synopsisVf = $synopsisVf;

        return $this;
    }

    /**
     * Get synopsisVf
     *
     * @return string 
     */
    public function getSynopsisVf()
    {
        return $this->synopsisVf;
    }

    /**
     * Set synopsisVf2
     *
     * @param string $synopsisVf2
     * @return FilmAtelier
     */
    public function setSynopsisVf2($synopsisVf2)
    {
        $this->synopsisVf2 = $synopsisVf2;

        return $this;
    }

    /**
     * Get synopsisVf2
     *
     * @return string 
     */
    public function getSynopsisVf2()
    {
        return $this->synopsisVf2;
    }

    /**
     * Set synopsisVf3
     *
     * @param string $synopsisVf3
     * @return FilmAtelier
     */
    public function setSynopsisVf3($synopsisVf3)
    {
        $this->synopsisVf3 = $synopsisVf3;

        return $this;
    }

    /**
     * Get synopsisVf3
     *
     * @return string 
     */
    public function getSynopsisVf3()
    {
        return $this->synopsisVf3;
    }

    /**
     * Set synopsisVa
     *
     * @param string $synopsisVa
     * @return FilmAtelier
     */
    public function setSynopsisVa($synopsisVa)
    {
        $this->synopsisVa = $synopsisVa;

        return $this;
    }

    /**
     * Get synopsisVa
     *
     * @return string 
     */
    public function getSynopsisVa()
    {
        return $this->synopsisVa;
    }

    /**
     * Set synopsisVa2
     *
     * @param string $synopsisVa2
     * @return FilmAtelier
     */
    public function setSynopsisVa2($synopsisVa2)
    {
        $this->synopsisVa2 = $synopsisVa2;

        return $this;
    }

    /**
     * Get synopsisVa2
     *
     * @return string 
     */
    public function getSynopsisVa2()
    {
        return $this->synopsisVa2;
    }

    /**
     * Set synopsisVa3
     *
     * @param string $synopsisVa3
     * @return FilmAtelier
     */
    public function setSynopsisVa3($synopsisVa3)
    {
        $this->synopsisVa3 = $synopsisVa3;

        return $this;
    }

    /**
     * Get synopsisVa3
     *
     * @return string 
     */
    public function getSynopsisVa3()
    {
        return $this->synopsisVa3;
    }

    /**
     * Set dialog1Vf
     *
     * @param string $dialog1Vf
     * @return FilmAtelier
     */
    public function setDialog1Vf($dialog1Vf)
    {
        $this->dialog1Vf = $dialog1Vf;

        return $this;
    }

    /**
     * Get dialog1Vf
     *
     * @return string 
     */
    public function getDialog1Vf()
    {
        return $this->dialog1Vf;
    }

    /**
     * Set dialogue2Vf
     *
     * @param string $dialogue2Vf
     * @return FilmAtelier
     */
    public function setDialogue2Vf($dialogue2Vf)
    {
        $this->dialogue2Vf = $dialogue2Vf;

        return $this;
    }

    /**
     * Get dialogue2Vf
     *
     * @return string 
     */
    public function getDialogue2Vf()
    {
        return $this->dialogue2Vf;
    }

    /**
     * Set dialogue3Vf
     *
     * @param string $dialogue3Vf
     * @return FilmAtelier
     */
    public function setDialogue3Vf($dialogue3Vf)
    {
        $this->dialogue3Vf = $dialogue3Vf;

        return $this;
    }

    /**
     * Get dialogue3Vf
     *
     * @return string 
     */
    public function getDialogue3Vf()
    {
        return $this->dialogue3Vf;
    }

    /**
     * Set dialog1Va
     *
     * @param string $dialog1Va
     * @return FilmAtelier
     */
    public function setDialog1Va($dialog1Va)
    {
        $this->dialog1Va = $dialog1Va;

        return $this;
    }

    /**
     * Get dialog1Va
     *
     * @return string 
     */
    public function getDialog1Va()
    {
        return $this->dialog1Va;
    }

    /**
     * Set dialog2Va
     *
     * @param string $dialog2Va
     * @return FilmAtelier
     */
    public function setDialog2Va($dialog2Va)
    {
        $this->dialog2Va = $dialog2Va;

        return $this;
    }

    /**
     * Get dialog2Va
     *
     * @return string 
     */
    public function getDialog2Va()
    {
        return $this->dialog2Va;
    }

    /**
     * Set dialog3Va
     *
     * @param string $dialog3Va
     * @return FilmAtelier
     */
    public function setDialog3Va($dialog3Va)
    {
        $this->dialog3Va = $dialog3Va;

        return $this;
    }

    /**
     * Get dialog3Va
     *
     * @return string 
     */
    public function getDialog3Va()
    {
        return $this->dialog3Va;
    }

    /**
     * Set previousEvent
     *
     * @param string $previousEvent
     * @return FilmAtelier
     */
    public function setPreviousEvent($previousEvent)
    {
        $this->previousEvent = $previousEvent;

        return $this;
    }

    /**
     * Get previousEvent
     *
     * @return string 
     */
    public function getPreviousEvent()
    {
        return $this->previousEvent;
    }

    /**
     * Set exploitationCountry
     *
     * @param string $exploitationCountry
     * @return FilmAtelier
     */
    public function setExploitationCountry($exploitationCountry)
    {
        $this->exploitationCountry = $exploitationCountry;

        return $this;
    }

    /**
     * Get exploitationCountry
     *
     * @return string 
     */
    public function getExploitationCountry()
    {
        return $this->exploitationCountry;
    }

    /**
     * Set internetDiffusion
     *
     * @param string $internetDiffusion
     * @return FilmAtelier
     */
    public function setInternetDiffusion($internetDiffusion)
    {
        $this->internetDiffusion = $internetDiffusion;

        return $this;
    }

    /**
     * Get internetDiffusion
     *
     * @return string 
     */
    public function getInternetDiffusion()
    {
        return $this->internetDiffusion;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return FilmAtelier
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get internet
     *
     * @return string 
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set cinandoUrl
     *
     * @param string $cinandoUrl
     * @return FilmAtelier
     */
    public function setCinandoUrl($cinandoUrl)
    {
        $this->cinandoUrl = $cinandoUrl;

        return $this;
    }

    /**
     * Get cinandoUrl
     *
     * @return string 
     */
    public function getCinandoUrl()
    {
        return $this->cinandoUrl;
    }

    /**
     * Set addressPressInternatId
     *
     * @param integer $addressPressInternatId
     * @return FilmAtelier
     */
    public function setAddressPressInternatId($addressPressInternatId)
    {
        $this->addressPressInternatId = $addressPressInternatId;

        return $this;
    }

    /**
     * Get addressPressInternatId
     *
     * @return integer 
     */
    public function getAddressPressInternatId()
    {
        return $this->addressPressInternatId;
    }

    /**
     * Set subtitleLanguage
     *
     * @param string $subtitleLanguage
     * @return FilmAtelier
     */
    public function setSubtitleLanguage($subtitleLanguage)
    {
        $this->subtitleLanguage = $subtitleLanguage;

        return $this;
    }

    /**
     * Get subtitleLanguage
     *
     * @return string 
     */
    public function getSubtitleLanguage()
    {
        return $this->subtitleLanguage;
    }

    /**
     * Set restaurantOwner
     *
     * @param string $restaurantOwner
     * @return FilmAtelier
     */
    public function setRestaurantOwner($restaurantOwner)
    {
        $this->restaurantOwner = $restaurantOwner;

        return $this;
    }

    /**
     * Get restaurantOwner
     *
     * @return string 
     */
    public function getRestaurantOwner()
    {
        return $this->restaurantOwner;
    }

    /**
     * Set restorationType
     *
     * @param string $restorationType
     * @return FilmAtelier
     */
    public function setRestorationType($restorationType)
    {
        $this->restorationType = $restorationType;

        return $this;
    }

    /**
     * Get restorationType
     *
     * @return string 
     */
    public function getRestorationType()
    {
        return $this->restorationType;
    }

    /**
     * Set noDialog
     *
     * @param string $noDialog
     * @return FilmAtelier
     */
    public function setNoDialog($noDialog)
    {
        $this->noDialog = $noDialog;

        return $this;
    }

    /**
     * Get noDialog
     *
     * @return string 
     */
    public function getNoDialog()
    {
        return $this->noDialog;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return FilmAtelier
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilmAtelier
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return FilmAtelier
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set gala
     *
     * @param string $gala
     * @return FilmAtelier
     */
    public function setGala($gala)
    {
        $this->gala = $gala;

        return $this;
    }

    /**
     * Get gala
     *
     * @return string 
     */
    public function getGala()
    {
        return $this->gala;
    }

    /**
     * Set transitaireDepart
     *
     * @param string $transitaireDepart
     * @return FilmAtelier
     */
    public function setTransitaireDepart($transitaireDepart)
    {
        $this->transitaireDepart = $transitaireDepart;

        return $this;
    }

    /**
     * Get transitaireDepart
     *
     * @return string 
     */
    public function getTransitaireDepart()
    {
        return $this->transitaireDepart;
    }

    /**
     * Set transitaireArrivee
     *
     * @param string $transitaireArrivee
     * @return FilmAtelier
     */
    public function setTransitaireArrivee($transitaireArrivee)
    {
        $this->transitaireArrivee = $transitaireArrivee;

        return $this;
    }

    /**
     * Get transitaireArrivee
     *
     * @return string 
     */
    public function getTransitaireArrivee()
    {
        return $this->transitaireArrivee;
    }

    /**
     * Set productionInfos
     *
     * @param string $productionInfos
     * @return FilmAtelier
     */
    public function setProductionInfos($productionInfos)
    {
        $this->productionInfos = $productionInfos;

        return $this;
    }

    /**
     * Get productionInfos
     *
     * @return string 
     */
    public function getProductionInfos()
    {
        return $this->productionInfos;
    }

    /**
     * Set category
     *
     * @param \FDC\CoreBundle\Entity\FilmCategory $category
     * @return FilmAtelier
     */
    public function setCategory(\FDC\CoreBundle\Entity\FilmCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \FDC\CoreBundle\Entity\FilmCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set productionAddress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $productionAddress
     * @return FilmAtelier
     */
    public function setProductionAddress(\FDC\CoreBundle\Entity\FilmAddress $productionAddress = null)
    {
        $this->productionAddress = $productionAddress;

        return $this;
    }

    /**
     * Get productionAddress
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getProductionAddress()
    {
        return $this->productionAddress;
    }

    /**
     * Set distributionAddress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $distributionAddress
     * @return FilmAtelier
     */
    public function setDistributionAddress(\FDC\CoreBundle\Entity\FilmAddress $distributionAddress = null)
    {
        $this->distributionAddress = $distributionAddress;

        return $this;
    }

    /**
     * Get distributionAddress
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getDistributionAddress()
    {
        return $this->distributionAddress;
    }

    /**
     * Set pressFrAdress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $pressFrAdress
     * @return FilmAtelier
     */
    public function setPressFrAdress(\FDC\CoreBundle\Entity\FilmAddress $pressFrAdress = null)
    {
        $this->pressFrAdress = $pressFrAdress;

        return $this;
    }

    /**
     * Get pressFrAdress
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getPressFrAdress()
    {
        return $this->pressFrAdress;
    }

    /**
     * Set eventAddress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $eventAddress
     * @return FilmAtelier
     */
    public function setEventAddress(\FDC\CoreBundle\Entity\FilmAddress $eventAddress = null)
    {
        $this->eventAddress = $eventAddress;

        return $this;
    }

    /**
     * Get eventAddress
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getEventAddress()
    {
        return $this->eventAddress;
    }

    /**
     * Set directorAddress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $directorAddress
     * @return FilmAtelier
     */
    public function setDirectorAddress(\FDC\CoreBundle\Entity\FilmAddress $directorAddress = null)
    {
        $this->directorAddress = $directorAddress;

        return $this;
    }

    /**
     * Get directorAddress
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getDirectorAddress()
    {
        return $this->directorAddress;
    }

    /**
     * Add minorProductions
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierMinorProduction $minorProductions
     * @return FilmAtelier
     */
    public function addMinorProduction(\FDC\CoreBundle\Entity\FilmAtelierMinorProduction $minorProductions)
    {
        $this->minorProductions[] = $minorProductions;

        return $this;
    }

    /**
     * Remove minorProductions
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierMinorProduction $minorProductions
     */
    public function removeMinorProduction(\FDC\CoreBundle\Entity\FilmAtelierMinorProduction $minorProductions)
    {
        $this->minorProductions->removeElement($minorProductions);
    }

    /**
     * Get minorProductions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMinorProductions()
    {
        return $this->minorProductions;
    }

    /**
     * Add filmAtelierGenerics
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics
     * @return FilmAtelier
     */
    public function addFilmAtelierGeneric(\FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics)
    {
        $this->filmAtelierGenerics[] = $filmAtelierGenerics;

        return $this;
    }

    /**
     * Remove filmAtelierGenerics
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics
     */
    public function removeFilmAtelierGeneric(\FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics)
    {
        $this->filmAtelierGenerics->removeElement($filmAtelierGenerics);
    }

    /**
     * Get filmAtelierGenerics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmAtelierGenerics()
    {
        return $this->filmAtelierGenerics;
    }

    /**
     * Add photos
     *
     * @param \FDC\CoreBundle\Entity\FilmPhoto $photos
     * @return FilmAtelier
     */
    public function addPhoto(\FDC\CoreBundle\Entity\FilmPhoto $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \FDC\CoreBundle\Entity\FilmPhoto $photos
     */
    public function removePhoto(\FDC\CoreBundle\Entity\FilmPhoto $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add countries
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierCountry $countries
     * @return FilmAtelier
     */
    public function addCountry(\FDC\CoreBundle\Entity\FilmAtelierCountry $countries)
    {
        $this->countries[] = $countries;

        return $this;
    }

    /**
     * Remove countries
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierCountry $countries
     */
    public function removeCountry(\FDC\CoreBundle\Entity\FilmAtelierCountry $countries)
    {
        $this->countries->removeElement($countries);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * Add languages
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierLanguage $languages
     * @return FilmAtelier
     */
    public function addLanguage(\FDC\CoreBundle\Entity\FilmAtelierLanguage $languages)
    {
        $this->languages[] = $languages;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierLanguage $languages
     */
    public function removeLanguage(\FDC\CoreBundle\Entity\FilmAtelierLanguage $languages)
    {
        $this->languages->removeElement($languages);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Add translations
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierTranslation $translations
     * @return FilmAtelier
     */
    public function addTranslation(\FDC\CoreBundle\Entity\FilmAtelierTranslation $translations)
    {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierTranslation $translations
     */
    public function removeTranslation(\FDC\CoreBundle\Entity\FilmAtelierTranslation $translations)
    {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTranslations()
    {
        return $this->translations;
    }
    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        // Add your code here
    }
}
