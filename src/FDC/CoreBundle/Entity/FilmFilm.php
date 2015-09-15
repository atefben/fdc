<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Translation;
use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmFilm
 *
 * @ORM\Table(indexes={@ORM\Index(name="updated_at", columns={"updated_at"}) })
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmFilm implements FilmFilmInterface
{
    use Translatable;
    use Translation;
    use Time;
    use Soif;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=36)
     * @ORM\Id
     */
    private $id;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $directorFirst;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $restored;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $titleVO;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleVOAlphabet;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $productionYear;
    
    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=2)
     */
    private $duration;
    
    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $castingCommentary;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $galaId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $galaName;

    /**
     * @var FilmSelection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelection", inversedBy="films", cascade={"persist"})
     */
    private $selection;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="films")
     */
    private $festival;
    
    /**
     * @var FilmFilmPerson
     *
     * @ORM\OneToMany(targetEntity="FilmFilmPerson", mappedBy="film", cascade={"persist"})
     */
    private $persons;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmContact", inversedBy="films", cascade={"persist"})
     */
    private $contacts;

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
     * @ORM\OneToMany(targetEntity="FilmFilmMedia", mappedBy="film", cascade={"persist"})
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity="FilmMinorProduction", mappedBy="film")
     */
    private $minorProductions;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilmCountry", mappedBy="film")
     */
    private $countries;

    /**
     * @ORM\ManyToMany(targetEntity="FilmProjection", inversedBy="films")
     */
    private $projections;
    
    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->generics = new ArrayCollection();
        $this->awards = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->minorProductions = new ArrayCollection();
        $this->countries = new ArrayCollection();
        $this->schoolAddresses = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->projections = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
     * Set festival
     *
     * @param \FDC\CoreBundle\Entity\FilmFestival $festival
     * @return FilmAward
     */
    public function setFestival(\FDC\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \FDC\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
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
     * @param \FDC\CoreBundle\Entity\FilmFilmCountry $countries
     * @return FilmFilm
     */
    public function addCountry(\FDC\CoreBundle\Entity\FilmFilmCountry $countries)
    {
        $this->countries[] = $countries;

        return $this;
    }

    /**
     * Remove countries
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmCountry $countries
     */
    public function removeCountry(\FDC\CoreBundle\Entity\FilmFilmCountry $countries)
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
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmMedia $medias
     * @return FilmFilm
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmFilmMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmFilmMedia $medias)
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
    
    public function hasMedia($id)
    {
        foreach ($this->medias as $media) {
            if ($media->getMedia() && $media->getMedia()->getId() == $id) {
                return $media;
            }
        }
        
        return null;
    }

    /**
     * Set directorFirst
     *
     * @param boolean $directorFirst
     * @return FilmFilm
     */
    public function setDirectorFirst($directorFirst)
    {
        $this->directorFirst = $directorFirst;

        return $this;
    }

    /**
     * Get directorFirst
     *
     * @return boolean 
     */
    public function getDirectorFirst()
    {
        return $this->directorFirst;
    }

    /**
     * Set restored
     *
     * @param boolean $restored
     * @return FilmFilm
     */
    public function setRestored($restored)
    {
        $this->restored = $restored;

        return $this;
    }

    /**
     * Get restored
     *
     * @return boolean 
     */
    public function getRestored()
    {
        return $this->restored;
    }

    /**
     * Set titleVOAlphabet
     *
     * @param string $titleVOAlphabet
     * @return FilmFilm
     */
    public function setTitleVOAlphabet($titleVOAlphabet)
    {
        $this->titleVOAlphabet = $titleVOAlphabet;

        return $this;
    }

    /**
     * Get titleVOAlphabet
     *
     * @return string 
     */
    public function getTitleVOAlphabet()
    {
        return $this->titleVOAlphabet;
    }

    /**
     * Set castingCommentary
     *
     * @param string $castingCommentary
     * @return FilmFilm
     */
    public function setCastingCommentary($castingCommentary)
    {
        $this->castingCommentary = $castingCommentary;

        return $this;
    }

    /**
     * Get commentaryCasting
     *
     * @return string 
     */
    public function getCastingCommentary()
    {
        return $this->castingCommentary;
    }

    /**
     * Set galaId
     *
     * @param integer $galaId
     * @return FilmFilm
     */
    public function setGalaId($galaId)
    {
        $this->galaId = $galaId;

        return $this;
    }

    /**
     * Get galaId
     *
     * @return integer 
     */
    public function getGalaId()
    {
        return $this->galaId;
    }

    /**
     * Set galaName
     *
     * @param string $galaName
     * @return FilmFilm
     */
    public function setGalaName($galaName)
    {
        $this->galaName = $galaName;

        return $this;
    }

    /**
     * Get galaName
     *
     * @return string 
     */
    public function getGalaName()
    {
        return $this->galaName;
    }

    /**
     * Set selection
     *
     * @param \FDC\CoreBundle\Entity\FilmSelection $selection
     * @return FilmFilm
     */
    public function setSelection(\FDC\CoreBundle\Entity\FilmSelection $selection = null)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Get selection
     *
     * @return \FDC\CoreBundle\Entity\FilmSelection 
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /**
     * Add persons
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmPerson $persons
     * @return FilmFilm
     */
    public function addPerson(\FDC\CoreBundle\Entity\FilmFilmPerson $persons)
    {
        $persons->setFilm($this);
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmPerson $persons
     */
    public function removePerson(\FDC\CoreBundle\Entity\FilmFilmPerson $persons)
    {
        $this->persons->removeElement($persons);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Add contacts
     *
     * @param \FDC\CoreBundle\Entity\FilmContact $contacts
     * @return FilmFilm
     */
    public function addContact(\FDC\CoreBundle\Entity\FilmContact $contacts)
    {
        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \FDC\CoreBundle\Entity\FilmContact $contacts
     */
    public function removeContact(\FDC\CoreBundle\Entity\FilmContact $contacts)
    {
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
