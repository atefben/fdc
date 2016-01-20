<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\Soif;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * FilmFilm
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FilmFilmRepository")
 * @ORM\HasLifecycleCallbacks
 *
 */
class FilmFilm implements FilmFilmInterface, TranslateMainInterface
{
    use Translatable;
    use TranslateMain;
    use Time;
    use Soif;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=36)
     * @ORM\Id
     *
     * @Groups({
     *  "trailer_list", "trailer_show",
     *  "film_list", "film_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"titleVO"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     *
     * @Groups({
     *  "trailer_list", "trailer_show",
     *  "film_list", "film_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     * 
     */
    private $directorFirst;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     * 
     */
    private $restored;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({
     *  "trailer_list", "trailer_show",
     *  "film_list", "film_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     * 
     */
    private $titleVO;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *  "trailer_list", "trailer_show",
     *  "film_list", "film_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     * 
     */
    private $titleVOAlphabet;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=true)
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     * 
     */
    private $productionYear;
    
    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=2)
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     * 
     */
    private $duration;
    
    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     * 
     */
    private $castingCommentary;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     * 
     */
    private $website;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     */
    private $galaId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     * 
     */
    private $galaName;

    /**
     * @var FilmSelection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelection", inversedBy="films", cascade={"persist"})
     *
     * @Groups({"film_list", "film_show"})
     * 
     */
    private $selection;

    /**
     * @var FilmSelectionSection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelectionSection", inversedBy="films", cascade={"persist"})
     *
     * @Groups({"film_list", "film_show"})
     *
     */
    private $selectionSection;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="films", cascade={"persist"})
     * 
     */
    private $festival;
    
    /**
     * @var FilmFilmPerson
     *
     * @ORM\OneToMany(targetEntity="FilmFilmPerson", mappedBy="film", cascade={"persist"})
     *
     * @Groups({"film_list", "film_show"})
     * 
     */
    private $persons;

    /**
     * @ORM\OneToMany(targetEntity="FilmLanguage", mappedBy="film", cascade={"persist"})
     */
    private $languages;

    /**
     * @ORM\ManyToMany(targetEntity="FilmContact", inversedBy="films", cascade={"persist"})
     * 
     */
    private $contacts;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmFilmMedia", mappedBy="film", cascade={"persist"})
     * @ORM\OrderBy({"position"="ASC"})
     *
     * @Groups({"film_list", "film_show"})
     * 
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity="FilmMinorProduction", mappedBy="film", cascade={"persist"})
     */
    private $minorProductions;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilmCountry", mappedBy="film", cascade={"persist"})
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     */
    private $countries;

    /**
     * @ORM\OneToMany(targetEntity="MediaVideo", mappedBy="film", cascade={"persist"})
     *
     * @Groups({
     *  "trailer_show",
     *  "film_list", "film_show",
     * })
     */
    private $mediaVideos;

    /**
     * @ORM\OneToMany(targetEntity="MediaAudio", mappedBy="film", cascade={"persist"})
     *
     * @Groups({
     *  "trailer_show",
     *  "film_list", "film_show",
     * })
     */
    private $mediaAudios;


    /**
     * @ORM\OneToMany(targetEntity="FilmAwardAssociation", mappedBy="film")
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     */
    protected $awards;

    /**
     * @var ArrayCollection
     *
     * @Groups({
     *  "trailer_list", "trailer_show",
     *  "film_list", "film_show"
     * })
     * 
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="FilmProjectionProgrammationFilm", mappedBy="film")
     *
     * @Groups({
     *  "film_list", "film_show",
     * })
     */
    protected $projectionProgrammationFilms;

    /**
     * @ORM\ManyToMany(targetEntity="FilmProjectionProgrammationFilmList", mappedBy="films")
     *
     * @Groups({
     *  "film_list", "film_show",
     * })
     */
    protected $projectionProgrammationFilmsList;

    /**
     * @ORM\OneToMany(targetEntity="NewsFilmFilmAssociated", mappedBy="association")
     *
     * @Groups({"news_list", "news_show"})
     */
    private $associatedNews;

    /**
     * @ORM\OneToMany(targetEntity="StatementFilmFilmAssociated", mappedBy="association")
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $associatedStatement;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->persons = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->awards = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->mediaVideos = new ArrayCollection();
        $this->mediaAudios = new ArrayCollection();
        $this->minorProductions = new ArrayCollection();
        $this->countries = new ArrayCollection();
        $this->translations = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->projectionProgrammationFilms = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitleVO();
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
     * Set slug
     *
     * @param string $slug
     * @return Settings
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return FilmAward
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
     * Add minorProductions
     *
     * @param \Base\CoreBundle\Entity\FilmMinorProduction $minorProductions
     * @return FilmFilm
     */
    public function addMinorProduction(\Base\CoreBundle\Entity\FilmMinorProduction $minorProductions)
    {
        if ($this->minorProductions->contains($minorProductions)) {
            return;
        }
        
        $this->minorProductions[] = $minorProductions;

        return $this;
    }

    /**
     * Remove minorProductions
     *
     * @param \Base\CoreBundle\Entity\FilmMinorProduction $minorProductions
     */
    public function removeMinorProduction(\Base\CoreBundle\Entity\FilmMinorProduction $minorProductions)
    {
        if (!$this->minorProductions->contains($minorProductions)) {
            return;
        }
        
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
     * @param \Base\CoreBundle\Entity\FilmFilmCountry $countries
     * @return FilmFilm
     */
    public function addCountry(\Base\CoreBundle\Entity\FilmFilmCountry $countries)
    {
        if ($this->countries->contains($countries)) {
            return;
        }
        
        $countries->setFilm($this);
        $this->countries[] = $countries;

        return $this;
    }

    /**
     * Remove countries
     *
     * @param \Base\CoreBundle\Entity\FilmFilmCountry $countries
     */
    public function removeCountry(\Base\CoreBundle\Entity\FilmFilmCountry $countries)
    {
        if (!$this->countries->contains($countries)) {
            return;
        }

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
     * @param \Base\CoreBundle\Entity\FilmLanguage $languages
     * @return FilmFilm
     */
    public function addLanguage(\Base\CoreBundle\Entity\FilmLanguage $languages)
    {
        if ($this->languages->contains($languages)) {
            return;
        }
        
        $this->languages[] = $languages;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \Base\CoreBundle\Entity\FilmLanguage $languages
     */
    public function removeLanguage(\Base\CoreBundle\Entity\FilmLanguage $languages)
    {
        if (!$this->languages->contains($languages)) {
            return;
        }
        
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
     * Add medias
     *
     * @param \Base\CoreBundle\Entity\FilmFilmMedia $medias
     * @return FilmFilm
     */
    public function addMedia(\Base\CoreBundle\Entity\FilmFilmMedia $medias)
    {
        if ($this->medias->contains($medias)) {
            return;
        }
        $medias->setFilm($this);
        
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\FilmFilmMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\FilmFilmMedia $medias)
    {
        if (!$this->medias->contains($medias)) {
            return;
        }
        
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
     * @param \Base\CoreBundle\Entity\FilmSelection $selection
     * @return FilmFilm
     */
    public function setSelection(\Base\CoreBundle\Entity\FilmSelection $selection = null)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Get selection
     *
     * @return \Base\CoreBundle\Entity\FilmSelection
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /**
     * Add persons
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPerson $persons
     * @return FilmFilm
     */
    public function addPerson(\Base\CoreBundle\Entity\FilmFilmPerson $persons)
    {
        if ($this->persons->contains($persons)) {
            return;
        }
        
        $persons->setFilm($this);
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPerson $persons
     */
    public function removePerson(\Base\CoreBundle\Entity\FilmFilmPerson $persons)
    {
        if (!$this->persons->contains($persons)) {
            return;
        }
        
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
     * @param \Base\CoreBundle\Entity\FilmContact $contacts
     * @return FilmFilm
     */
    public function addContact(\Base\CoreBundle\Entity\FilmContact $contacts)
    {
        if ($this->contacts->contains($contacts)) {
            return;
        }

        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \Base\CoreBundle\Entity\FilmContact $contacts
     */
    public function removeContact(\Base\CoreBundle\Entity\FilmContact $contacts)
    {
        if (!$this->contacts->contains($contacts)) {
            return;
        }
        
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

    /**
     * Add mediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mediaVideos
     * @return FilmFilm
     */
    public function addMediaVideo(\Base\CoreBundle\Entity\MediaVideo $mediaVideos)
    {
        $this->mediaVideos[] = $mediaVideos;
        $mediaVideos->setFilm($this);

        return $this;
    }

    /**
     * Remove mediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mediaVideos
     */
    public function removeMediaVideo(\Base\CoreBundle\Entity\MediaVideo $mediaVideos)
    {
        $this->mediaVideos->removeElement($mediaVideos);
    }

    /**
     * Get mediaVideos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMediaVideos()
    {
        return $this->mediaVideos;
    }

    /**
     * Add mediaAudios
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $mediaAudios
     * @return FilmFilm
     */
    public function addMediaAudio(\Base\CoreBundle\Entity\MediaAudio $mediaAudios)
    {
        $this->mediaAudios[] = $mediaAudios;
        $mediaAudios->setFilm($this);

        return $this;
    }

    /**
     * Remove mediaAudios
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $mediaAudios
     */
    public function removeMediaAudio(\Base\CoreBundle\Entity\MediaAudio $mediaAudios)
    {
        $this->mediaAudios->removeElement($mediaAudios);
    }

    /**
     * Get mediaAudios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMediaAudios()
    {
        return $this->mediaAudios;
    }

    /**
     * Add awards
     *
     * @param \Base\CoreBundle\Entity\FilmAwardAssociation $awards
     * @return FilmFilm
     */
    public function addAward(\Base\CoreBundle\Entity\FilmAwardAssociation $awards)
    {
        $this->awards[] = $awards;

        return $this;
    }

    /**
     * Remove awards
     *
     * @param \Base\CoreBundle\Entity\FilmAwardAssociation $awards
     */
    public function removeAward(\Base\CoreBundle\Entity\FilmAwardAssociation $awards)
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
     * Add projectionProgrammationFilms
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationFilm $projectionProgrammationFilms
     * @return FilmFilm
     */
    public function addProjectionProgrammationFilm(\Base\CoreBundle\Entity\FilmProjectionProgrammationFilm $projectionProgrammationFilms)
    {
        $this->projectionProgrammationFilms[] = $projectionProgrammationFilms;

        return $this;
    }

    /**
     * Remove projectionProgrammationFilms
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationFilm $projectionProgrammationFilms
     */
    public function removeProjectionProgrammationFilm(\Base\CoreBundle\Entity\FilmProjectionProgrammationFilm $projectionProgrammationFilms)
    {
        $this->projectionProgrammationFilms->removeElement($projectionProgrammationFilms);
    }

    /**
     * Get projectionProgrammationFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjectionProgrammationFilms()
    {
        return $this->projectionProgrammationFilms;
    }

    /**
     * Add projectionProgrammationFilmsList
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationFilmList $projectionProgrammationFilmsList
     * @return FilmFilm
     */
    public function addProjectionProgrammationFilmsList(\Base\CoreBundle\Entity\FilmProjectionProgrammationFilmList $projectionProgrammationFilmsList)
    {
        $this->projectionProgrammationFilmsList[] = $projectionProgrammationFilmsList;

        return $this;
    }

    /**
     * Remove projectionProgrammationFilmsList
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationFilmList $projectionProgrammationFilmsList
     */
    public function removeProjectionProgrammationFilmsList(\Base\CoreBundle\Entity\FilmProjectionProgrammationFilmList $projectionProgrammationFilmsList)
    {
        $this->projectionProgrammationFilmsList->removeElement($projectionProgrammationFilmsList);
    }

    /**
     * Get projectionProgrammationFilmsList
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjectionProgrammationFilmsList()
    {
        return $this->projectionProgrammationFilmsList;
    }

    /**
     * Set selectionSection
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSection $selectionSection
     * @return FilmFilm
     */
    public function setSelectionSection(\Base\CoreBundle\Entity\FilmSelectionSection $selectionSection = null)
    {
        $this->selectionSection = $selectionSection;

        return $this;
    }

    /**
     * Get selectionSection
     *
     * @return \Base\CoreBundle\Entity\FilmSelectionSection 
     */
    public function getSelectionSection()
    {
        return $this->selectionSection;
    }

    /**
     * Add associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews
     * @return FilmFilm
     */
    public function addAssociatedNews(\Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews)
    {
        $this->associatedNews[] = $associatedNews;

        return $this;
    }

    /**
     * Remove associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews
     */
    public function removeAssociatedNews(\Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews)
    {
        $this->associatedNews->removeElement($associatedNews);
    }

    /**
     * Get associatedNews
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociatedNews()
    {
        return $this->associatedNews;
    }

    /**
     * Add associatedStatement
     *
     * @param \Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedStatement
     * @return FilmFilm
     */
    public function addAssociatedStatement(\Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedStatement)
    {
        $this->associatedStatement[] = $associatedStatement;

        return $this;
    }

    /**
     * Remove associatedStatement
     *
     * @param \Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedStatement
     */
    public function removeAssociatedStatement(\Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedStatement)
    {
        $this->associatedStatement->removeElement($associatedStatement);
    }

    /**
     * Get associatedStatement
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociatedStatement()
    {
        return $this->associatedStatement;
    }
}
