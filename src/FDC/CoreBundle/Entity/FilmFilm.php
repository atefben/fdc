<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmFilm
 *
 * @ORM\Table(indexes={@ORM\Index(name="production_address_id", columns={"production_address_id"}), @ORM\Index(name="distribution_address_id", columns={"distribution_address_id"}), @ORM\Index(name="press_address_id", columns={"press_address_id"}), @ORM\Index(name="press_internat_address_id", columns={"press_internat_address_id"}), @ORM\Index(name="event_address_id", columns={"event_address_id"}), @ORM\Index(name="internet", columns={"internet"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="festival_year", columns={"festival_year"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmFilm
{
    use Time;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, length=36)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVO;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVF;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVA;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30)
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
    private $filmFirst;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $worldFirst;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $productionYear;

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
    private $synopsisVa;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialogueVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialogueVa;

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
    private $exploitationCountries;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internetDisplayed;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $restaurantOwner;

    /**
     * @var string
     *
     * @ORM\Column(length=40, nullable=true)
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
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $gala;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subSelectionVF;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subSelectionVA;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="subtitleLanguageFilms")
     */
    private $subtitleLanguage;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="productionFilms")
     */
    private $productionAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="distributionFilms")
     */
    private $distributionAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="pressFilms")
     */
    private $pressAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="pressInternatFilms")
     */
    private $pressInternatAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="eventFilms")
     */
    private $eventAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="directorFilms")
     */
    private $directorAddress;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmCategory", inversedBy="films")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmGeneric", mappedBy="film")
     */
    private $generics;

    /**
     * @ORM\OneToMany(targetEntity="FilmAward", mappedBy="film")
     */
    private $awards;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="film")
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity="FilmMinorProduction", mappedBy="film")
     */
    private $minorProductions;

    /**
     * @ORM\OneToMany(targetEntity="FilmCountry", mappedBy="film")
     */
    private $countries;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAddressSchool", mappedBy="film")
     */
    private $schoolAddresses;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmLanguage", mappedBy="film")
     */
    private $languages;

    /**
     * @ORM\ManyToMany(targetEntity="FilmProjection", inversedBy="films")
     */
    private $projections;
    
    /**
     * @var FilmFilmTranslation
     *
     * @ORM\OneToMany(targetEntity="FilmFilmTranslation", mappedBy="film")
     */
    private $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->generics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->awards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->minorProductions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->schoolAddresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projections = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param string $id
     * @return FilmFilm
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set festivalYear
     *
     * @param integer $festivalYear
     * @return FilmFilm
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
     * Set titleVO
     *
     * @param string $titleVO
     * @return FilmFilm
     */
    public function setTitleVO($titleVO)
    {
        $this->titleVO = $titleVO;

        return $this;
    }

    /**
     * Get titleVO
     *
     * @return string 
     */
    public function getTitleVO()
    {
        return $this->titleVO;
    }

    /**
     * Set titleVF
     *
     * @param string $titleVF
     * @return FilmFilm
     */
    public function setTitleVF($titleVF)
    {
        $this->titleVF = $titleVF;

        return $this;
    }

    /**
     * Get titleVF
     *
     * @return string 
     */
    public function getTitleVF()
    {
        return $this->titleVF;
    }

    /**
     * Set titleVA
     *
     * @param string $titleVA
     * @return FilmFilm
     */
    public function setTitleVA($titleVA)
    {
        $this->titleVA = $titleVA;

        return $this;
    }

    /**
     * Get titleVA
     *
     * @return string 
     */
    public function getTitleVA()
    {
        return $this->titleVA;
    }

    /**
     * Set courtlong
     *
     * @param string $courtlong
     * @return FilmFilm
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
     * @return FilmFilm
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
     * Set filmFirst
     *
     * @param string $filmFirst
     * @return FilmFilm
     */
    public function setFilmFirst($filmFirst)
    {
        $this->filmFirst = $filmFirst;

        return $this;
    }

    /**
     * Get filmFirst
     *
     * @return string 
     */
    public function getFilmFirst()
    {
        return $this->filmFirst;
    }

    /**
     * Set worldFirst
     *
     * @param string $worldFirst
     * @return FilmFilm
     */
    public function setWorldFirst($worldFirst)
    {
        $this->worldFirst = $worldFirst;

        return $this;
    }

    /**
     * Get worldFirst
     *
     * @return string 
     */
    public function getWorldFirst()
    {
        return $this->worldFirst;
    }

    /**
     * Set productionYear
     *
     * @param string $productionYear
     * @return FilmFilm
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
     * @return FilmFilm
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
     * @return FilmFilm
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
     * @return FilmFilm
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
     * Set synopsisVa
     *
     * @param string $synopsisVa
     * @return FilmFilm
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
     * Set dialogueVf
     *
     * @param string $dialogueVf
     * @return FilmFilm
     */
    public function setDialogueVf($dialogueVf)
    {
        $this->dialogueVf = $dialogueVf;

        return $this;
    }

    /**
     * Get dialogueVf
     *
     * @return string 
     */
    public function getDialogueVf()
    {
        return $this->dialogueVf;
    }

    /**
     * Set dialogueVa
     *
     * @param string $dialogueVa
     * @return FilmFilm
     */
    public function setDialogueVa($dialogueVa)
    {
        $this->dialogueVa = $dialogueVa;

        return $this;
    }

    /**
     * Get dialogueVa
     *
     * @return string 
     */
    public function getDialogueVa()
    {
        return $this->dialogueVa;
    }

    /**
     * Set previousEvent
     *
     * @param string $previousEvent
     * @return FilmFilm
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
     * Set exploitationCountries
     *
     * @param string $exploitationCountries
     * @return FilmFilm
     */
    public function setExploitationCountries($exploitationCountries)
    {
        $this->exploitationCountries = $exploitationCountries;

        return $this;
    }

    /**
     * Get exploitationCountries
     *
     * @return string 
     */
    public function getExploitationCountries()
    {
        return $this->exploitationCountries;
    }

    /**
     * Set internetDisplayed
     *
     * @param string $internetDisplayed
     * @return FilmFilm
     */
    public function setInternetDisplayed($internetDisplayed)
    {
        $this->internetDisplayed = $internetDisplayed;

        return $this;
    }

    /**
     * Get internetDisplayed
     *
     * @return string 
     */
    public function getInternetDisplayed()
    {
        return $this->internetDisplayed;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return FilmFilm
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
     * Set restaurantOwner
     *
     * @param string $restaurantOwner
     * @return FilmFilm
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
     * @return FilmFilm
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
     * @return FilmFilm
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
     * @return FilmFilm
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
     * @return FilmFilm
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
     * @return FilmFilm
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
     * Set website
     *
     * @param string $website
     * @return FilmFilm
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set gala
     *
     * @param string $gala
     * @return FilmFilm
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
     * Set subSelectionVF
     *
     * @param string $subSelectionVF
     * @return FilmFilm
     */
    public function setSubSelectionVF($subSelectionVF)
    {
        $this->subSelectionVF = $subSelectionVF;

        return $this;
    }

    /**
     * Get subSelectionVF
     *
     * @return string 
     */
    public function getSubSelectionVF()
    {
        return $this->subSelectionVF;
    }

    /**
     * Set subSelectionVA
     *
     * @param string $subSelectionVA
     * @return FilmFilm
     */
    public function setSubSelectionVA($subSelectionVA)
    {
        $this->subSelectionVA = $subSelectionVA;

        return $this;
    }

    /**
     * Get subSelectionVA
     *
     * @return string 
     */
    public function getSubSelectionVA()
    {
        return $this->subSelectionVA;
    }

    /**
     * Set subtitleLanguage
     *
     * @param \FDC\CoreBundle\Entity\Country $subtitleLanguage
     * @return FilmFilm
     */
    public function setSubtitleLanguage(\FDC\CoreBundle\Entity\Country $subtitleLanguage = null)
    {
        $this->subtitleLanguage = $subtitleLanguage;

        return $this;
    }

    /**
     * Get subtitleLanguage
     *
     * @return \FDC\CoreBundle\Entity\Country 
     */
    public function getSubtitleLanguage()
    {
        return $this->subtitleLanguage;
    }

    /**
     * Set productionAddress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $productionAddress
     * @return FilmFilm
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
     * @return FilmFilm
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
     * Set pressAddress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $pressAddress
     * @return FilmFilm
     */
    public function setPressAddress(\FDC\CoreBundle\Entity\FilmAddress $pressAddress = null)
    {
        $this->pressAddress = $pressAddress;

        return $this;
    }

    /**
     * Get pressAddress
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getPressAddress()
    {
        return $this->pressAddress;
    }

    /**
     * Set pressInternatAddress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $pressInternatAddress
     * @return FilmFilm
     */
    public function setPressInternatAddress(\FDC\CoreBundle\Entity\FilmAddress $pressInternatAddress = null)
    {
        $this->pressInternatAddress = $pressInternatAddress;

        return $this;
    }

    /**
     * Get pressInternatAddress
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getPressInternatAddress()
    {
        return $this->pressInternatAddress;
    }

    /**
     * Set eventAddress
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $eventAddress
     * @return FilmFilm
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
     * @return FilmFilm
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
     * Set category
     *
     * @param \FDC\CoreBundle\Entity\FilmCategory $category
     * @return FilmFilm
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
     * Add generics
     *
     * @param \FDC\CoreBundle\Entity\FilmGeneric $generics
     * @return FilmFilm
     */
    public function addGeneric(\FDC\CoreBundle\Entity\FilmGeneric $generics)
    {
        $this->generics[] = $generics;

        return $this;
    }

    /**
     * Remove generics
     *
     * @param \FDC\CoreBundle\Entity\FilmGeneric $generics
     */
    public function removeGeneric(\FDC\CoreBundle\Entity\FilmGeneric $generics)
    {
        $this->generics->removeElement($generics);
    }

    /**
     * Get generics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGenerics()
    {
        return $this->generics;
    }

    /**
     * Add awards
     *
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     * @return FilmFilm
     */
    public function addAward(\FDC\CoreBundle\Entity\FilmAward $awards)
    {
        $this->awards[] = $awards;

        return $this;
    }

    /**
     * Remove awards
     *
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     */
    public function removeAward(\FDC\CoreBundle\Entity\FilmAward $awards)
    {
        $this->awards->removeElement($awards);
    }

    /**
     * Get awards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * Add minorProductions
     *
     * @param \FDC\CoreBundle\Entity\FilmMinorProduction $minorProductions
     * @return FilmFilm
     */
    public function addMinorProduction(\FDC\CoreBundle\Entity\FilmMinorProduction $minorProductions)
    {
        $this->minorProductions[] = $minorProductions;

        return $this;
    }

    /**
     * Remove minorProductions
     *
     * @param \FDC\CoreBundle\Entity\FilmMinorProduction $minorProductions
     */
    public function removeMinorProduction(\FDC\CoreBundle\Entity\FilmMinorProduction $minorProductions)
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
     * Add countries
     *
     * @param \FDC\CoreBundle\Entity\FilmCountry $countries
     * @return FilmFilm
     */
    public function addCountry(\FDC\CoreBundle\Entity\FilmCountry $countries)
    {
        $this->countries[] = $countries;

        return $this;
    }

    /**
     * Remove countries
     *
     * @param \FDC\CoreBundle\Entity\FilmCountry $countries
     */
    public function removeCountry(\FDC\CoreBundle\Entity\FilmCountry $countries)
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
     * Add schoolAddresses
     *
     * @param \FDC\CoreBundle\Entity\FilmAddressSchool $schoolAddresses
     * @return FilmFilm
     */
    public function addSchoolAddress(\FDC\CoreBundle\Entity\FilmAddressSchool $schoolAddresses)
    {
        $this->schoolAddresses[] = $schoolAddresses;

        return $this;
    }

    /**
     * Remove schoolAddresses
     *
     * @param \FDC\CoreBundle\Entity\FilmAddressSchool $schoolAddresses
     */
    public function removeSchoolAddress(\FDC\CoreBundle\Entity\FilmAddressSchool $schoolAddresses)
    {
        $this->schoolAddresses->removeElement($schoolAddresses);
    }

    /**
     * Get schoolAddresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchoolAddresses()
    {
        return $this->schoolAddresses;
    }

    /**
     * Add languages
     *
     * @param \FDC\CoreBundle\Entity\FilmLanguage $languages
     * @return FilmFilm
     */
    public function addLanguage(\FDC\CoreBundle\Entity\FilmLanguage $languages)
    {
        $this->languages[] = $languages;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \FDC\CoreBundle\Entity\FilmLanguage $languages
     */
    public function removeLanguage(\FDC\CoreBundle\Entity\FilmLanguage $languages)
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
     * Add projections
     *
     * @param \FDC\CoreBundle\Entity\FilmProjection $projections
     * @return FilmFilm
     */
    public function addProjection(\FDC\CoreBundle\Entity\FilmProjection $projections)
    {
        $this->projections[] = $projections;

        return $this;
    }

    /**
     * Remove projections
     *
     * @param \FDC\CoreBundle\Entity\FilmProjection $projections
     */
    public function removeProjection(\FDC\CoreBundle\Entity\FilmProjection $projections)
    {
        $this->projections->removeElement($projections);
    }

    /**
     * Get projections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjections()
    {
        return $this->projections;
    }

    /**
     * Add translations
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmTranslation $translations
     * @return FilmFilm
     */
    public function addTranslation(\FDC\CoreBundle\Entity\FilmFilmTranslation $translations)
    {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmTranslation $translations
     */
    public function removeTranslation(\FDC\CoreBundle\Entity\FilmFilmTranslation $translations)
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

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmFilm
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }
}
