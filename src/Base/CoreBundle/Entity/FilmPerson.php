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

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * FilmPerson
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FilmPersonRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FilmPerson implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use Soif;
    use TranslateMain;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "jury_list",
     *     "jury_show",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     */
    private $id;

    /**
     * @var MediaImageSimple
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "jury_list",
     *     "jury_show"
     * })
     */
    private $portraitImage;

    /**
     * @var MediaImageSimple
     * @ORM\Column(name="credits", type="string", length=255, nullable=true)
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "jury_list",
     *     "jury_show"
     * })
     */
    private $credits;

    /**
     * @var MediaImageSimple
     * @ORM\Column(name="presidentJuryCredits", type="string", length=255, nullable=true)
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "jury_list",
     *     "jury_show"
     * })
     */
    private $presidentJuryCredits;

    /**
     * @var MediaImageSimple
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "jury_list",
     *     "jury_show"
     * })
     */
    private $landscapeImage;

    /**
     * Image to use: false = portaitImage, true landscapeImage
     * @var bool
     * @ORM\Column(type="bigint")
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "jury_list",
     *     "jury_show"
     * })
     */
    private $displayedImage = false;

    /**
     * @var MediaImageSimple
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "jury_list",
     *     "jury_show"
     * })
     */
    private $presidentJuryImage;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"firstname", "lastname"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="duplicate", type="boolean", options={"default" : 0})
     */
    private $duplicate;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "home",
     *     "film_selection_section_show",
     *     "award_list",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "home",
     *     "film_selection_section_show",
     *     "award_list",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     */
    private $firstname;
    
    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "home",
     *     "film_selection_section_show",
     *     "award_list",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     */
    private $asianName;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list",
     * })
     */
    private $nationality;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "award_list"
     * })
     */
    private $nationality2;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="persons")
     *
    private $function;
    
    /**
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="persons")
     *
     */
    private $address;

    /**
     * @var FilmFilmPerson
     *
     * @ORM\OneToMany(targetEntity="FilmFilmPerson", mappedBy="person", cascade={"all"})
     *
     * @Groups({"person_list", "person_show"})
     */
    private $films;

    /**
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="person", cascade={"remove"}))
     *
     * @Groups({"person_list", "person_show"})
     * @ORM\OrderBy({"festival" = "DESC"})
     */
    private $juries;

    /**
     * @ORM\OneToMany(targetEntity="FilmAwardAssociation", mappedBy="person")
     *
     * @Groups({"person_list", "person_show"})
     */
    private $awards;

    /**
     * @ORM\OneToMany(targetEntity="FilmPersonMedia", mappedBy="person", cascade={"all"})
     *
     * @Groups({
     *  "person_list", "person_show",
     *  "jury_list", "jury_show"
     * })
     */
    private $medias;
    
    /**
     * @ORM\OneToMany(targetEntity="CinefPerson", mappedBy="person")
     *
     * @Groups({"person_list", "person_show"})
     */
    private $cinefPersons;

    /**
     * @var ArrayCollection
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    protected $translations;

    /**
     * @ORM\ManyToMany(targetEntity="FilmPerson")
     *
     * @Groups({"person_list", "person_show"})
     */
    private $duplicates;

    /**
     * @ORM\OneToOne(targetEntity="FilmPerson")
     *
     * @Groups({"person_list", "person_show"})
     */
    private $owner;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->juries = new ArrayCollection();
        $this->awards = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->cinefPersons = new ArrayCollection();
        $this->translations = new ArrayCollection();
        $this->duplicates = new ArrayCollection();
        $this->duplicate = false;
    }
    
    public function __toString()
    {
        return $this->getFullname();
    }
    
    public function getFullName()
    {
        if ($this->asianName) {
            return $this->getLastname() . ' ' . $this->getFirstname();
        }
        else {
            return $this->getFirstname(). ' '. $this->getLastname();
        }

    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmPerson
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
     * Set lastname
     *
     * @param string $lastname
     * @return FilmPerson
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return FilmPerson
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set function
     *
     * @param \Base\CoreBundle\Entity\FilmFunction $function
     * @return FilmPerson
     */
    public function setFunction(\Base\CoreBundle\Entity\FilmFunction $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \Base\CoreBundle\Entity\FilmFunction
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set address
     *
     * @param \Base\CoreBundle\Entity\FilmAddress $address
     * @return FilmPerson
     */
    public function setAddress(\Base\CoreBundle\Entity\FilmAddress $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \Base\CoreBundle\Entity\FilmAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add film
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPerson $films
     * @return FilmPerson
     */
    public function addFilm(\Base\CoreBundle\Entity\FilmFilmPerson $films)
    {
        if ($this->films->contains($films)) {
            return;
        }

        $films->setPerson($this);
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove film
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPerson $films
     */
    public function removeFilm(\Base\CoreBundle\Entity\FilmFilmPerson $films)
    {
        if (!$this->films->contains($films)) {
            return;
        }

        $this->films->removeElement($films);
    }

    /**
     * Get films
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilms()
    {
        return $this->films;
    }
    

    /**
     * Add juries
     *
     * @param \Base\CoreBundle\Entity\FilmJury $juries
     * @return FilmPerson
     */
    public function addJury(\Base\CoreBundle\Entity\FilmJury $juries)
    {
        if ($this->juries->contains($juries)) {
            return;
        }

        $this->juries[] = $juries;

        return $this;
    }

    /**
     * Remove juries
     *
     * @param \Base\CoreBundle\Entity\FilmJury $juries
     */
    public function removeJury(\Base\CoreBundle\Entity\FilmJury $juries)
    {
        if (!$this->juries->contains($juries)) {
            return;
        }

        $this->juries->removeElement($juries);
    }

    /**
     * Get juries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJuries()
    {
        return $this->juries;
    }

    /**
     * Add awards
     *
     * @param \Base\CoreBundle\Entity\FilmAwardAssociation $awards
     * @return FilmPerson
     */
    public function addAward(\Base\CoreBundle\Entity\FilmAwardAssociation $awards)
    {
        if ($this->awards->contains($awards)) {
            return;
        }

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
        if (!$this->awards->contains($awards)) {
            return;
        }

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
     * Add cinefPersons
     *
     * @param \Base\CoreBundle\Entity\CinefPerson $cinefPersons
     * @return FilmPerson
     */
    public function addCinefPerson(\Base\CoreBundle\Entity\CinefPerson $cinefPersons)
    {
        if ($this->cinefPersons->contains($cinefPersons)) {
            return;
        }
        
        $this->cinefPersons[] = $cinefPersons;

        return $this;
    }

    /**
     * Remove cinefPersons
     *
     * @param \Base\CoreBundle\Entity\CinefPerson $cinefPersons
     */
    public function removeCinefPerson(\Base\CoreBundle\Entity\CinefPerson $cinefPersons)
    {
        if (!$this->cinefPersons->contains($cinefPersons)) {
            return;
        }

        $this->cinefPersons->removeElement($cinefPersons);
    }

    /**
     * Get cinefPersons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCinefPersons()
    {
        return $this->cinefPersons;
    }

    /**
     * Add medias
     *
     * @param \Base\CoreBundle\Entity\FilmPersonMedia $medias
     * @return FilmPerson
     */
    public function addMedia(\Base\CoreBundle\Entity\FilmPersonMedia $medias)
    {
        if ($this->medias->contains($medias)) {
            return;
        }
        $medias->setPerson($this);

        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\FilmPersonMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\FilmPersonMedia $medias)
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

    /**
     * Set asianName
     *
     * @param boolean $asianName
     * @return FilmPerson
     */
    public function setAsianName($asianName)
    {
        $this->asianName = $asianName;

        return $this;
    }

    /**
     * Get asianName
     *
     * @return boolean 
     */
    public function getAsianName()
    {
        return $this->asianName;
    }

    /**
     * Set nationality
     *
     * @param \Base\CoreBundle\Entity\Country $nationality
     * @return FilmPerson
     */
    public function setNationality(\Base\CoreBundle\Entity\Country $nationality = null)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return \Base\CoreBundle\Entity\Country
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set nationality2
     *
     * @param \Base\CoreBundle\Entity\Country $nationality2
     * @return FilmPerson
     */
    public function setNationality2(\Base\CoreBundle\Entity\Country $nationality2 = null)
    {
        $this->nationality2 = $nationality2;

        return $this;
    }

    /**
     * Get nationality2
     *
     * @return \Base\CoreBundle\Entity\Country
     */
    public function getNationality2()
    {
        return $this->nationality2;
    }

    /**
     * Set displayedImage
     *
     * @param integer $displayedImage
     * @return FilmPerson
     */
    public function setDisplayedImage($displayedImage)
    {
        $this->displayedImage = $displayedImage;

        return $this;
    }

    /**
     * Get displayedImage
     *
     * @return integer 
     */
    public function getDisplayedImage()
    {
        return $this->displayedImage;
    }

    /**
     * Set portraitImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $portraitImage
     * @return FilmPerson
     */
    public function setPortraitImage(\Base\CoreBundle\Entity\MediaImageSimple $portraitImage = null)
    {
        $this->portraitImage = $portraitImage;

        return $this;
    }

    /**
     * Get portraitImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPortraitImage()
    {
        return $this->portraitImage;
    }

    /**
     * Set landscapeImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $landscapeImage
     * @return FilmPerson
     */
    public function setLandscapeImage(\Base\CoreBundle\Entity\MediaImageSimple $landscapeImage = null)
    {
        $this->landscapeImage = $landscapeImage;

        return $this;
    }

    /**
     * Get landscapeImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getLandscapeImage()
    {
        return $this->landscapeImage;
    }

    /**
     * Set presidentJuryImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $presidentJuryImage
     * @return FilmPerson
     */
    public function setPresidentJuryImage(\Base\CoreBundle\Entity\MediaImageSimple $presidentJuryImage = null)
    {
        $this->presidentJuryImage = $presidentJuryImage;

        return $this;
    }

    /**
     * Get presidentJuryImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPresidentJuryImage()
    {
        return $this->presidentJuryImage;
    }

    /**
     * Set credits
     *
     * @param string $credits
     * @return FilmPerson
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return string 
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set presidentJuryCredits
     *
     * @param string $presidentJuryCredits
     * @return FilmPerson
     */
    public function setPresidentJuryCredits($presidentJuryCredits)
    {
        $this->presidentJuryCredits = $presidentJuryCredits;

        return $this;
    }

    /**
     * Get presidentJuryCredits
     *
     * @return string 
     */
    public function getPresidentJuryCredits()
    {
        return $this->presidentJuryCredits;
    }

    public function getFilmPersonOrderedByFilmFestivalYearAsc()
    {
        $output = array();

        foreach ($this->films as $filmPerson) {
            if ($filmPerson instanceof FilmFilmPerson) {
                if ($filmPerson->getFilm()) {
                    $output[$filmPerson->getFilm()->getFestival()->getYear() . ' ' . $filmPerson->getId()] = $filmPerson;
                }
            }

        }
        krsort($output);
        return new ArrayCollection(array_values($output));
    }
    
    public function isElasticable()
    {
        $isElasticable = false;
        if (count($this->getFilms()) || count($this->getAwards()) || count($this->getJuries())) {
            $isElasticable = true;
        }

        return $isElasticable;
    }

    /**
     * Add duplicates
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $duplicates
     * @return FilmPerson
     */
    public function addDuplicate(\Base\CoreBundle\Entity\FilmPerson $duplicates)
    {
        $this->duplicates[] = $duplicates;

        return $this;
    }

    /**
     * Remove duplicates
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $duplicates
     */
    public function removeDuplicate(\Base\CoreBundle\Entity\FilmPerson $duplicates)
    {
        $this->duplicates->removeElement($duplicates);
    }

    /**
     * Get duplicates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDuplicates()
    {
        return $this->duplicates;
    }

    /**
     * Set duplicate
     *
     * @param boolean $duplicate
     * @return FilmPerson
     */
    public function setDuplicate($duplicate)
    {
        $this->duplicate = $duplicate;

        return $this;
    }

    /**
     * Get duplicate
     *
     * @return boolean 
     */
    public function getDuplicate()
    {
        return $this->duplicate;
    }

    /**
     * Set owner
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $owner
     * @return FilmPerson
     */
    public function setOwner(\Base\CoreBundle\Entity\FilmPerson $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \Base\CoreBundle\Entity\FilmPerson 
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
