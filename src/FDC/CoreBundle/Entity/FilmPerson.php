<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;
use FDC\CoreBundle\Util\TranslationByLocale;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * FilmPerson
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class FilmPerson
{
    use Time;
    use Translatable;
    use Soif;
    use TranslationByLocale;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    private $firstname;
    
    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    private $asianName;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    private $nationality;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    private $nationality2;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="persons")
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    private $function;
    
    /**
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="persons")
     *
     * @Groups({
            "person_list", "person_show",
            "film_list", "film_show",
            "jury_list", "jury_show"
        })
     */
    private $address;

    /**
     * @var FilmPersonFilmFilm
     *
     * @ORM\OneToMany(targetEntity="FilmFilmPerson", mappedBy="person", cascade={"persist"})
     *
     * @Groups({"person_list", "person_show"})
     */
    private $films;

    /**
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="person")
     *
     * @Groups({"person_list", "person_show"})
     */
    private $juries;

    /**
     * @ORM\OneToMany(targetEntity="FilmAward", mappedBy="person")
     *
     * @Groups({"person_list", "person_show"})
     */
    private $awards;

    /**
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="person")
     *
     * @Groups({"person_list", "person_show"})
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
    }
    
    public function __toString()
    {
        return $this->getFullname();
    }
    
    public function getFullName()
    {
        return $this->getFirstname(). ' '. $this->getLastname();
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
     * @param \FDC\CoreBundle\Entity\FilmFunction $function
     * @return FilmPerson
     */
    public function setFunction(\FDC\CoreBundle\Entity\FilmFunction $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \FDC\CoreBundle\Entity\FilmFunction 
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set address
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $address
     * @return FilmPerson
     */
    public function setAddress(\FDC\CoreBundle\Entity\FilmAddress $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmPerson $films
     * @return FilmPerson
     */
    public function addFilm(\FDC\CoreBundle\Entity\FilmFilmPerson $films)
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
     * @param \FDC\CoreBundle\Entity\FilmFilmPerson $films
     */
    public function removeFilm(\FDC\CoreBundle\Entity\FilmFilmPerson $films)
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
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     * @return FilmPerson
     */
    public function addJury(\FDC\CoreBundle\Entity\FilmJury $juries)
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
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     */
    public function removeJury(\FDC\CoreBundle\Entity\FilmJury $juries)
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
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     * @return FilmPerson
     */
    public function addAward(\FDC\CoreBundle\Entity\FilmAward $awards)
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
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     */
    public function removeAward(\FDC\CoreBundle\Entity\FilmAward $awards)
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
     * @param \FDC\CoreBundle\Entity\CinefPerson $cinefPersons
     * @return FilmPerson
     */
    public function addCinefPerson(\FDC\CoreBundle\Entity\CinefPerson $cinefPersons)
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
     * @param \FDC\CoreBundle\Entity\CinefPerson $cinefPersons
     */
    public function removeCinefPerson(\FDC\CoreBundle\Entity\CinefPerson $cinefPersons)
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
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmPerson
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        if ($this->medias->contains($medias)) {
            return;
        }

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
     * @param \FDC\CoreBundle\Entity\Country $nationality
     * @return FilmPerson
     */
    public function setNationality(\FDC\CoreBundle\Entity\Country $nationality = null)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return \FDC\CoreBundle\Entity\Country 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set nationality2
     *
     * @param \FDC\CoreBundle\Entity\Country $nationality2
     * @return FilmPerson
     */
    public function setNationality2(\FDC\CoreBundle\Entity\Country $nationality2 = null)
    {
        $this->nationality2 = $nationality2;

        return $this;
    }

    /**
     * Get nationality2
     *
     * @return \FDC\CoreBundle\Entity\Country 
     */
    public function getNationality2()
    {
        return $this->nationality2;
    }
}
