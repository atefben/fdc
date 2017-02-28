<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Soif;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;

/**
 * FilmPerson
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
     * @ORM\Column(type="integer")
     * @ORM\Id
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
    protected $id;

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
    protected $portraitImage;

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
    protected $credits;

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
    protected $presidentJuryCredits;

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
    protected $landscapeImage;

    /**
     * Image to use: false = portaitImage, true landscapeImage
     * @var bool
     * @ORM\Column(type="bigint")
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
    protected $displayedImage = false;

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
    protected $presidentJuryImage;

    /**
     * @var string
     * @Gedmo\Slug(fields={"firstname", "lastname"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    protected $slug;

    /**
     * @var boolean
     * @ORM\Column(name="duplicate", type="boolean", options={"default" : 0})
     */
    protected $duplicate = false;

    /**
     * @var string
     * @ORM\Column(type="string", length=40, nullable=true)
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
    protected $lastname;

    /**
     * @var string
     * @ORM\Column(type="string", length=40, nullable=true)
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
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(type="boolean", nullable=true)
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
    protected $asianName;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
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
    protected $nationality;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
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
    protected $nationality2;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="persons")
     * protected $function;
     * /**
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="persons")
     */
    protected $address;

    /**
     * @var FilmFilmPerson
     * @ORM\OneToMany(targetEntity="FilmFilmPerson", mappedBy="person", cascade={"all"})
     * @Groups({"person_list", "person_show"})
     */
    protected $films;

    /**
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="person", cascade={"remove"}))
     * @Groups({"person_list", "person_show"})
     * @ORM\OrderBy({"festival" = "DESC"})
     */
    protected $juries;

    /**
     * @ORM\OneToMany(targetEntity="FilmAwardAssociation", mappedBy="person", orphanRemoval=true)
     * @Groups({"person_list", "person_show"})
     */
    protected $awards;

    /**
     * @ORM\OneToMany(targetEntity="FilmPersonMedia", mappedBy="person", cascade={"all"})
     * @Groups({
     *  "person_list", "person_show",
     *  "jury_list", "jury_show"
     * })
     */
    protected $medias;

    /**
     * @ORM\OneToMany(targetEntity="CinefPerson", mappedBy="person")
     * @Groups({"person_list", "person_show"})
     */
    protected $cinefPersons;

    /**
     * @var ArrayCollection
     * @Groups({
    "person_list", "person_show",
    "film_list", "film_show",
    "jury_list", "jury_show"
    })
     */
    protected $translations;

    /**
     * @ORM\ManyToMany(targetEntity="FilmPerson")
     * @Groups({"person_list", "person_show"})
     */
    protected $duplicates;

    /**
     * @ORM\ManyToOne(targetEntity="FilmPerson")
     * @Groups({"person_list", "person_show"})
     */
    protected $owner;

    /**
     * @var string
     * @ORM\Column(name="selfkit", type="string", length=255, nullable=true)
     */
    protected $selfkit;

    /**
     * @var array
     * @ORM\Column(name="duplicate_ids", type="text", nullable=true)
     */
    protected $duplicateIds;

    /**
     * @var array
     * @ORM\Column(name="duplicate_selfkits", type="text", nullable=true)
     */
    protected $duplicateSelfkits;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinTable(name="film_person_selfkit_images",
     *      joinColumns={@ORM\JoinColumn(name="person", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"updatedAt" = "desc"})
     */
    protected $selfkitImages;

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
        $this->selfkitImages = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getFullname();
    }

    public function getFullName()
    {
        if ($this->asianName) {
            return (string)$this->getLastname() . ' ' . (string)$this->getFirstname();
        } else {
            return (string)$this->getFirstname() . ' ' . (string)$this->getLastname();
        }

    }

    /**
     * Set id
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
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
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set lastname
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
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
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
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set function
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
     * @return \Base\CoreBundle\Entity\FilmFunction
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set address
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
     * @return \Base\CoreBundle\Entity\FilmAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add film
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilms()
    {
        if ($this->duplicate) {
            return $this->films;
        }

        $films = $this->films;
        $done = [];

        foreach ($films as $filmFilmPerson) {
            if ($filmFilmPerson instanceof FilmFilmPerson) {
                $done[] = $filmFilmPerson->getFilm()->getId();
            }
        }

        foreach ($this->duplicates as $duplicate) {
            foreach ($duplicate->getFilms() as $filmFilmPerson) {
                if ($filmFilmPerson instanceof FilmFilmPerson) {
                    $add = false;
                    $identifier = $filmFilmPerson->getFilm()->getId();
                    if (!in_array($identifier, $done)) {
                        $done[] = $identifier;
                        $add = true;
                    }
                    if ($add) {
                        $films->add($filmFilmPerson);
                    }
                }
            }
        }

        return $films;
    }


    /**
     * Add juries
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJuries()
    {
        $done = [];
        foreach ($this->juries as $jury) {
            if ($jury instanceof FilmJury) {
                $identifier = 't' . $jury->getType()->getId()
                    . 'f' . $jury->getFestival()->getId()
                    . 'fu' . $jury->getFunction()->getId();
                $done[] = $identifier;
            }
        }
        $juries = $this->juries;

        foreach ($this->getDuplicates() as $duplicate) {
            if ($duplicate instanceof FilmPerson) {
                foreach ($duplicate->getJuries() as $jury) {
                    if ($jury instanceof FilmJury) {
                        $identifier = 't' . $jury->getType()->getId()
                            . 'f' . $jury->getFestival()->getId()
                            . 'fu' . $jury->getFunction()->getId();
                        if (!in_array($identifier, $done)) {
                            $done[] = $identifier;
                            $juries->add($jury);
                        }
                    }
                }
            }
        }

        return $juries;
    }

    /**
     * Add awards
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAwards()
    {
        if ($this->duplicate) {
            return $this->awards;
        }
        $awards = $this->awards;
        $done = [];

        foreach ($awards as $award) {
            if ($award instanceof FilmAwardAssociation) {
                $identifier = $award->getFilm() . '-' . $award->getAward()->getPrize()->getId();
                $done[] = $identifier;
            }
        }

        foreach ($this->duplicates as $duplicate) {
            if ($duplicate instanceof FilmPerson) {
                foreach ($duplicate->getAwards() as $award) {
                    if ($award instanceof FilmAwardAssociation) {
                        $identifier = $award->getFilm() . '-' . $award->getAward()->getPrize()->getId();
                        if (in_array($identifier, $done)) {
                            $awards->add($award);
                        }
                    }
                }
            }
        }

        return $awards;
    }

    /**
     * Add cinefPersons
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCinefPersons()
    {
        return $this->cinefPersons;
    }

    /**
     * Add medias
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        $medias = $this->medias;
        foreach ($this->duplicates as $duplicate) {
            if ($duplicate instanceof FilmPerson) {
                foreach ($duplicate->getMedias() as $media) {
                    if ($media instanceof FilmPersonMedia) {
                        $medias->add($media);
                    }
                }
            }
        }
        return $medias;
    }

    /**
     * Set asianName
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
     * @return boolean
     */
    public function getAsianName()
    {
        return $this->asianName;
    }

    /**
     * Set nationality
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
     * @return \Base\CoreBundle\Entity\Country
     */
    public function getNationality()
    {
        if ($this->duplicate) {
            return $this->nationality;
        }
        $nationality = $this->nationality;
        foreach ($this->duplicates as $duplicate) {
            if ($duplicate instanceof FilmPerson) {
                if ($nationality) {
                    continue;
                }
                if ($duplicate->getNationality()) {
                    $nationality = $duplicate->getNationality();
                }
            }
        }
        return $nationality;
    }

    /**
     * Set nationality2
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
     * @return \Base\CoreBundle\Entity\Country
     */
    public function getNationality2()
    {
        return $this->nationality2;
    }

    /**
     * Set displayedImage
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
     * @return integer
     */
    public function getDisplayedImage()
    {
        return $this->displayedImage;
    }

    /**
     * Set portraitImage
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
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPortraitImage()
    {
        return $this->portraitImage;
    }

    /**
     * Set landscapeImage
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
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getLandscapeImage()
    {
        return $this->landscapeImage;
    }

    /**
     * Set presidentJuryImage
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
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPresidentJuryImage()
    {
        if ($this->presidentJuryImage) {
            return $this->presidentJuryImage;
        } else {
            foreach ($this->duplicates as $duplicate) {
                if ($duplicate instanceof FilmPerson && $duplicate->getPresidentJuryImage()) {
                    return $duplicate->getPresidentJuryImage();
                }
            }
        }
    }

    /**
     * Set credits
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
     * @return string
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set presidentJuryCredits
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
     * @return string
     */
    public function getPresidentJuryCredits()
    {
        if ($this->presidentJuryCredits) {
            return $this->presidentJuryCredits;
        } else {
            foreach ($this->duplicates as $duplicate) {
                if ($duplicate instanceof FilmPerson && $duplicate->getPresidentJuryCredits()) {
                    return $duplicate->getPresidentJuryCredits();
                }
            }
        }
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
            if (!$this->getDuplicate()) {
                $isElasticable = true;
            }
        }

        return $isElasticable;
    }

    /**
     * Add duplicates
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
     * @param \Base\CoreBundle\Entity\FilmPerson $duplicates
     */
    public function removeDuplicate(\Base\CoreBundle\Entity\FilmPerson $duplicates)
    {
        $this->duplicates->removeElement($duplicates);
    }

    /**
     * Get duplicates
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDuplicates()
    {
        return $this->duplicates;
    }

    /**
     * Set duplicate
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
     * @return boolean
     */
    public function getDuplicate()
    {
        return $this->duplicate;
    }

    /**
     * Set owner
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
     * @return \Base\CoreBundle\Entity\FilmPerson
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set selfkit
     * @param string $selfkit
     * @return FilmPerson
     */
    public function setSelfkit($selfkit)
    {
        $this->selfkit = trim($selfkit);

        return $this;
    }

    /**
     * Get selfkit
     * @return string
     */
    public function getSelfkit()
    {
        return $this->selfkit;
    }

    /**
     * Set duplicateIds
     * @param array $duplicateIds
     * @return FilmPerson
     */
    public function setDuplicateIds($duplicateIds)
    {
        $this->duplicateIds = json_encode($duplicateIds);

        return $this;
    }

    /**
     * Get duplicateIds
     * @return array
     */
    public function getDuplicateIds()
    {
        return json_decode($this->duplicateIds, true);
    }

    /**
     * Set duplicateSelfkits
     * @param array $duplicateSelfkits
     * @return FilmPerson
     */
    public function setDuplicateSelfkits($duplicateSelfkits)
    {
        $this->duplicateSelfkits = json_encode($duplicateSelfkits);

        return $this;
    }

    /**
     * Get duplicateSelfkits
     * @return array
     */
    public function getDuplicateSelfkits()
    {
        return json_decode($this->duplicateSelfkits, true);
    }

    /**
     * Add selfkitImages
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $selfkitImages
     * @return FilmPerson
     */
    public function addSelfkitImage(\Application\Sonata\MediaBundle\Entity\Media $selfkitImages)
    {
        $this->selfkitImages[] = $selfkitImages;

        return $this;
    }

    /**
     * Remove selfkitImages
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $selfkitImages
     */
    public function removeSelfkitImage(\Application\Sonata\MediaBundle\Entity\Media $selfkitImages)
    {
        $this->selfkitImages->removeElement($selfkitImages);
    }

    /**
     * Get selfkitImages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSelfkitImages()
    {
        return $this->selfkitImages;
    }
}
